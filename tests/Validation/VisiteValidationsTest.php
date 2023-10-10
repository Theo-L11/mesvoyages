<?php

namespace App\Tests\Validations;

use App\Entity\Visite;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Description of VisiteValidationsTest
 *
 * @author Titi L
 */
class VisiteValidationsTest extends KernelTestCase {
    
    public function getVisite(): Visite{
        return (new Visite())
                ->setVille("Paris")
                ->setPays("France");
    }
    
    public function testValidNoteVisite(){
        $this->assertErrors($this->getVisite()->setNote(10), 0, "10 devrait réussir");
        $this->assertErrors($this->getVisite()->setNote(20), 0, "20 devrait réussir");
        $this->assertErrors($this->getVisite()->setNote(0), 0, "0 devrait réussir");
    }
    
        public function testNonValidNoteVisite(){
            $this->assertErrors($this->getVisite()->setNote(21), 1, "21 ne devrait pas marcher");
            $this->assertErrors($this->getVisite()->setNote(-1), 1, "-1 ne devrait pas marcher");
            $this->assertErrors($this->getVisite()->setNote(-5), 1, "-5 ne devrait pas marcher");
            $this->assertErrors($this->getVisite()->setNote(45), 1, "45 ne devrait pas marcher");
    }
    
        public function testNonValidTempMaxVisite(){
        $this->assertErrors($this->getVisite()->setTempmax(-15)
                                              ->setTempmin(15), 1, " Cela ne devrait pas fonctionner");
        $this->assertErrors($this->getVisite()->setTempmax(10)
                                              ->setTempmin(10), 1, " Cela devrait fonctionner");
    }
    
    public function testValidTempMaxVisite(){
        $this->assertErrors($this->getVisite()->setTempmax(40)
                                              ->setTempmin(2), 0, " Cela devrait fonctionner");
        $this->assertErrors($this->getVisite()->setTempmax(14)
                                              ->setTempmin(13), 0, " Cela devrait fonctionner");
    }
    
     public function testValidDatecreationVisite(){ 
        $aujourdhui = new \DateTime();
        $this->assertErrors($this->getVisite()->setDatecreation($aujourdhui), 0, "aujourd'hui devrait réussir");
        $plustot = (new \DateTime())->sub(new \DateInterval("P5D"));
        $this->assertErrors($this->getVisite()->setDatecreation($plustot), 0, "plus tôt devrait réussir");
    }

    public function testNonValidDatecreationVisite(){ 
        $demain = (new \DateTime())->add(new \DateInterval("P1D"));
        $this->assertErrors($this->getVisite()->setDatecreation($demain), 1, "demain devrait échouer");
        $plustard = (new \DateTime())->add(new \DateInterval("P5D"));
        $this->assertErrors($this->getVisite()->setDatecreation($plustard), 1, "plus tard devrait échouer");
    }
    
    public function assertErrors(Visite $visite, int $nbErreursAttendues, string $message=""){
        self::bootKernel();
        $validator = self::getContainer()->get(ValidatorInterface::class);
        $error = $validator->validate($visite);
        $this->assertCount($nbErreursAttendues, $error, $message);
    }
}
