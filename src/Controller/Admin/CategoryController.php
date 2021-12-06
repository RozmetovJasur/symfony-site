<?php
/**
 *
 * Created by PhpStorm.
 * User: Rozmetov Jasur ( @rozmetovjasur )
 * Date: 12/6/21
 * Time: 9:36 PM
 */

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AdminBaseController
{

    /**
     * @Route("/admin/category",name="admin_category")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('admin/category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/admin/category/create",name="admin_category_create")
     */
    public function create(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category, [
            'attr' => [
                "class" => "row"
            ]
        ]);
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category->setCreateAt(new \DateTimeImmutable());
            $category->setUpdateAt(new \DateTimeImmutable());
            $em->persist($category);
            $em->flush();

            $this->addFlash("success", "Ma'lumotlar muvaffaqiyatli saqlandi.");

            return $this->redirectToRoute('admin_category');
        }

        return $this->render('admin/category/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

}