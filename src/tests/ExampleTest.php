<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $uris = [
            "bounce",
            "click",
            "deferred",
            "delivered",
            "dropped",
            "open",
            "processed",
            "spamreport",
            "unsubscribe"
        ];

        $data = json_decode(
            file_get_contents(__DIR__ . '/data/test_event.json'),
            true
        );

        foreach ($uris as $uri) {
            $this->postJson('api/' . $uri, $data)->assertResponseStatus(200);
        }
    }
}
