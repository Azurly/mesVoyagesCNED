<?php 
namespace App\Tests\Validations;

use App\Entity\Visite;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class VisitesValidationsTest extends KernelTestCase{
    public function getVisite(): Visite{
        return (new Visite())->setVille("New York")->setPays("USA");
    }
    public function testValidNoteVisite(){
        $visite = $this->getVisite()->setNote(10);
        $this->assertErrors($visite, 0);
    }
    public function testNonValidNoteVisite(){
        $visite = $this->getVisite()->setNote(21);
        $this->assertErrors($visite, 1);
    }
    public function testNonValidTempmaxVisite(){
        $visite = $this->getVisite()->setTempsmin(21)->setTempsmax(18);
        $this->assertErrors($visite, 1, "Min = 20, max = 10, cela devrait échouer");
    }
    public function assertErrors(Visite $visite, int $nbErreurAttendues, string $messageErreur=""){
        self::bootKernel();
        $validator = self::getContainer()->get(ValidatorInterface::class);
        $error = $validator->validate($visite);
        $this->assertCount($nbErreurAttendues, $error, $messageErreur);
    }
}
?>