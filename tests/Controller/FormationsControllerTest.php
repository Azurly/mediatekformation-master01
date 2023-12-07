<?php

namespace App\Tests\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class FormationsControllerTest extends WebTestCase{

    public function testAccesPage(){
        $client = static::createClient();
        $client->request('GET', '/formations');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
    public function testLinkFormation(){
        $client = static::createClient();
        $client->request('GET', '/formations');
        $client->clickLink('Z4yTTXka958');
        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $uri = $client->getRequest()->server->get("REQUEST_URL");
        $this->assertEquals('/formations/formation/1', $uri);
    }
}
