<?php

namespace App\Controller\admin;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use App\Repository\FormationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class adminCategoriesController extends AbstractController{

    /**
     * @var FormationRepository
     */
    private $repository;

    /**
     * @param CategorieRepository $repository
     */
    public function __construct(CategorieRepository $repository){
        $this->repository = $repository;
    }

    /**
     * @Route("/admin/categories", name="admin.categories")
     * @return Response
     */
    public function index():Response{
        $categories = $this->repository->findAll();
        return $this->render("admin/admin.categories.html.twig", [
            "categories"=> $categories
        ]);
    }
    /**
     * @Route("/admin/categories/suppr/{id}", name="admin.categorie.suppr")
     * @param Categorie $categorie
     * @return Response
     */
    public function suppr(Categorie $categorie):Response{
        $this->repository->remove($categorie, true);
        return $this->redirectToRoute("admin.categories");
    }
    /**
     * @Route("/admin/categories/ajout", name="admin.categorie.ajout")
     * @param Request $request
     * @return Response
     */
    public function ajout(Request $request):Response{
        $nomCategorie = $request->get("name");
        $categorie = new Categorie();
        $categorie->setName($nomCategorie);
        $this->repository->add($categorie, true);
        return $this->redirectToRoute("admin.categories");
    }
}
