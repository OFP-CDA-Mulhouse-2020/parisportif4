<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RefisteruserType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="user_registration")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return RedirectResponse|Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(RefisteruserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setFirstname ($user->getFirstname ());
            $user->setLastname ($user->getLastname ());
            $user->setBirthDate ($user->getBirthDate ());
            $user->setPhone ($user->getPhone ());
            $user->setStreetNumber ('AB');
            $user->setStreet ($user->getStreet ());
            $user->setCity ($user->getCity ());
            $user->setCodePostal ($user->getCodePostal ());

            //$user->setCreateDate (new DateTime());
          
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this -> redirectToRoute ('app_login');
        }

        return $this->render(
            'register/index.html.twig',
            array('form' => $form->createView())
        );
    }
}
