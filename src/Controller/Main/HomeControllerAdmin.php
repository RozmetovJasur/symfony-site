<?php
/**
 *
 * Created by PhpStorm.
 * User: Rozmetov Jasur ( @rozmetovjasur )
 * Date: 10/30/21
 * Time: 8:26 PM
 */

namespace App\Controller\Main;


use Symfony\Component\Routing\Annotation\Route;

class HomeControllerAdmin extends BaseController
{

    /**
     * @Route("/",name="home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('main/index.html.twig');
    }

}