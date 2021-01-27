<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Wallet;
use App\Form\RefisteruserType;
use App\Service\DataBaseManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{

    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @Route("/register", name="user_registration")
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, DataBaseManager $dbmanager): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        $user = new User();
        $user->setWallet(new Wallet());

        return $this->handleRegistrationForm($request, $user, $passwordEncoder, $dbmanager);
    }

    /**
     * @param Request $request
     * @param User $user
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    private function handleRegistrationForm(
        Request $request,
        User $user,
        UserPasswordEncoderInterface $passwordEncoder,
        DataBaseManager $dbmanager
    ): Response {
        $form = $this->createForm(RefisteruserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $dbmanager->insertDataIntoBase($user);


            return $this->redirectToRoute('app_login');
        }
        return $this->render(
            'register/index.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
