<?php
/**
 *
 * Created by PhpStorm.
 * User: Rozmetov Jasur ( @rozmetovjasur )
 * Date: 12.03.2022
 * Time: 16:01
 */

namespace App\Controller\Api;


use App\Entity\Product;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\Route("/api")
 */
class ProductController extends BaseApiController
{
    /**
     * @Rest\Get("/products", name="api_products_list")
     */
    public function index(Request $request, ProductRepository $repository, PaginatorInterface $paginator)
    {
        return $this->response($paginator
            ->paginate($repository->filterQueryBuilder($request->query->all() ?: []),
                $request->query->getInt('page', 1),
                $request->query->getInt('size', 25)
            ), Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/products/{product}", name="api_products_one")
     */
    public function one(Request $request, Product $product)
    {
        return $this->response($product, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/products-by-id", name="api_products_by_id")
     * @Rest\QueryParam(name="id", requirements="\d+")
     */
    public function productsById(Request $request, FormFactoryInterface $formFactory, ProductRepository $repository)
    {
        $filter = $formFactory
            ->createNamed('', FormType::class, null, [
                'method' => 'GET',
            ])
            ->add('id', CollectionType::class, [
                'entry_type' => IntegerType::class,
                'allow_add' => true,
                'prototype' => true,
            ])
            ->handleRequest($request);

        $data = $filter->getData() ?: [];

        if (isset($data['id'])) {
            if (empty($data['id'])) {
                $data['id'] = [0];
            }
        }

        return $repository->findById($data['id']);
    }
}