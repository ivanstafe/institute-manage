<?php

namespace App\Controller;

use App\Entity\Aula;
use App\Form\AulaType;
use App\Repository\AulaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/aula")
 */
class AulaController extends AbstractController
{
    /**
     * @Route("/", name="app_aula_index", methods={"GET"})
     */
    public function index(AulaRepository $aulaRepository): Response
    {
        return $this->render('aula/index.html.twig', [
            'aulas' => $aulaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/aulaUser", name="app_aula_index_user", methods={"GET"})
     */
    public function indexUser(AulaRepository $aulaRepository): Response
    {
        return $this->render('aula/index_user.html.twig', [
            'aulas' => $aulaRepository->findAll(),
        ]);
    }
    /**
     * @Route("/new", name="app_aula_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AulaRepository $aulaRepository, SluggerInterface $slugger): Response
    {
        $aula = new Aula();
        $form = $this->createForm(AulaType::class, $aula);
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
                $aula->setImagen($newFilename);
            }

            $aulaRepository->add($aula, true);

            return $this->redirectToRoute('app_aula_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('aula/new.html.twig', [
            'aula' => $aula,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_aula_show", methods={"GET"})
     */
    public function show(Aula $aula): Response
    {
        return $this->render('aula/show.html.twig', [
            'aula' => $aula,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_aula_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Aula $aula, AulaRepository $aulaRepository): Response
    {
        $form = $this->createForm(AulaType::class, $aula);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $aulaRepository->add($aula, true);

            return $this->redirectToRoute('app_aula_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('aula/edit.html.twig', [
            'aula' => $aula,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_aula_delete", methods={"POST"})
     */
    public function delete(Request $request, Aula $aula, AulaRepository $aulaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aula->getId(), $request->request->get('_token'))) {
            $aulaRepository->remove($aula, true);
        }

        return $this->redirectToRoute('app_aula_index', [], Response::HTTP_SEE_OTHER);
    }
}
