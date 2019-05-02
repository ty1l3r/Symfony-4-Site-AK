<?php 

namespace App\Service;

use Twig\Environment;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\RequestStack;

class PaginationService {

    private $entityClass;
    private $limit = 10;
    private $currentPage = 1;
    private $manager;
    private $twig;
    private $route;
    private $templatePath;

    public function __construct(ObjectManager $manager, Environment $twig, RequestStack $request, 
    $templatePath){
        //récupère la route actuelle de la page utilisé via le « requeststack »
        $this->route        = $request->getCurrentRequest()->attributes->get('_route');
        $this->manager      = $manager;
        $this->twig         = $twig;
        $this->templatePath = $templatePath;
    }
    public function setTemplatePath($templatePath){
        $this->templatePath= $templatePath;
        return $this;
    }
    public function getTemplatePath(){
        return $this->templatePath;
    }

    public function setRoute($route){
        $this->route = $route;

        return $this;
    }

    public function getRoute(){

        return $this->route;
    }

    public function display(){
        $this->twig->display($this->templatePath, [
                'page' => $this->currentPage, 
                'pages' => $this->getPages(),
                'route' => $this->route
        ]);
    }

    public function getPages(){
        //Message d'erreur pour les futurs developpeurs
        if(empty($this->entityClass)) {
            throw new \Exception(" =========    Vous n'avez pas specifié l'entité sur laquelle nous devons paginer !
         Utiliser la méthode setEntityClass() de votre objet PaginationService ! ======= ");
        }
        //1 Connaitre le totale des enregistrment de la table
        $repo = $this->manager->getRepository($this->entityClass);
        $total = count($repo->findAll());

        //2 faire la divions, l'arrondir et la renvoyer
        $pages = ceil($total / $this->limit);

        return $pages;
    }

    public function getData(){

        if(empty($this->entityClass)) {
        ///Message d'erreur pour les futurs developpeurs
        throw new \Exception(" =========    Vous n'avez pas specifié l'entité sur laquelle nous devons paginer !
        Utiliser la méthode setEntityClass() de votre objet PaginationService ! ======= ");
        }

        //1 Calculer l'offset
            $offset = $this->currentPage * $this->limit - $this->limit;
        // 2 Demander au repository de trouver les éléments
            $repo = $this->manager->getRepository($this->entityClass);
            $data = $repo->findBy([], [], $this->limit, $offset);
        //3 Renvvoyer les elements
            return $data;

    }

    public function setPage($page){
        $this->currentPage = $page;

        return $this;
    }

    public function getPage(){
        return $this->currentPage;
    }

    public function setLimit($limit){
        $this->limit = $limit;

        return $this;
    }

    public function getLimit(){
        return $this->limit;
    }

    public function setEntityClass($entityClass){
        //reçois la variable classe demandé (ad/comment/user etc//)
        $this->entityClass = $entityClass;

        return $this;
    }

    public function getEntityClass(){
        return $this->entityClass;
    }
}
