<?php

namespace App\Controller;

use App\Entity\Show;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowController extends AbstractController
{
    /**
     * Le paramConverter de Doctrine va utiliser le paramètre d'url pour trouver l'entité demandée
     * Si on typehint avec Show, alors doctrine va utiliser le repository correspondant, puis utiliser la méthode findOneBy(nom du param d'url => valeur)
     * Permet d'éviter tout ce qui est commenté dans la méthode.
     * 
     * @Route("/show/{id}", name="show_detail", methods={"GET"}, requirements={ "id" = "\d+"})
     */
    public function showDetail(Show $show): Response
    {
        // $showRepository = $this->getDoctrine()->getRepository(Show::class);
        // $show = $showRepository->find($id);

        // if (empty($show)) {
        //     throw $this->createNotFoundException('La série ' . $id .' n\'existe pas !');
        // }

        return $this->render('show/detail.html.twig',[ 'show' => $show ]);
    }

    /**
    * @Route("/show/list", name="show_list", methods={"GET"})
     */
    public function showList(): Response
    {
        $showRepository = $this->getDoctrine()->getRepository(Show::class);
        $shows = $showRepository->findAll();

        return $this->render('show/list.html.twig', [ 'shows' => $shows ]);    }
}
