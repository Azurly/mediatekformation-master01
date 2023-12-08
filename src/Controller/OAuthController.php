<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OAuthController extends AbstractController{

    /**
     * The code defines three routes for handling OAuth login, callback, and logout.
     * 
     * ClientRegistry The `` parameter is an instance of the
     * `ClientRegistry` class. It is used to retrieve the OAuth client configuration for a specific
     * provider. In this case, it is used to retrieve the client configuration for the "keycloak"
     * provider.
     * 
     * @return RedirectResponse In the `index` method, a `RedirectResponse` object is being returned.
     */
    /**
     * @Route("/oauth/login", name="oauth_login")
     */
    public function index(ClientRegistry $clientRegistry): RedirectResponse{
        return $clientRegistry->getClient('keycloak')->redirect();
    }
    /**
     * @Route("oauth/callback", name="oauth_check")
     */
    public function connectCheckAction(Request $request, ClientRegistry $clientRegistry){

    }
    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){
        
    }
}

