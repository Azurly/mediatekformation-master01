<?php

namespace App\Tests\Repository;

use App\Entity\Playlist;
use App\Repository\PlaylistRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PlaylistRepositoryTest extends KernelTestCase{

    // Instanciation d'une categorie
    public function newCategorie(): Playlist{
        return (new Playlist())
        ->setName("CategorieTestRepository")
        ->setDescription("testesttestrepository");
    }
    /**
     * Récupère le repository de categorie
     * @return PlaylistRepository
     */
    public function recupRepository(): PlaylistRepository{
        self::bootKernel();
        return self::getContainer()->get(PlaylistRepository::class);
    }

    public function testAddCategorie(){
        $repository = $this->recupRepository();
        $categorie = $this->newCategorie();
        $repository->add($categorie, true);
        $nbCategorie = $repository->count([]);
        $repository->remove($categorie, true);
        $this->assertEquals($nbCategorie - 1, $repository->count([]));
    }

    //Le nombre à assertEquals est le nombre de categories dans la BDD
    public function testNbCategories(){
        $this->assertEquals(237, $this->recupRepository()->count([]));
    }
}
