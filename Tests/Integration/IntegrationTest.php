<?php

namespace Classmarkets\RavenBundle\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IntegrationTest extends WebTestCase
{
    protected static function getKernelClass()
    {
        return 'Classmarkets\RavenBundle\Tests\Integration\TestKernel';
    }

    public function testErrorPage()
    {
        $client = static::createClient();
        $client->request('GET', '/_cm_raven_bundle_test');

        $this->assertEquals("Error Code: abc\n", $client->getResponse()->getContent());
    }
}
