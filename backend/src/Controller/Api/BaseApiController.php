<?php
/**
 *
 * Created by PhpStorm.
 * User: Rozmetov Jasur ( @rozmetovjasur )
 * Date: 26.12.2021
 * Time: 20:51
 */

namespace App\Controller\Api;

use App\Form\FormErrorSerializer;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

class BaseApiController extends AbstractFOSRestController
{
    protected function response($data, int $statusCode = Response::HTTP_OK, array $groups = []): Response
    {
        $view = $this->view($data, $statusCode);
        if (!empty($groups)) {
            $view->setContext((new Context())->setGroups($groups));
        }
        return $this->handleView($view);
    }

    protected function validationResponse(FormInterface $form): Response
    {
        return $this->response((new FormErrorSerializer())
            ->serializeFormErrors($form),
            Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}