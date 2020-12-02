<?php

namespace App\Controller;

use App\Entity\Show;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        $show = new Show();
        $show->setTitle('Mr. Robot');

        // ask doctrine the entity manager
        $manager = $this->getDoctrine()->getManager();
        // entity manager take charge of my object
        $manager->persist($show);
        // manager save all changes to my database
        $manager->flush();

        return $this->render('show/index.html.twig', [
            'show' => $show,
        ]);
    }
}
