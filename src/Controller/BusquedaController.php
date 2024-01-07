<?php

namespace App\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Manager\BusquedaManager;
use App\Manager\AdministradorManager;
use App\Manager\DependenciaManager;
use App\Entity\Dependencia;
use App\Form\DependenciaType;
use App\Manager\AulaManager;
use App\Entity\Aula;
use App\Form\AulaType;

class BusquedaController extends AbstractController
{
    /**
     * @Route("/", name="app_busqueda")
     */

public function SearchAdmin( DependenciaManager $dependenciaManager, AulaManager $aulaManager ): Response
   {
       $dependencias= $dependenciaManager->getDependencias();
       $aulas= $aulaManager->getAulas();
       return $this->render('busqueda/busqueda.html.twig', compact('dependencias', 'aulas'));
  }
   /**
     * @Route("/searchUser", name="app_busqueda_user")
     */
    public function SearchUser( DependenciaManager $dependenciaManager, AulaManager $aulaManager ): Response
    {
        $dependencias= $dependenciaManager->getDependencias();
        $aulas= $aulaManager->getAulas();
        return $this->render('user/busqueda.html.twig', compact('dependencias', 'aulas'));
   }



/**
     * @Route("/dependencia", name="dependencia_mostrar", methods={"POST"})
     */
    public function showDependencia(Request $request, DependenciaManager $dependenciaManager): Response
    {
      $seleccion=$request->request->get('seleccion');
      $dependencia= $dependenciaManager->getDependencia($seleccion);

        return $this->render('dependencia/show.html.twig', [
            'dependencium' => $dependencia,
        ]);
    }

/**
     * @Route("/aula", name="aula_mostrar", methods={"POST"})
     */
    public function showAula(Request $request, AulaManager $aulaManager): Response
    {
      $seleccion=$request->request->get('seleccion');
      $aula= $aulaManager->getAula($seleccion);

        return $this->render('aula/show.html.twig', [
            'aula' => $aula,
        ]);
    }

    /**
     * @Route("/dependenciaUser", name="dependencia_mostrar_user", methods={"POST"})
     */
    public function showDependenciaUser(Request $request, DependenciaManager $dependenciaManager): Response
    {
      $seleccion=$request->request->get('seleccion');
      $dependencia= $dependenciaManager->getDependencia($seleccion);

        return $this->render('dependencia/show_user.html.twig', [
            'dependencium' => $dependencia,
        ]);
    }

/**
     * @Route("/aulaUser", name="aula_mostrar_user", methods={"POST"})
     */
    public function showAulaAdminUser(Request $request, AulaManager $aulaManager): Response
    {
      $seleccion=$request->request->get('seleccion');
      $aula= $aulaManager->getAula($seleccion);

        return $this->render('aula/show_user.html.twig', [
            'aula' => $aula,
        ]);
    }
}
