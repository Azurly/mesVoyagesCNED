<?php 

namespace App\Tests\Validations;

use App\Entity\Visite;
use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class VisiteRepositoryTest extends KernelTestCase{
    /**
     * @return VisiteRepository
     */
    public function recupRepository(): VisiteRepository{
        self::bootKernel();
        $repository = self::getContainer()->get(VisiteRepository::class);
        return $repository;
    }
    public function testNbVisites(){
        $repository = $this->recupRepository();
        $nbVisites = $repository->count([]);
        $this->assertEquals(100, $nbVisites);
    }
    public function newVisite():Visite{
        $visite = (new Visite())->setVille("New York")->setPays("USA")->setDatecreation(new \DateTime("now"));
        return $visite;
    }
    public function testAddVisite(){
        $repository = $this->recupRepository();
        $visite = $this->newVisite();
        $nbVisites = $repository->count([]);
        $repository->add($visite, true);
        $this->assertEquals($nbVisites + 1, $repository->count([]), "Erreur lors de l'ajout");
    }
    public function testRemoveVisite(){
        $repository = $this->recupRepository();
        $visite = $this->newVisite();
        $repository->add($visite, true);
        $nbVisites = $repository->count([]);
        $repository->remove($visite, true);
        $this->assertEquals($nbVisites - 1, $repository->count([]), "Erreur lors de la supression");
    }
    public function testFindByEqualValue(){
        $repository = $this->recupRepository();
        $visite = $this->newVisite();
        $repository->add($visite, true);
        $visites = $repository->findByEqualValue("ville", "New York");
        $nbVisites = count($visites);
        $this->assertEquals(1, $nbVisites);
        $this->assertEquals("New York", $visites[0]->getVille());
    }
}
?>