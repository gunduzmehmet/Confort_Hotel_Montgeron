<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarrouselController extends AbstractController
{
    /**
     * @Route("/carrousel", name="carrousel")
     */
    public function index(): Response
    {
        return $this->render('carrousel/index.html.twig', [
            
        ]);
    }
}




