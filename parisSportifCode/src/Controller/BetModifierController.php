<?php

namespace App\Controller;

use App\Repository\BetUserRepository;
use App\Services\DataBaseManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BetModifierController extends AbstractController
{
    /**
     * @Route("/bet/betmodifier{id}", name="betmodifier{id}")
     */
    public function redirectToBetModification(int $id, BetUserRepository $betUserRepository): Response
    {

        $targetBet = $betUserRepository->find($id);

        return $this->render('bet_modifier/index.html.twig', [
            'controller_name' => 'BetModifierController',
            'targetBet' => $targetBet
        ]);
    }

    
    /**
     * @Route("/bet/betdeletionconfirmation{id}", name="confirm_delete{id}")
     */

    public function redirectToBetDeletion(int $id, BetUserRepository $betUserRepository): Response
    {
        $targetBet = $betUserRepository->find($id);

        return $this->render('bet_modifier/deletion.html.twig', [
            'controller_name' => 'BetModifierController',
            'targetBet' => $targetBet
        ]);
    }
    
    /**
     * @Route("/bet/betdeleted{id}", name="betdeleted{id}")
     */
    public function redirectToBetDeleted(int $id, BetUserRepository $betUserRepository,
    DataBaseManager $dbmanager    
    ): Response
    {

        $targetBet = $betUserRepository->find($id);
        //refund amount to wallet
        $user = $this->getUser();
        $wallet = $user->getWallet();
        $betAmount = $targetBet->getAmountBet();
        $walletAmount = $user->getWallet()->getCredit();
        $walletAmount += $betAmount;
        $wallet->addToCredit($betAmount);
        $dbmanager->insertDataIntoBase($wallet);
        //remove from db
        $dbmanager->removeDataFromBase($targetBet);


        return $this->render('bet_modifier/betDeleted.html.twig', [
            'controller_name' => 'BetModifierController',
            'targetBet' => $targetBet,
            'credit' => $walletAmount
        ]);
    }


}
