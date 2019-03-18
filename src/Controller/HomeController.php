<?php 

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class HomeController extends Controller
{
    /**
     * @Route("/hello/{prenom}", name="hello")
     * Montre la page qui dit Bonjour
     * @return void
     */

    public function hello($prenom)
    {
        return new Response("Bonjour".$prenom);
    }


    /**
     * @Route("/", name="homepage")
     */

    public function home()
    {
        // return new Response("Bonjour"); // Le Response correspond à HttpFoundation\Response
        //render est donné par la classe Controller
        // le tableau dans render intégre la variable "title"
        
        return $this->render('home.html.twig',
        ['title' => "Bonjour à tous"]
    ); 
    }

}


?>
