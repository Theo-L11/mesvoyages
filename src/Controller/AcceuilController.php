<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AcceuilController
 *
 * @author Titi L
 */
class AcceuilController {
    
    /**
     * @Route("/", name="acceuil")
     * @return Response
     */
    public function index() : Response{
        return new Response('Hello World !');
    }
}
