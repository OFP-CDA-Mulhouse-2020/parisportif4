<?php


namespace App\Controller\Admin;


use App\Repository\BetRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ResultBetController extends AbstractController
{
    /**
     * @param BetRepository $betRepository
     * @return Response
     * @Route("/admin", name="admin_R")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(BetRepository $betRepository)
    {
        $bet = $betRepository->findAll ();

        return $this->render('Admin/index.html.twig', [
            'listOfBet'=> $bet

        ]);
    }

}