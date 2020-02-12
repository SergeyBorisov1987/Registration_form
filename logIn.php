<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_startup_errors', 1);
ini_set('display_errors', '1');

require_once ('add/lib.php');
require_once ('add/config.php');

    $id = 0;
    $user = "";
    $email = "";
    $password = "";
    $update = false;

    $useId = false;
    $useName = '';
    $useEmail = '';
    $usePassword = '';
    $showInfo = false;

// Check datas from form (name, email, comment)
    if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) ){
        $userName = ucfirst(formValidator($_POST['name']));
        $userEmail = formValidator($_POST['email']);
        $usePassword = md5 (formValidator($_POST['password']));
    }

// Data Bases connection
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $dbUsername, $dbPassword);
    } catch (PDOException $e) {
        die('Подключение не удалось: ' . $e->getMessage());
    }

// Insert command
    if (isset($_POST['submit'])){
        $sql = 'INSERT INTO logIn (name, email, password)
                VALUES (:name, :email, :password)';
        $params = ['name' => $userName, 'email' => $userEmail, 
                   'password' => $usePassword];
        $stmt = $pdo->prepare($sql);
            if($stmt->execute($params)){}
        header('Location: index.php');
    }

// Select command
    $sql = "SELECT id, name FROM logIn";
        $stmt = $pdo->query($sql);

        if (isset($_GET['show'])){
            $idUser = $_GET['show'];
            $sql = "SELECT id, email, password FROM logIn WHERE id = '$idUser' Limit 1";
            $statement = $pdo->query($sql);     
                $show = $statement->fetch();
                    $useId = $show['id'];
                    $useEmail = $show['email'];
                    $usePassword = $show['password'];
                    $showInfo = true;
        }

// Delete command
    if (isset($_GET['delete'])){
        $sql = "DELETE FROM logIn WHERE id = :id";
        $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $_GET['delete'], PDO::PARAM_INT);   
                $stmt->execute();
                  header('Location: index.php');
    }

// Edit command
    if (isset($_GET['edit'])){
        $id = $_GET['edit'];
        $sql = "SELECT id, name, email, password FROM logIn WHERE id = '$id'";
        $statement = $pdo->query($sql);     
            $edit = $statement->fetch();
                $user = $edit['name'];
                $email = $edit['email'];
                $password = $edit['password'];
                $update = true;
    }
    
    // Update datas
    if (isset($_POST['update'])){
        
        $id = $_POST['id'];
        $updateName = ucfirst(formValidator($_POST['name']));
        $updateEmail = formValidator($_POST['email']);
        $updatePassword = md5 (formValidator($_POST['password']));

        $sql = "UPDATE logIn SET name = :name, email = :email, password = :password WHERE id = :id";
            $stmt = $pdo->prepare($sql);                                  
            $stmt->bindParam(':name', $updateName, PDO::PARAM_STR);
            $stmt->bindParam(':email', $updateEmail, PDO::PARAM_STR);
            $stmt->bindParam(':password', $updatePassword, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id , PDO::PARAM_INT);
                $stmt->execute(); 
            header('Location: index.php');
    }

