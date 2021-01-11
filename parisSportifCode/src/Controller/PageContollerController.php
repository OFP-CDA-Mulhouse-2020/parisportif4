<?php

namespace App\Controller;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class PageContollerController extends AbstractController
{
    /**
     * @Route("/hello", name="page_contoller")
     */
    public function index(): Response
    {
        return $this->render('page_contoller/index.html.twig');
    }

    /**
     * @param UserInterface $user
     * @return Response
     * @Route("/auth", name="auth")
     * @IsGranted("ROLE_USER")
     */
    public function auth (UserInterface $user)
    {

        //$this->denyAccessUnlessGranted ('IS_AUTHENTICATED_FULLY');
        $user = $user->getUsername ();


        $repository= $this->getDoctrine ()->getRepository (User::class);
        $users = $repository->findOneBy (['email' => $user]);
        //var_dump ($users);

        return $this->render('page_contoller/index.html.twig',[
            'controller_name' => 'HomeController',
            'users' => $users
        ]);
    }
}
