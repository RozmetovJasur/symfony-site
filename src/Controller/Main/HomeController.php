<?php
/**
 *
 * Created by PhpStorm.
 * User: Rozmetov Jasur ( @rozmetovjasur )
 * Date: 10/30/21
 * Time: 8:26 PM
 */

namespace App\Controller\Main;


use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends BaseController
{
    private ProductRepository $productRepository;
    private CategoryRepository $categoryRepository;

    public function __construct(ProductRepository  $productRepository,
                                CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @Route("/",name="home")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        return $this->render('main/index.html.twig', [
            'title' => "Bosh sahifa",
        ]);
    }


    /**
     * @Route("/products",name="app_products")
     */
    public function products(Request $request, PaginatorInterface $paginator): Response
    {
        $query = $this->productRepository
            ->findBy([], ['id' => "DESC"]);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        $categories = $this->categoryRepository->findAll();

        return $this->render('main/products.html.twig', [
            'products' => $pagination,
            'title' => "Tovar",
            'categories' => $categories
        ]);
    }


}