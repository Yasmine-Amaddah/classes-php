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
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $this->bdd = new PDO("mysql:host=$servername;dbname=classes", $username, $password);
        if (!$this->bdd) {
            die("connexion échoué </br>");
        }
        else { echo "connexion reussi </br>";}
    }

    // Les Methodes

    public function register($login,$password,$email,$firstname,$lastname){
        $request = $this->bdd->prepare("INSERT INTO `utilisateurs` ( `login`, `password`, `email`, `firstname`, `lastname`) VALUES (?,?,?,?,?)");
        $request->execute([$login, $password, $email, $firstname, $lastname]);
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
    }

    public function connect($login,$password){
        session_start();
        $request = $this->bdd->prepare('SELECT login,password FROM utilisateurs');
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['login'] = $login;
        $_SESSION['password'] = $password;
    }

    public function disconnect($login,$password){
        session_destroy();
    }

    public function delete(){
        $request = $this->bdd->prepare("DELETE FROM utilisateurs WHERE login = ?");
        $request->execute([$_SESSION['login']]);
        session_destroy();
    }

    public function update($login,$password,$email,$firstname,$lastname){
        $request = $this->bdd->prepare("UPDATE `utilisateurs` SET `login`= ?,`password`= ?,`email`= ?,`firstname`= ?,`lastname`= ? WHERE login = ?");
        $request->execute([$login, $password, $email, $firstname, $lastname, $_SESSION['login']]);
    }

    public function isConnected(){
        if (isset($_SESSION['login'])){ echo "True";} else { echo "False";}
    }

    public function getAllInfo(){
        $request = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $request->execute([$_SESSION['login']]);
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
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
        $request = $this->bdd->prepare("SELECT * FROM utilisateurs");
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $key => $value) {
            if ($value['login'] == $_SESSION['login']){
                echo $value['email'] ."</br>";
            }
        }
    }

    public function getFirstName() {
        $request = $this->bdd->prepare("SELECT * FROM utilisateurs");
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $key => $value) {
            if ($value['login'] == $_SESSION['login']){
                echo $value['firstname'] ."</br>";
            }
        }
    }

    public function getLastName() {
        $request = $this->bdd->prepare("SELECT * FROM utilisateurs");
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $key => $value) {
            if ($value['login'] == $_SESSION['login']){
                echo $value['lastname'] ."</br>";
            }
        }
    }
    
}
$test = new Userpdo();
//$test->register("test", "test", "test@gmail.com","test","test");
$test->connect("test2", "test2");
//$test->delete();
//$test->update("test2", "test2", "test2@gmail.com","test2","test2");
//$test->isConnected();
//$test->getAllInfo();
$test->getLogin();
$test->getEmail();
$test->getFirstName();
$test->getLastName();
?>