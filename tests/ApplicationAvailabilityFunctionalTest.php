<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationAvailabilityFunctionalTest extends WebTestCase
{
    /** @dataProvider redirectUrlProvider */
    public function testPageRedirects(string $url): void
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertResponseRedirects();
    }

    /** @dataProvider successfulUrlProvider */
    public function testPageIsSuccessful(string $url): void
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertResponseIsSuccessful();
    }

    /** @dataProvider notFoundUrlProvider */
    public function testPageIsNotFound(string $url): void
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertResponseStatusCodeSame(404);
    }

    public function successfulUrlProvider(): \Generator
    {
        yield ['/login'];
        yield ['/spots'];
        yield ['/general-rules'];
        yield ['/gallery'];
        yield ['/meteo'];
//        yield ['/upload-photos'];
    }

    public function redirectUrlProvider(): \Generator
    {
        yield ['/'];
        yield ['/logout'];
    }

    public function notFoundUrlProvider(): \Generator
    {
        yield ['/spots/0'];
        yield ['/text/0'];
        yield ['/image/0/remove'];
    }
}
