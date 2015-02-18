raven-bundle
============

[![Build Status](https://travis-ci.org/classmarkets/raven-bundle.svg?branch=master)](https://travis-ci.org/classmarkets/raven-bundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/classmarkets/raven-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/classmarkets/raven-bundle/?branch=master)

Are you using [sentry](https://getsentry.com) for exception monitoring in
Symfony 2? Good! Now let's show meaningful error pages to your users.

Sentry generates ids for each event it receives. This bundle adds a Twig
function that let's you access those event ids in error page templates:

```twig

<h1>Oh no, something went wrong!</h1>

{% if exception is defined %}
    {% set eventId = sentry_event_id(exception) %}

    {% if eventId is not empty %}
        <p>
            The good news is that our team has been notified and is probably
            working on a solution already.
        </p>
        
        <p>
            Error Code: <code>{{ eventId }}</code>
        </p>
    {% endif %}
{% endif %}
```

You can also lookup event ids wherever the DIC is available like this:

```php
<?php

$container->get('cm_raven.sentry_event_recorder')->getEventIdForException($exception);
```

Installation
------------

The usual. Install it with `composer require classmarkets/raven-bundle ~1.0.0` and
add it to the kernel:

```
<?php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new \Classmarkets\RavenBundle\CMRavenBundle(),
        );
    }
```

Configuration
-------------

### Quickstart

Assuming you are using Monolog's raven handler already, and have not changed
the `twig.exception_listener` service, you already have something like this:

```yml
monolog:
    raven:
        type:  raven
        dsn: %sentry_dsn%
        level: error
```

Turn it into this:

```yml
monolog:
    raven:
        type:  raven
        dsn: "" # some versions of the monolog bundle require the dsn key to
                # be present (even if it is empty)
        client_id: raven
        level: error

cm_raven:
    client_id: raven

services:
    raven:
        class: Raven_Client
        arguments: [ %sentry_dsn% ]
```

If you already have `monolog.raven.client_id` configured, omit the extra
service definition.

The important thing is that `monolog.raven.client_id` equals
`cm_raven.client_id`.

If you are not using monolog, find the id for the service that provides the
`Raven_Client` instance, and set `cm_raven.client_id` to that id.

How it works
------------

There are two parts to this bundle. Remembering event ids and making them
available to error pages.

The first part is easy. All we have to do is decorate a `Raven_Client` service
with an event id recorder.

The second part is tricky because the original exception doesn't make it into
the template engine. Instead, it gets converted into a `FlattenException`.
This FlattenException is unknown to our event recorder (because it only saw
the original exception).

The FlattenException gets created by some protected method in the
`twig.exception_listener` service. To solve our problem, we replace that
service to associate the FlattenException with the same event id as the
original exception.

If your application already has a custom `twig.exception_listener` service,
disable our implementation and call
`@cm_raven.sentry_event_recorder::addExceptionAlias($originalException,
$flattenException)` yourself (see
[ExceptionListener.php](ExceptionListener.php)).

To disable the exception listener configure

```yml
cm_raven:
    enable_exception_listener: false
```
