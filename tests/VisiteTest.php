<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Visite;

/**
 * Description of VisiteTest
 *
 * @author Titi L
 */
class VisiteTest extends TestCase{
    
    public function testGetDateCreationString(){
        $visite = new Visite();
        $visite->setDatecreation(new \DateTime("2023-04-14"));
        $this->assertEquals("14/04/2023", $visite->getDatecreationString());
    }
}
