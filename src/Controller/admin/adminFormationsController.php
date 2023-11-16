<?php

    namespace App\Controller\admin;

    use App\Entity\Formation;
    use App\Repository\CategorieRepository;
    use App\Repository\FormationRepository;
    use Symfony\Component\PropertyInfo\Type;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    /**
     * Controleur des formations
     *
     * @author emds
     */
    class adminFormationsController extends AbstractController {

        const CHEMINADMINFORMATIONHTMLTWIG = "admin/admin.formations.html.twig";
        /**
         * @var FormationRepository
         */
        private $formationRepository;
        
        /**
         * @var CategorieRepository
         */
        private $categorieRepository;
        
        public function __construct(
                FormationRepository $formationRepository, 
                CategorieRepository $categorieRepository) {
            $this->formationRepository = $formationRepository;
            $this->categorieRepository= $categorieRepository;
        }
        
        /**
         * @Route("/admin/formations", name="admin.formations")
         * @return Response
         */
        public function index(): Response{
            $formations = $this->formationRepository->findAll();
            $categories = $this->categorieRepository->findAll();
            return $this->render(self::CHEMINADMINFORMATIONHTMLTWIG, [
                'formations' => $formations,
                'categories' => $categories
            ]);
        }
        /**
         * @Route("/admin/formations/suppr/{id}", name="admin.formation.suppr")
         * @param Formation $formation
         * @return Response
         */
        public function suppr(Formation $formation):Response{
            $this->formationRepository->remove($formation, true);
            return $this->redirectToRoute('admin.formations');
        }
        /**
         * @Route("/admin/formations/edit/{id}", name="admin.formation.edit")
         * @param Formation $formation
         * @return Response
         */
        public function edit(Formation $formation, $id): Response{
            return $this->render("admin/admin.formations.edit.html.twig", [
                'formation' => $formation
            ]);
        }
    }