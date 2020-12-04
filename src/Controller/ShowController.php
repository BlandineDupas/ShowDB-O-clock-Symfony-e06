<?php

namespace App\Controller;

use App\Entity\Show;
use App\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

        return $this->render('show/list.html.twig', [ 'shows' => $shows ]);
    }

    /**
    * @Route("/show/add", name="show_add", methods={"GET"})
     */
    public function showAdd(): Response
    {
        return $this->render('show/add.html.twig');
    }

    /**
    * @Route("/show/add", name="show_add_post", methods={"POST"})
     */
    public function showAddPost(Request $request): Response
    {
        $title = $request->request->get('title');
        $synopsis = $request->request->get('synopsis');
        $directedBy = $this->getDoctrine()->getRepository(Person::class)->find(1);
        
        $show = new Show();
        $show->setTitle($title);
        $show->setSynopsis($synopsis);
        $show->setPerson($directedBy);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($show);
        $manager->flush();

        $this->addFlash('success', 'La série a bien été ajoutée');
        // return $this->render('show/add.html.twig');

        return $this->redirectToRoute('homepage');
    }
}
