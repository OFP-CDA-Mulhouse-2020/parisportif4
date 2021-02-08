<?php

namespace App\Controller;


use App\Repository\BetRepository;
use App\Repository\EvenementSportRepository;
use App\Repository\WalletRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexUserController extends AbstractController
{
    /**
     * @Route("/indexuser", name="index_user")
     * @param BetRepository $betRepository
     * @param WalletRepository $walletRepository
     * @param EvenementSportRepository $evenementSportRepository
     * @return Response
     */
    public function index(BetRepository $betRepository,
                          WalletRepository $walletRepository,
    EvenementSportRepository $evenementSportRepository): Response
    {
        $listEvenement = $evenementSportRepository->findAll();
        $lisBet = $betRepository->findAll ();

        $user = $this->getUser();
        $credit = $walletRepository->find($user->getWallet()->getId());

        return $this->render('index_user/index.html.twig', [
            'users' => $user,
            'wallet' => $credit,
            'ListEvenements' => $listEvenement,
            'listBets' => $lisBet,
        ]);
    }
}
