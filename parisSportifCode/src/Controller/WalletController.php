<?php


namespace App\Controller;


use App\Entity\Wallet;
use App\Form\AddMoneyWalletType;
use App\Repository\WalletRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WalletController extends AbstractController
{
    /**
     * @return Response
     * @IsGranted("ROLE_USER")
     * @Route("/wallet", name="wallet")
     */
    public function index(WalletRepository $walletRepository):Response {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $users = $this->getUser();
        $credit = $walletRepository->find ($users->getWallet()->getId());
        return $this->render('page_wallet/index.html.twig', [
            'controller_name' => 'WalletController',
            'user' => $users,
            'wallet' => $credit,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @IsGranted("ROLE_USER")
     * @Route("/wallet/add", name="wallet_add")
     */
    public function addMoney(Request $request) :Response {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $users = $this->getUser();
        $wallet = new Wallet();
        $formWallet = $this->createForm (AddMoneyWalletType::class,$wallet);
        $formWallet->handleRequest ($request);

        if($formWallet->isSubmitted () && $formWallet->isValid ()) {
            $entityManager = $this->getDoctrine ()->getManager ();

            $users->setWallet($wallet->addToCredit($wallet->getCredit ()));


            $entityManager -> persist($wallet);
            $entityManager -> flush();
            $this->addFlash('success', 'la somme a bien été ajouter !');
        }

        return $this->render('page_wallet/addMoney.html.twig', [
           'controller_name' => 'WalletController',
           'user' => $users,
           'formWallet' => $formWallet->createView (),
        ]);
    }

}