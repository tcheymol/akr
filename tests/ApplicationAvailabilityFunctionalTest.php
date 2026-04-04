<?php

namespace App\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationAvailabilityFunctionalTest extends WebTestCase
{
    #[DataProvider('redirectUrlProvider')]
    public function testPageRedirects(string $url): void
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertResponseRedirects();
    }

    #[DataProvider('successfulUrlProvider')]
    public function testPageIsSuccessful(string $url): void
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertResponseIsSuccessful();
    }

    #[DataProvider('notFoundUrlProvider')]
    public function testPageIsNotFound(string $url): void
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertResponseStatusCodeSame(404);
    }

    public static function successfulUrlProvider(): \Generator
    {
        yield ['/login'];
        yield ['/spots'];
        yield ['/general-rules'];
        yield ['/gallery'];
        yield ['/meteo'];
        //        yield ['/upload-photos'];
    }

    public static function redirectUrlProvider(): \Generator
    {
        yield ['/'];
        yield ['/logout'];
    }

    public static function notFoundUrlProvider(): \Generator
    {
        yield ['/spots/0'];
        yield ['/text/0'];
        yield ['/image/0/remove'];
    }
}
