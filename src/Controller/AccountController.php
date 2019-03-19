<?php

namespace App\Controller;

use App\Entity\User;

use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Repository\AdRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Repository\UserRepository;
use Doctrine\Tests\Common\DataFixtures\TestEntity\User as DoctrineUser;
use ProxyManager\ProxyGenerator\ValueHolder\MethodGenerator\Constructor;

class AccountController extends AbstractController
{   


    /**
     * Permet d'afficher  et de gérer le form de connection
     * 
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
     *
     * @Route("/logout", name="account_logout")
     * 
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

}
