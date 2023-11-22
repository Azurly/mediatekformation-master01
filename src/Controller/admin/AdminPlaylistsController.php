<?php
namespace App\Controller\admin;

use App\Form\PlaylistType;

    use App\Entity\Playlist;
    use App\Repository\PlaylistRepository;
    use Symfony\Component\PropertyInfo\Type;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    /**
     * Controleur des playlists
     *
     * @author emds
     */
    class AdminPlaylistsController extends AbstractController {

        const CHEMINADMINPLAYLISTSTWIG = "admin/admin.playlists.html.twig";
        /**
         * @var PlaylistRepository
         */
        private $playlistRepository;
        
       
        
        public function __construct(
                PlaylistRepository $playlistRepository) {
            $this->playlistRepository = $playlistRepository;
        }
        
        /**
         * @Route("/admin/playlists", name="admin.playlists")
         * @return Response
         */
        public function index(): Response{
            $playlists = $this->playlistRepository->findAll();
            return $this->render(self::CHEMINADMINPLAYLISTSTWIG, [
                'playlists' => $playlists,
            ]);
        }
        /**
         * @Route("/admin/playlists/suppr/{id}", name="admin.playlists.suppr")
         * @param Playlist $playlist
         * @return Response
         */
        public function suppr(Playlist $playlist):Response{
            $this->playlistRepository->remove($playlist, true);
            return $this->redirectToRoute('admin.playlists');
        }
        /**
         * @Route("/admin/playlists/edit/{id}", name="admin.playlists.edit")
         * @param Playlist $playlist
         * @param Request $request
         * @return Response
         */
        public function edit(Playlist $playlist, Request $request): Response{
            $formPlaylist = $this->createForm(PlaylistType::class, $playlist);

            $formPlaylist->handleRequest($request);
            if($formPlaylist->isSubmitted() && $formPlaylist->isValid()){
                $this->playlistRepository->add($playlist, true);
                return $this->redirectToRoute('admin.playlists');
            }
            
            return $this->render("admin/admin.playlists.edit.html.twig", [
                'playlist' => $playlist,
                'formPlaylist'=> $formPlaylist->createView()
            ]);
        }
        /**
         * @Route("/admin/playlists/ajout", name="admin.playlists.ajout")
         * @param Request $request
         * @return Response
         */
        public function ajout(Request $request): Response{
            $playlist = new Playlist();
            $formPlaylist = $this->createForm(PlaylistType::class, $playlist);

            $formPlaylist->handleRequest($request);
            if($formPlaylist->isSubmitted() && $formPlaylist->isValid()){
                $this->playlistRepository->add($formPlaylist, true);
                return $this->redirectToRoute('admin.playlists');
            }

            return $this->render('admin/admin.playlists.ajout.html.twig', [
                'playlist'=> $playlist,
                'formPlaylist'=> $formPlaylist->createView()
            ]);
        }
    }
