<?php

namespace App\Controller;

use App\Form\PayementBetType;
use App\Repository\BetRepository;
use App\Repository\WalletRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexUserController extends AbstractController
{
    /**
     * @Route("/indexuser", name="index_user")
     * @param BetRepository $betRepository
     * @param WalletRepository $walletRepository
     * @return Response
     */
    public function index(BetRepository $betRepository,WalletRepository $walletRepository): Response
    {
        $lisBet = $betRepository->findAll ();

        $user = $this->getUser();
        $credit = $walletRepository->find($user->getWallet()->getId());

        return $this->render('index_user/index.html.twig', [
            'users' => $user,
            'wallet' => $credit,
            'listBets' => $lisBet,
        ]);
    }
}
