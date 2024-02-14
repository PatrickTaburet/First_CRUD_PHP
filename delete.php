<?php
session_start();

if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('connect.php');
    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);
   
    //On prepare la requete
    $sql = "SELECT * FROM user where id = :id";
    $query = $db->prepare($sql);

    // On "accroche" les parametres (id) - entier uniquement
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On execute la requete
    $query->execute();

    //On recupere l'user
    $user = $query->fetch();

    //On vérifie si l'user existe
    if(!$user){
        $_SESSION ['error'] = 'User don\'t exist';
        header('Location: index.php');
        die();
    }
    // Suppression de l'user
     $sql = "DELETE FROM user where id = :id";
     $query = $db->prepare($sql);
     $query->bindValue(':id', $id, PDO::PARAM_INT);
     $query->execute();

     $_SESSION['message'] = 'User deleted';
     header('Location: index.php');

}else{
    $_SESSION['error'] = 'invalid URL';
    header('Location: index.php');
    exit();
}
?>

