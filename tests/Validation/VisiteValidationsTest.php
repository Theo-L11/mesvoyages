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
        $visite = $this->getVisite()->setNote(10);
        $this->assertErrors($visite, 0);
    }
    
        public function testNonValidNoteVisite(){
        $visite = $this->getVisite()->setNote(21);
        $this->assertErrors($visite, 1);
    }
    
        public function testNonValidTempMaxVisite(){
        $visite = $this->getVisite()
                ->setTempmax(12)
                ->setTempmin(15);
        $this->assertErrors($visite, 1, "min=15, max=12 devrait echouer");
    }
    
    public function assertErrors(Visite $visite, int $nbErreursAttendues, string $message=""){
        self::bootKernel();
        $validator = self::getContainer()->get(ValidatorInterface::class);
        $error = $validator->validate($visite);
        $this->assertCount($nbErreursAttendues, $error, $message);
    }
}
