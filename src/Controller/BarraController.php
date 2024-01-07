<?php

// src/Controller/BarraController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BarraController extends AbstractController
{
    #[Route('/barra', name: 'app_barra')]
    public function index(): Response
    {
        return $this->render('barra/index.html.twig', [
            'controller_name' => 'BarraController',
        ]);
    }

    #[Route('/institucion', name: 'app_institucion')]
    public function institucion(): Response
    {
        // Lógica para la página de institución
        return $this->render('barra/institucion.html.twig');
    }

    #[Route('/niveles', name: 'app_niveles')]
    public function niveles(): Response
    {
        // Lógica para la página de niveles
        return $this->render('barra/niveles.html.twig');
    }

    #[Route('/contacto', name: 'app_contacto')]
    public function contacto(): Response
    {
        // Lógica para la página de contacto
        return $this->render('barra/contacto.html.twig');
    }
}

