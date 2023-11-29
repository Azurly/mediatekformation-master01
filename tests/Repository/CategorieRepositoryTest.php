<?php

namespace App\Tests\Repository;
use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategorieRepositoryTEST extends KernelTestCase{

    // Instanciation d'une formation
    public function newCategorie(): Categorie{
        return (new Categorie())
        ->setName('testCategorie');
    }
    /**
     * Récupère le repository de Formation
     * @return CategorieRepository
     */
    public function recupRepository(): CategorieRepository{
        self::bootKernel();
        return self::getContainer()->get(CategorieRepository::class);
    }

    public function testAddCategorie(){
        $repository = $this->recupRepository();
        $categorie = $this->newCategorie();
        $repository->add($categorie, true);
        $nbCategorie = $repository->count([]);
        $repository->remove($categorie, true);
        $this->assertEquals($nbCategorie - 1, $repository->count([]));
    }

    public function testFindAllForOnePlaylist(){
        $repository = $this->recupRepository();
        $categorie = $this->newCategorie();
        $repository->add($categorie, true);
        $categories = $repository->findAllForOnePlaylist("4");
        $nbCategories = count($categories);
        $this->assertEquals(4, $nbCategories);
    }
    //Le nombre à assertEquals est le nombre de formations dans la BDD
    public function testNbCategories(){
        $this->assertEquals(237, $this->recupRepository()->count([]));
    }
}
