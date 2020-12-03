<?php

namespace App\Controller;

use App\Entity\Show;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        $showRepository = $this->getDoctrine()->getRepository(Show::class);
        $shows = $showRepository->findAll();

        return $this->render('default/homepage.html.twig', [ 'shows' => $shows ]);
    }
}
