<?php
/**
 *
 * Created by PhpStorm.
 * User: Rozmetov Jasur ( @rozmetovjasur )
 * Date: 28.12.2021
 * Time: 21:57
 */

namespace App\Controller\Api;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\Route("/api/user")
 */
class UserController extends BaseApiController
{
    /**
     * @Rest\Get("/")
     */
    public function index()
    {
        return $this->response($this->getUser(), Response::HTTP_OK);
    }
}