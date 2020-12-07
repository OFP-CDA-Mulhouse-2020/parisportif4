<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @return Response
     * @Route("/auth", name="auth")
     * @IsGranted("ROLE_USER")
     */
    public function auth ()
    {
        return $this->render('page_contoller/index.html.twig');
    }
}
