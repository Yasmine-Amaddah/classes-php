<?php

class Userpdo{

    // Les Attributs
    private $bdd;
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;

    // Le Constructeur
    public function __construct(){
        if (!$this->bdd) {
            die("connexion échoué </br>");
        }
        else { echo "connexion reussi </br>";}
    }

    // Les Methodes

    public function register($login,$password,$email,$firstname,$lastname){
    }

    public function connect($login,$password){
    }

    public function disconnect($login,$password){
        session_destroy();
    }

    public function update($login,$password,$email,$firstname,$lastname){
    }

    public function isConnected(){
        if (isset($_SESSION['login'])){ echo "True";} else { echo "False";}
    }

    public function getAllInfo(){
    }
    
    public function getLogin() {
        echo $_SESSION['login'] ."</br>";
    }

    public function getEmail() {
    }

    public function getFirstName() {
    }

    public function getLastName() {
    }
    
}
$test = new Userpdo();
//$test->register("test", "test", "test@gmail.com","test","test");
?>