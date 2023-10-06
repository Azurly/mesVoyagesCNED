<?php
namespace App\Tests\Validations;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VoyagesControllerTest extends WebTestCase
{
    public function testAccessPage()
    {
        $client = static::createClient();
        $client->request('GET', '/voyages');
        $this->assertResponseIsSuccessful();
    }
    public function testContenuPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/voyages');
        $this->assertSelectorTextContains('h1', 'Mes Voyages');
        $this->assertSelectorTextContains('th', 'Ville');
        $this->assertCount(4, $crawler->filter('th'));
        $this->assertSelectorTextContains('h5', 'ftyicfjghc');
    }
    public function testLinkVille()
    {
        $client = static::createClient();
        $client->request('GET', '/voyages');
        $client->clickLink('ftyicfjghc');
        $reponse = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $reponse->getStatusCode());
        $uri = $client->getRequest()->server->get("REQUEST_URI");
        $this->assertEquals('/voyages/voyage/105', $uri);
    }
   // public function testFiltreVille()
    // {
       //  $client = static::createClient();
    //     $client->request('GET', '/voyages');
       //  $crawler = $client->submitForm('filtrer', [
     //        'recherche' => 'ftyicfjghc'
      //   ]);        
     //    $this->assertCount(1, $crawler->filter('h5'));
       //  $this->assertSelectorTextContains('h5', 'ftyicfjghc');

    // }
}
?>