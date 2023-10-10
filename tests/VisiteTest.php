<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Visite;
use App\Entity\Environnement;

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
    
    public function testAddEnvironnement(){
        $environnement = new Environnement();
        $environnement->setNom("plage");
        $visite = new Visite();
        $visite->addEnvironnement($environnement);
        $nbEnvironnementAvant = $visite->getEnvironnements()->count();
        $visite->addEnvironnement($environnement);
        $nbEnvironnementApres = $visite->getEnvironnements()->count();
        $this->assertEquals($nbEnvironnementAvant, $nbEnvironnementApres, "ajout même environnement devrait échouer");
    }    
}
