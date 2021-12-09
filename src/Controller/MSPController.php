<?php

namespace App\Controller;


use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;



class MSPController extends AbstractController
{


    public function index(ProjectRepository $repo): Response
    {
        $repo = $this->getDoctrine()->getRepository(Project::class); 
        $projects = $repo->findAll();

        dump($projects);    

        return $this->render('msp/index.html.twig', ['projects' => $projects]);

    }



    public function add(Request $request) {

        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if ($project->getImage() != null) {
                $file = $form->get('image')->getData();
                $fileName = uniqid(). '.' .$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('images_directory'), $fileName);
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }
                $project->setImage($fileName);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return new Response('Saved project 🐀');
        }

        return $this->render('msp/add.html.twig', [
            'form' => $form->createView()
        ]);
    }



    public function read(Project $project) {
        return $this->render('msp/project.html.twig', [
            'project' => $project
        ]);
    }


    public function edit(Project $project, Request $request)
    {
        $oldImage = $project->getImage();

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if ($project->getImage() != null) {
                $file = $form->get('image')->getData();
                $fileName = uniqid(). '.' .$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('images_directory'), $fileName);
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }
                $project->setImage($fileName);
            } else {
                $project->setImage($oldImage);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return new Response('Saved project 🐀');
        }

        return $this->render('msp/edit.html.twig', [
            'project' => $project,
            'form' => $form->createView()
        ]);
    }
}
