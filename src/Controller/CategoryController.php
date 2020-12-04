<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="categories_list")
     */
    public function categoryList(): Response
    {
        /** @var CategoryRepository $categoryRepository */
        $categoryRepository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $categoryRepository->findAllOrderedByLabel();

        return $this->render('category/list.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category/{label}", name="category_detail", requirements={ "label" = "^[a-zA-Z]+$" })
     *
     */
    public function categoryDetail(Category $category) : Response
    {
        return $this->render('category/detail.html.twig', [
            'category' => $category,
        ]);
    }
}
