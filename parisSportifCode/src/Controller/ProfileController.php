<?php

namespace App\Controller;

use App\Form\EditUserEmailType;
use App\Form\EditUserPasswordType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfileController extends AbstractController
{
    /**
     * @return Response
     * @Route("/auth", name="auth")
     * @IsGranted("ROLE_USER")
     */
    public function auth()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $users = $this->getUser();
        return $this->render('page_contoller/index.html.twig', [
            'controller_name' => 'HomeController',
            'users' => $users
        ]);
    }

    /**
     * @Route("/auth/edit", name="page_edit")
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function editPage(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $users = $this->getUser();
        return $this->render('page_contoller/editOption.html.twig', [
            'controller_name' => 'HomeController',
            'user' => $users
        ]);
    }

    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     * @Route("/auth/edit/password", name="auth_edit_password")
     * @IsGranted("ROLE_USER")
     */
    public function EditPasswordProfile(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder
    ): Response {
        $user = $this->getUser();
        $formPassword = $this->createForm(EditUserPasswordType::class, $user);
        $formPassword->handleRequest($request);
        if ($formPassword->isSubmitted() && $formPassword->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $oldpassword = $request->request->get('edit_user_password')['oldPassword'];
            if ($passwordEncoder->isPasswordValid($user, $oldpassword)) {
                $user -> setPassword($passwordEncoder -> encodePassword($user, $user -> getPlainPassword()));
                $entityManager -> persist($user);
                $entityManager -> flush();
                $this->addFlash('success', 'Votre mot de passe à bien été changé !');
            } else {
                $formPassword->addError(new FormError('Old password incorrect'));
            }
        }
        return $this->render('page_contoller/editPassword.html.twig', [
            'user' => $user,
            'formEdit' => $formPassword->createView(),
            'editPassword' => true,
        ]);
    }

    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     * @Route("/auth/edit/email", name="auth_edit_email")
     * @IsGranted("ROLE_USER")
     */
    public function editEmailProfile(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = $this->getUser();
        $formEmail = $this->createForm(EditUserEmailType::class, $user);
        $formEmail->handleRequest($request);
        if ($formEmail->isSubmitted() && $formEmail->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $password = $request->request->get('edit_user_email')['plainPassword'];
            if ($passwordEncoder->isPasswordValid($user, $password)) {
                $user -> setEmail($request -> request -> get('edit_user_email')['email']);
                $entityManager -> persist($user);
                $entityManager -> flush();

                $this -> addFlash('success', 'Votre email a bien été changé !');
            } else {
                $formEmail->addError(new FormError('password incorrect'));
            }
        }

        return $this->render('page_contoller/editEmail.html.twig', [
            'user' => $user,
            'formEmail' => $formEmail->createView(),
            'editEmail' => true,
        ]);
    }
}