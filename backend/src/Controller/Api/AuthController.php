<?php
/**
 *
 * Created by PhpStorm.
 * User: Rozmetov Jasur ( @rozmetovjasur )
 * Date: 26.12.2021
 * Time: 18:18
 */

namespace App\Controller\Api;

use App\Entity\User;
use App\Form\UserType;
use FOS\RestBundle\Controller\Annotations as Rest;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Rest\Route("/api")
 */
class AuthController extends BaseApiController
{
    /**
     * @Rest\Post("/sign-up")
     */
    public function signUp(Request $request, UserPasswordHasherInterface $passwordEncoder, FormFactoryInterface $formFactory): Response
    {
        $user = new User();
        $form = $formFactory->createNamed('', UserType::class, $user)
            ->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->hashPassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setRoles(["ROLE_ADMIN"]);
            $em->persist($user);
            $em->flush();

            return $this->response($user, Response::HTTP_OK);
        }
        return $this->response($form, Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Rest\Get("/check")
     */
    public function check(JWTTokenManagerInterface $JWTManager)
    {
        try {
            return $this->response($JWTManager->create($this->getUser()), Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->response("token is not valid", Response::HTTP_BAD_REQUEST);
        }
    }
}