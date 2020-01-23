<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_startup_errors', 1);
ini_set('display_errors', '1');

require_once ('add/lib.php');
require_once ('add/config.php');

$id = 0;
$user = "";
$email = "";
$comment = "";
$file = "";
$fpath = "";
$update = false;


// Check datas from form (name, email, comment)
    if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['text']) && !empty($_POST['text']) ){
        $userName = ucfirst(formValidator($_POST['name']));
        $userEmail = formValidator($_POST['email']);
        $userComment = formValidator($_POST['text']);
    }

// Check uploaded file
    if (!empty($_FILES)){
        $fileName = formValidator($_FILES ['file']['name']);
        $filePath = formValidator($_FILES ['file']['tmp_name']);
    }

// Data Bases connection
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $dbUsername, $dbPassword);
    } catch (PDOException $e) {
        die('Подключение не удалось: ' . $e->getMessage());
    }

// Insert command
    if (isset($_POST['submit'])){
        $sql = 'INSERT INTO crud (name, email, text, fname, file_path)
            VALUES (:name, :email, :text, :fname, :file_path)';
        $params = ['name' => $userName, 'email' => $userEmail, 'text' => $userComment, 'fname' => $fileName, 'file_path' => $filePath];
        $stmt = $pdo->prepare($sql);
            if($stmt->execute($params))
        header('Location: index.php');
    }

// Select command
    $sql = "SELECT id, name, email, text, fname, file_path FROM crud";
    $stmt = $pdo->query($sql);

// Delete command
    if (isset($_GET['delete'])){
        //$id = $_GET['delete'];
        $sql = "DELETE FROM crud WHERE id = :id";
        $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $_GET['delete'], PDO::PARAM_INT);   
                $stmt->execute();
                    header('Location: index.php');
    }

// Edit command
    if (isset($_GET['edit'])){
        $id = $_GET['edit'];
        $sql = "SELECT id, name, email, text, fname, file_path FROM crud WHERE id = '$id'";
        $statement = $pdo->query($sql);     
            $edit = $statement->fetch();
                $user = $edit['name'];
                $email = $edit['email'];
                $comment = $edit['text'];
                $file = $edit['fname'];
                $fpath = $edit['file_path'];
                $update = true;
    }
    
    // Update datas
    if (isset($_POST['update'])){
        
        $id = $_POST['id'];
        $updateName = ucfirst(formValidator($_POST['name']));
        $updateEmail = formValidator($_POST['email']);
        $updateComment = formValidator($_POST['text']);

        $updateNamefName = formValidator($_FILES ['file']['name']);
        $updateNamefPath = formValidator($_FILES ['file']['tmp_name']);

        $sql = "UPDATE crud SET name = :name, email = :email, text = :text, fname = :fname, file_path = :file_path WHERE id = :id";
            $stmt = $pdo->prepare($sql);                                  
            $stmt->bindParam(':name', $updateName, PDO::PARAM_STR);
            $stmt->bindParam(':email', $updateEmail, PDO::PARAM_STR);
            $stmt->bindParam(':text', $updateComment, PDO::PARAM_STR);
            $stmt->bindParam(':fname', $updateNamefName, PDO::PARAM_STR);
            $stmt->bindParam(':file_path', $updateNamefPath, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id , PDO::PARAM_INT);
                $stmt->execute(); 
            header('Location: index.php');

    }

