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

class HomeController extends BaseController
{

    /**
     * @Route("/",name="home")
     */
    public function index()
    {
        return $this->render('main/index.html.twig',[
            'title' => "Bosh sahifa"
        ]);
    }

}