<?php

namespace CoreSphere\StaticBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PageControllerTest extends WebTestCase
{
    public function testCreateUpdateDeleteScenario()
    {
        // Create a new cNa dulient to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/page/');
        $this->assertSame(200 , $client->getResponse()->getStatusCode());
								
        $crawler = $client->click($crawler->selectLink('Create a new page')->link());
        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'staticbundle_page[title]'  => 'Test',
            'staticbundle_page[content]'  => 'TestContent',
            'staticbundle_page[slug]'  => 'TestSlug',
            // ... other fields to fill
        ));


        $client->submit($form);
       	$crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertTrue($crawler->filter('h1:contains("Test")')->count() > 0);

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Update')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'staticbundle_page[title]'  => 'Foo',
            'staticbundle_page[content]'  => 'FooContent',
            'staticbundle_page[slug]'  => 'FooSlug',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

								//var_dump($client->getResponse()->getContent()); //dumps current HTML to the console
        // Check the element contains an attribute with value equals "Foo"
        //$this->assertTrue($crawler->filter('[value="Foo"]')->count() > 0); //
        // Check the element 'h1' contains "Foo"
        $this->assertTrue($crawler->filter('h1:contains("Foo")')->count() > 0);

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }
}