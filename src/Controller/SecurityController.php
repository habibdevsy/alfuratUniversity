<?php

namespace App\Controller;

use App\Entity\UserRegistration;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/registration", name="creat_admin")
     */
    public function registration(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $data = new UserRegistration();
       
        $form = $this->createForm(RegistrationType::class, $data);
        $form->handleRequest($request);
        $data->setRoles(['ROLE_ADMIN']);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $data->setPassword($encoder->encodePassword($data, $data->getPassword()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($data);
            $entityManager->flush();
            $entityManager->clear();
            return $this->redirectToRoute('show_users');
            
        } 
        return $this->render('register/index.html.twig', [
       
            'registrationform' => $form->createView()
        ]);
     }
     
    /**
     * @Route("/userregistration", name="creat_user")
     */
    public function userRegistration(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $data = new UserRegistration();
       
        $form = $this->createForm(RegistrationType::class, $data);
        $form->handleRequest($request);
        $data->setRoles(['ROLE_USER']);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $data->setPassword($encoder->encodePassword($data, $data->getPassword()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($data);
            $entityManager->flush();
            $entityManager->clear();
            return $this->redirectToRoute('show_users');
            
        } 
        return $this->render('register/index.html.twig', [
       
            'registrationform' => $form->createView()
        ]);
     }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
       
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
