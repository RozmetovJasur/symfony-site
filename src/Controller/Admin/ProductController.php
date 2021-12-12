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
use App\Service\File\FileManagerServiceInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AdminBaseController
{
    /**
     * @Route("/admin/product",name="admin_product")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $query = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findBy([],['id' => "DESC"]);
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/product/index.html.twig', [
            'products' => $pagination,
        ]);
    }

    /**
     * @Route("/admin/product/create",name="admin_product_create")
     */
    public function create(Request $request, FileManagerServiceInterface $fileManagerService)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $product->setIsPublish();
                $image = $form->get('image')->getData();
                if ($image) {
                    $fileName = $fileManagerService->uploadImage($image);
                    $product->setImage($fileName);
                }
                $em->persist($product);
                $em->flush();

                $this->addFlash("success", "Ma'lumotlar muvaffaqiyatli saqlandi.");
            } catch (\Exception $exception) {
                return $exception->getMessage();
            }

            return $this->redirectToRoute('admin_product');
        }

        return $this->render('admin/product/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/product/update/{product}",name="admin_product_update")
     */
    public function update(Request $request, Product $product, FileManagerServiceInterface $fileManagerService)
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();
            $imageOld = $product->getImage();
            if ($image) {
                if ($imageOld) {
                    $fileManagerService->removeImage($imageOld);
                }

                $fileName = $fileManagerService->uploadImage($image);
                $product->setImage($fileName);
            }

            $em->persist($product);
            $em->flush();

            $this->addFlash("success", "Ma'lumotlar muvaffaqiyatli saqlandi.");
            return $this->redirectToRoute('admin_product');
        }

        return $this->render('admin/product/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/product/delete/{product}",name="admin_product_delete")
     */
    public function delete(Product $product, FileManagerServiceInterface $fileManagerService)
    {
        $em = $this->getDoctrine()->getManager();

        if ($product->getImage()) {
            $fileManagerService->removeImage($product->getImage());
        }

        $em->remove($product);
        $em->flush();

        $this->addFlash('success', "Ma'lumot muvaffaqiyatli o'chirildi");

        return $this->redirectToRoute('admin_product');
    }
}