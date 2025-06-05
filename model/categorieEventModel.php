<?php
    class categorie{
        private $bdd;

    function __construct($bdd){
            $this->bdd= $bdd;
    }

        public function selectAllCategorieEvents(){
            $requete ="select * from Categorieevent; ";
            //preparation de la requete
            $select = $this->bdd->prepare($requete);
            //execution de la requete
            $select->execute();
            //extraction des données
            $lesCategories = $select->fetchAll();
            return $lesCategories;
        }

        public function insertCategorieEvent ($tab){
            $requete = "insert into Categorieevent values (null, '"
            .$tab['nomCategorie']."','"
            .$tab['description']."');";
        //preparation de la requete
        $select = $this->bdd->prepare ($requete);
        //execution de la requete
        $select->execute ();
        }

        public function deleteCategorieEvent($idCategorieEvent){
            $requete = "delete from CategorieEvent where idCategorieEvent=".$idCategorieEvent.";";
            //preparation de la requete
            $select = $this->bdd->prepare ($requete);
            //execution de la requete
            $select->execute ();
        }

        public function selectWhereCategorieEvent ($idCategorieEvent){
            $requete="select * from Categorieevent where idCategorieEvent=".$idCategorieEvent.";";
            $select = $this->bdd->prepare ($requete);
            $select->execute ();
            $uneCategorieEvent = $select->fetch();
            return $uneCategorieEvent;
        }

        public function updateCategorieEvent ($tab){
            $requete = "update Categorieevent set nomCategorie='"
            .$tab['nomCategorie']."', description='"
            .$tab['description']."'"
            ."where idCategorieEvent=".$tab['idCategorieEvent'].";";
        //preparation de la requete
        $select = $this->bdd->prepare ($requete);
        //execution de la requete
        $select->execute ();
        }

        public function selectLikeCategorieEvent($filtre){
            $requete ="select * from CategorieEvent where nomCategorie like '%".$filtre."%'
            or description like '%".$filtre."%'; ";
            //preparation de la requete
            $select = $this->bdd->prepare($requete);
            //execution de la requete
            $select->execute();
            //extraction des données
            $lesCategories = $select->fetchAll();
            return $lesCategories;
        }
    }
?>