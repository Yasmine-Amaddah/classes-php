<?php

class User{

    // Les Attributs
    private $bdd;
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;

    // Le Constructeur
    public function __construct(){
        $this->bdd = new mysqli('localhost', 'root', '', 'classes');
        if (!$this->bdd) {
            die("connexion échoué </br>");
        }
        else { echo "connexion reussi </br>";}
    }

    // Les Methodes

    public function register($login,$password,$email,$firstname,$lastname){
        $this->bdd->query("INSERT INTO `utilisateurs` ( `login`, `password`, `email`, `firstname`, `lastname`) VALUES ( '$login', '$password', '$email', '$firstname', '$lastname')");
    }

    public function connect($login,$password){
        session_start();
        $request = $this->bdd->query('SELECT login,password FROM utilisateurs');
        $result = $request->fetch_all(MYSQLI_ASSOC);
        $_SESSION['login'] = $login;
        $_SESSION['password'] = $password;
    }

    public function disconnect($login,$password){
        session_destroy();
    }

    public function delete(){
        $this->bdd->query("DELETE FROM `utilisateurs` WHERE login = '".$_SESSION['login']."'");
        session_destroy();
    }

    public function update($login,$password,$email,$firstname,$lastname){
        $this->bdd->query("UPDATE `utilisateurs` SET `login`='$login',`password`='$password',`email`='$email',`firstname`='$firstname',`lastname`='$lastname' WHERE login = '".$_SESSION['login']."'");
    }

    public function isConnected(){
        if (isset($_SESSION['login'])){ echo "True";} else { echo "False";}
    }

    public function getAllInfo(){
        $request = $this->bdd->query("SELECT * FROM utilisateurs");
        $result = $request->fetch_all(MYSQLI_ASSOC);
        ?><tr><?php
        foreach ($result as $key => $value) { ?>
            <td><?php echo $value['login']; ?></td>
            <td><?php echo $value['password']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['firstname']; ?></td>
            <td><?php echo $value['lastname']; ?></br></td>
        </tr><?php } 
    }
    
    public function getLogin() {
        echo $_SESSION['login'] ."</br>";
    }

    public function getEmail() {
        $request = $this->bdd->query("SELECT * FROM utilisateurs");
        $result = $request->fetch_all(MYSQLI_ASSOC);
        foreach ($result as $key => $value) {
            if ($value['login'] == $_SESSION['login']){
                echo $value['email'] ."</br>";
            }
        }
    }

    public function getFirstName() {
        $request = $this->bdd->query("SELECT * FROM utilisateurs");
        $result = $request->fetch_all(MYSQLI_ASSOC);
        foreach ($result as $key => $value) {
            if ($value['login'] == $_SESSION['login']){
                echo $value['firstname'] ."</br>";
            }
        }
    }

    public function getLastName() {
        $request = $this->bdd->query("SELECT * FROM utilisateurs");
        $result = $request->fetch_all(MYSQLI_ASSOC);
        foreach ($result as $key => $value) {
            if ($value['login'] == $_SESSION['login']){
                echo $value['lastname'] ."</br>";
            }
        }
    }
    
}
$test = new User();
//$test->register("test", "test", "test@gmail.com","test","test");
$test->connect("test2", "test2");
//$test->delete();
$test->update("test22", "test2", "test2@gmail.com","test2","test2");
//$test->isConnected();
//$test->getAllInfo();
//$test->getLogin();
//$test->getEmail();
//$test->getFirstName();
//$test->getLastName();
?>