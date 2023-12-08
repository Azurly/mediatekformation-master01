<?php
namespace App\Controller;

use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controleur de l'accueil
 *
 * @author emds
 */
class AccueilController extends AbstractController{

    const CHEMINACCEUILHTMLTWIG = "pages/accueil.html.twig";
    /**
     * @var FormationRepository
     */
    private $repository;
    
    /**
     * @param FormationRepository $repository
     */
    public function __construct(FormationRepository $repository) {
        $this->repository = $repository;
    }
    
    /**
     * The above function is a PHP method that renders a template with the latest 2 formations and
     * returns a Response object.
     */
    /**
     * @Route("/", name="accueil")
     * @return Response
     */
    public function index(): Response{
        $formations = $this->repository->findAllLasted(2);
        return $this->render(self::CHEMINACCEUILHTMLTWIG, [
            'formations' => $formations
        ]);
    }
    
    /**
     * @Route("/cgu", name="cgu")
     * @return Response
     */
   /**
    * The function "cgu" returns a response that renders the "cgu.html.twig" template.
    */
    public function cgu(): Response{
        return $this->render("pages/cgu.html.twig");
    }
}
