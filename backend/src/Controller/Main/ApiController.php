<?php
/**
 *
 * Created by PhpStorm.
 * User: Rozmetov Jasur ( @rozmetovjasur )
 * Date: 18.12.2021
 * Time: 20:18
 */

namespace App\Controller\Main;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class ApiController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/products",name="api_get_products")
     */
    public function index()
    {
        return $this->json([
            1 => "test"
        ]);
    }

}