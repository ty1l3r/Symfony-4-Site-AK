<?php

namespace App\Controller;

use App\Entity\User;

use App\Form\AccountType;
use App\Entity\PasswordUpdate;
use App\Form\RegistrationType;
use App\Form\PasswordUpdateType;
use App\Repository\AdRepository;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{   

    /**
     * Permet d'afficher  et de gérer le form de connection
     * @Route("/login", name="account_login")
     * 
     * @return Response
     */

    public function login(AuthenticationUtils $utils)

    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('/account/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }

    /**
     * Permet de se deconnecter
     * @Route("/logout", name="account_logout")
     * @return void
     */

    public function logout()
    {
        //rien !
    }

    /**
     * Permet d'afficher le formulaire d'inscription
     *
     * @Route("/register", name="account_register")
     * 
     * @return Reponse
     */
    public function register(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

    /**=======Enregistrement sur la BDD=============================== */

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $hash = $encoder->encodePassword($user, $user->getHash());
            $user->setHash($hash);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "           Votre compte a bien été enregistré. Vous pouvez maintenant vous connecter !");
            return $this->redirectToRoute('account_login');
        }
    /**--------------------------------------------------------------- */
        return $this->render('account/registration.html.twig', [
            'form' => $form->createView()
        ]);    
    }

    /**
     *@Route ("/fanzone", name="fan")
     *
     */

    public function fan( AdRepository $repo)
   {

    $ads = $this->getDoctrine()
    ->getRepository(User::class)
    ->findAll();  
    return $this->render('ad/user-page.html.twig', [
           'ads' => $ads
       ]);
   }

   /**
    * Permet d'afficher ela modifictaion de profil
    *@Route("/account/profile", name="account_profile")
    *@IsGranted("ROLE_USER")
    * @return Response
    */

   public function profile(Request $request, ObjectManager $manager)
   {
       $user = $this->getUser();

       $form = $this->createForm(AccountType::class, $user);

       $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid())
       {    
           $manager->persist($user);
           $manager->flush();

           $this->addFlash(
               'success',
               "Les données du profil ont été enregistrée avec succès."
           );
       }
        return $this->render('account/profile.html.twig', [
            'form' => $form->createView()
        ]);
   }

/**
    * Permet de modifier le mot de passe
    *@Route ("/account/password-update", name="account_password")
    *@IsGranted("ROLE_USER")
    * @return Response
    */

    public function updatePassword(Request $request, UserPasswordEncoderInterface $encoder, ObjectManager $manager) {
        $passwordUpdate = new PasswordUpdate();

        $user = $this->getUser();

        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);

        if ($form->isSubmitted() && $form->isValid()) {
            
            if(!password_verify($passwordUpdate->getOldPassword(), $user->getHash() )){
                $form->get('oldPassword')->addError(new FormError("le mot de passe est incorect"));
                //gérer l'erreur
            }  else {    

                $newPassword = $passwordUpdate->getNewPassword();
                $hash = $encoder->encodePassword($user, $newPassword);

                $user->setHash($hash);

                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    "mot de passe OK"
                );

                return $this->redirectToRoute('/homepage');
            }         
        }

        return $this->render('account/password.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'afficher le profil de l'utilisateur connecté
     * @Route("/account", name="account_index")
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function myAccount(){
        return $this->render('user_constroller/index.html.twig', [
                'user' => $this->getUser()
        ]);
    }

}
