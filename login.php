<?php

session_start();

require_once("inc/connection.php");

if(isset($_SESSION["session_username"])){
    //проверка на активность сессии
}
if(isset($_POST["login"])){
    if(!empty($_POST['username']) && !empty($_POST['password'])) {
        $username=$_POST['username'];
        $password=$_POST['password'];
        $query=PDO::query("SELECT * FROM usertbl WHERE username='".$username."' AND password='".$password."'");
        $numrows=PDOStatement::rowCount($query);
        if($numrows!=0){
            while($row=PDO::FETCH_ASSOC($query)){
                $dbusername=$row['username'];
                $dbpassword=$row['password'];
            }
            if($username == $dbusername && $password == $dbpassword){
                $_SESSION['session_username']=$username;
                header("Location: intropage.php");
            }else{
                echo "Invalid username or password!";
            }else{
                echo "All fields are required!";
            }
        }
    }
}