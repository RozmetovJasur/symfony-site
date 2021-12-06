<?php
/**
 *
 * Created by PhpStorm.
 * User: Rozmetov Jasur ( @rozmetovjasur )
 * Date: 12/3/21
 * Time: 9:42 PM
 */

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AdminBaseController
{
    /**
     * @Route("/admin/product",name="admin_product")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        return $this->render('admin/product/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/admin/product/create",name="admin_product_create")
     */
    public function create(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setIsPublish();
            $em->persist($product);
            $em->flush();

            $this->addFlash("success","Ma'lumotlar muvaffaqiyatli saqlandi.");

            return $this->redirectToRoute('admin_product');
        }

        return $this->render('admin/product/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}