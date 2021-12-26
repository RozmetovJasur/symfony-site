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
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AdminBaseController
{

    /**
     * @Route("/admin/category",name="admin_category")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request,PaginatorInterface $paginator)
    {
        $query = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/category/index.html.twig', [
            'categories' => $pagination,
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
            $em->persist($category);
            $em->flush();

            $this->addFlash("success", "Ma'lumotlar muvaffaqiyatli saqlandi.");

            return $this->redirectToRoute('admin_category');
        }

        return $this->render('admin/category/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/category/update/{category}",name="admin_category_update")
     */
    public function update(Request $request, Category $category)
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);


        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($category);
            $em->flush();

            $this->addFlash("success", "Ma'lumotlar muvaffaqiyatli saqlandi.");
            return $this->redirectToRoute('admin_category');
        }

        return $this->render('admin/category/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/category/delete/{category}",name="admin_category_delete")
     */
    public function delete(Request $request, Category $category)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($category);
        $em->flush();

        $this->addFlash('danger', "Ma'lumot muvaffaqiyatli o'chirildi");

        return $this->redirectToRoute('admin_category');
    }

}