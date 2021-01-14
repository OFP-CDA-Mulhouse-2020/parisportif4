<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserEmailType;
use App\Form\EditUserPasswordType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ProfileController extends AbstractController
{
    /**
     * @return Response
     * @Route("/auth", name="auth")
     * @IsGranted("ROLE_USER")
     */
    public function auth ()
    {
        $this->denyAccessUnlessGranted ('IS_AUTHENTICATED_FULLY');
        $users = $this->getUser();
        return $this->render('page_contoller/index.html.twig',[
            'controller_name' => 'HomeController',
            'users' => $users
        ]);
    }

    /**
     * @Route("/auth/edit", name="page_edit")
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted ('IS_AUTHENTICATED_FULLY');
        $users = $this->getUser();
        return $this->render('page_contoller/editOption.html.twig',[
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
    public function userProfileEditPassword(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder
    ): Response {

        $user = $this->getUser();

        $formPassword = $this->createForm(EditUserPasswordType::class, $user);
        $formEmail = $this->createForm (EditUserEmailType::class);
        $formPassword->handleRequest($request);


        if ($formPassword->isSubmitted() && $formPassword->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $oldpwd = $request->request->get('edit_user_password')['oldPassword'];

            if($passwordEncoder->isPasswordValid ($user,$oldpwd)) {

                $user -> setPassword (
                    $passwordEncoder -> encodePassword (
                        $user ,
                        $user -> getPlainPassword ()
                    )
                );
                $entityManager -> persist ( $user );
                $entityManager -> flush ();

                $this->addFlash ('success','Votre mot de passe à bien été changé !');

            }else {
                $formPassword->addError (new FormError('Old password incorrect'));
            }

        }

        return $this->render('page_contoller/editPassword.html.twig', [
            'user' => $user,
            'formEdit' => $formPassword->createView(),
            'formEmail' => $formEmail->createView (),
            'editPassword' => true,
            'editEmail' => false,
        ]);
    }

    /**
     * @param UserInterface $user
     * @return Response
     * @Route("/auth/edit/email", name="auth_edit_email")
     * @IsGranted("ROLE_USER")
     */
    public function editUserEmail(UserInterface $user ): Response
    {
        $user = $this->getUser();
        $formEmail = $this->createForm (EditUserEmailType::class);
        $formPassword = $this->createForm(EditUserPasswordType::class, $user);

        return $this->render ('page_contoller/editEmail.html.twig',[
            'user' => $user,
            'formEmail' => $formEmail->createView (),
            'formEdit' => $formPassword->createView(),
            'editPassword' => false,
            'editEmail' => true,
        ]);

    }
}
