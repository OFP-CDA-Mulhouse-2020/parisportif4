<?php

namespace App\Controller;

use App\Repository\BetRepository;
use App\Repository\BetUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BetListController extends AbstractController
{
    /**
     * @param BetUserRepository $betUserRepository
     * @param BetRepository $betRepository
     * @return Response
     * @Route("/bet/list", name="bet_list")
     */
    public function index(BetUserRepository $betUserRepository, BetRepository $betRepository): Response
    {
        $user = $this->getUser();
        
        $id = $user->getId();
        $betsUser = $betUserRepository->findBy(
            ['user' => $id]
        );
        
        
        // $betID = $user->getBetUsers()->getBet();
        // $bet = $betRepository->findBy(
        // ['id' => $betID]
        // );
        // $betName = $bet[0]->getNameBet();
        // dd($betID);
        


        return $this->render('bet_list/index.html.twig', [
            'controller_name' => 'BetListController',
            'user' => $user,
            'betsUser' => $betsUser,
            // 'betName' => $betName
        ]);
    }
}
