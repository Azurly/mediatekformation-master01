<?php

namespace App\Tests\Repository;
use App\Entity\Formation;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FormationRepositoryTest extends KernelTestCase{

    // Instanciation d'une formation
    public function newFormation(): Formation{
        return (new Formation())
        ->setTitle("FormationTestRepository")
        ->setDescription("testesttestrepository")
        ->setPublishedAt(new \DateTime("now"));
    }
    /**
     * Récupère le repository de Formation
     * @return FormationRepository
     */
    public function recupRepository(): FormationRepository{
        self::bootKernel();
        return self::getContainer()->get(FormationRepository::class);
    }

    public function testAddFormation(){
        $repository = $this->recupRepository();
        $formation = $this->newFormation();
        $repository->add($formation, true);
        $nbFormation = $repository->count([]);
        $repository->remove($formation, true);
        $this->assertEquals($nbFormation + 1, $repository->count([]));
    }

    //Le nombre à assertEquals est le nombre de formations dans la BDD
    public function testNbFormations(){
        $this->assertEquals(240, $this->recupRepository()->count([]));
    }
}
