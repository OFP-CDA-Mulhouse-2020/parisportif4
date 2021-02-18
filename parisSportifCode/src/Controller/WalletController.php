<?php

namespace App\Controller;

use App\Entity\Wallet;
use App\Form\AddMoneyWalletType;
use App\Repository\WalletRepository;
use App\Services\DataBaseManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WalletController extends AbstractController
{
    /**
     * @param WalletRepository $walletRepository
     * @return Response
     * @IsGranted("ROLE_USER")
     * @Route("/wallet", name="wallet")
     */
    public function index(WalletRepository $walletRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $users = $this->getUser();
        $active = $users->getUserValidation();
        $credit = $walletRepository->find($users->getWallet()->getId());
        return $this->render('page_wallet/index.html.twig', [
            'controller_name' => 'WalletController',
            'users' => $users,
            'wallet' => $credit,
            'active' => $active,
        ]);
    }

    /**
     * @param Request $request
     * @param DataBaseManager $dbmanager
     * @param WalletRepository $walletRepository
     * @return Response
     * @IsGranted("ROLE_USER")
     * @Route("/wallet/add", name="wallet_add")
     */
    public function addMoney(Request $request,
                             DataBaseManager $dbmanager,
                             WalletRepository $walletRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $users = $this->getUser();
        $wallet = $users->getWallet();
        $active = $users->getUserValidation();
        $credit = $walletRepository->find($users->getWallet()->getId());
        $formWallet = $this->createForm(AddMoneyWalletType::class);
        $formWallet->handleRequest($request);

        if ($formWallet->isSubmitted() && $formWallet->isValid()) {
            if($active == true) {
                $money = $formWallet->get('credit')->getData();
                $wallet->addToCredit($money);
                $dbmanager->insertDataIntoBase($wallet);
                $this->addFlash('success', 'La somme a bien été ajoutée à vos fonds!');
            }else {
                $this->addFlash('errorA', 'Veuillez activer votre compte pour parier ');
            }
        }
        return $this->render('page_wallet/addMoney.html.twig', [
           'controller_name' => 'WalletController',
           'users' => $users,
           'formWallet' => $formWallet->createView(),
            'wallet' => $credit,
            'active' => $active,
        ]);
    }

    /**
     * @param Request $request
     * @param DataBaseManager $dbmanager
     * @param WalletRepository $walletRepository
     * @return Response
     * @IsGranted("ROLE_USER")
     * @Route("/wallet/withdraw", name="wallet_draw")
     */
    public function drawMoney(Request $request,
                              DataBaseManager $dbmanager,
                              WalletRepository $walletRepository): Response
    {
        $users = $this->getUser();
        $active = $users->getUserValidation();
        $wallet = $users->getWallet();
        $credit = $walletRepository->find($users->getWallet()->getId());

        $formWallet = $this->createForm(AddMoneyWalletType::class);
        $formWallet->handleRequest($request);

        if ($formWallet->isSubmitted() && $formWallet->isValid()) {
            if($active == true){
            $money = $formWallet->get('credit')->getData();
            $limit = $wallet->getCredit();
            if ($money <= $limit) {
                $wallet->removeFromCredit($money);
                $dbmanager->insertDataIntoBase($wallet);
                $this->addFlash('success', 'La somme a bien été retirée de vos fonds!');
            } else {
                $this->addFlash('errorC','crédit insuffisant');
            }
        }else{
                $this->addFlash('errorA', 'Veuillez activer votre compte d\'abord ');
            }}
        return $this->render('page_wallet/withdrawMoney.html.twig', [
            'controller_name' => 'WalletController',
            'users' => $users,
            'formWallet' => $formWallet->createView(),
            'wallet' => $credit,
            'active' => $active,
        ]);
    }
}
