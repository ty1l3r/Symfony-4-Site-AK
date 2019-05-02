<?php 

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;

class PaginationService {

    private $entityClass;
    private $limit = 10;
    private $currentPage = 1;
    private $manager;

    public function __construct(ObjectManager $manager){
        $this->manager = $manager;
    }

    public function getPages(){
        //1 Connaitre le totale des enregistrment de la table
        $repo = $this->manager->getRepository($this->entityClass);
        $total = count($repo->findAll());

        //2 faire la divions, l'arrondir et la renvoyer
        $pages = ceil($total / $this->limit);

        return $pages;
    }

    public function getData(){
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
