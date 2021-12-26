<?php
/**
 *
 * Created by PhpStorm.
 * User: Rozmetov Jasur ( @rozmetovjasur )
 * Date: 10/30/21
 * Time: 8:26 PM
 */

namespace App\Controller\Admin;


use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AdminBaseController
{

    /**
     * @Route("/admin",name="admin_home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }

}