<?php

namespace SoftUniBlogBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SoftUniBlogBundle\Entity\Category;
use SoftUniBlogBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("admin/categories")
 * Class CategoryController
 * @package SoftUniBlogBundle\Controller\Admin
 */
class CategoryController extends Controller
{
    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @Route("/", name="admin_categories")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listCategories()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        return $this->render('admin/category/list.html.twig',[
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/create", name="admin_categories_create")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createCategory(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType:: class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('admin_categories');
        }

        return $this->render('admin/category/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
