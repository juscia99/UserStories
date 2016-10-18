<?php

namespace ContactBookBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PersonControllerTest extends WebTestCase
{
    public function testNewcontact()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/newContact');
    }

    public function testCreatecontact()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/createContact');
    }

    public function testModifycontact()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/{id}/modifyContact');
    }

    public function testModifycontactform()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/{id}/modifyContactForm');
    }

    public function testDeletecontact()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/{id}/deleteContact');
    }

    public function testGetcontact()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/{id}/getContact');
    }

    public function testGetallcontacts()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getAllContacts');
    }

}
