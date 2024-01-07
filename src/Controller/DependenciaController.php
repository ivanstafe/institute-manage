<?php

namespace App\Controller;

use App\Entity\Dependencia;
use App\Form\DependenciaType;
use App\Repository\DependenciaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;
/**
 * @Route("/dependencia")
 */
class DependenciaController extends AbstractController
{
    /**
     * @Route("/", name="app_dependencia_index", methods={"GET"})
     */
    public function index(DependenciaRepository $dependenciaRepository): Response
    {
        return $this->render('dependencia/index.html.twig', [
            'dependencias' => $dependenciaRepository->findAll(),
        ]);
    }
     /**
     * @Route("/dependenciaUser", name="app_dependencia_index_user", methods={"GET"})
     */
    public function indexUser(DependenciaRepository $dependenciaRepository): Response
    {
        return $this->render('dependencia/index_user.html.twig', [
            'dependencias' => $dependenciaRepository->findAll(),
        ]);
    }


    /**
     * @Route("/new", name="app_dependencia_new", methods={"GET", "POST"})
     */
    public function new(Request $request, DependenciaRepository $dependenciaRepository, SluggerInterface $slugger): Response
    {
        $dependencium = new Dependencia();
        $form = $this->createForm(DependenciaType::class, $dependencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imagen = $form->get('imagen')->getData();
            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($imagen) {
                $originalFilename = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imagen->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $imagen->move(
                        $this->getParameter('imagenes_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    throw new \Exception ('Error al subir la foto');
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $dependencium->setImagen($newFilename);
            }
            $dependenciaRepository->add($dependencium, true);

            return $this->redirectToRoute('app_dependencia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dependencia/new.html.twig', [
            'dependencium' => $dependencium,
            'form' => $form,
        ]);
    }

    /**
     * @Route("dependencia/{id}", name="app_dependencia_show", methods={"GET"})
     */
    public function show(Dependencia $dependencium): Response
    {
        return $this->render('dependencia/show.html.twig', [
            'dependencium' => $dependencium,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_dependencia_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Dependencia $dependencium, DependenciaRepository $dependenciaRepository): Response
    {
        $form = $this->createForm(DependenciaType::class, $dependencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dependenciaRepository->add($dependencium, true);

            
            return $this->redirectToRoute('app_dependencia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dependencia/edit.html.twig', [
            'dependencium' => $dependencium,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dependencia_delete", methods={"POST"})
     */
    public function delete(Request $request, Dependencia $dependencium, DependenciaRepository $dependenciaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dependencium->getId(), $request->request->get('_token'))) {
            $dependenciaRepository->remove($dependencium, true);
        }

        return $this->redirectToRoute('app_dependencia_index', [], Response::HTTP_SEE_OTHER);
    }
}
