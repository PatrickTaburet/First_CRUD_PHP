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
    }

}else{
    $_SESSION['error'] = 'invalid URL';
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details user</title>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1><?=$user ["firstname"]?> Details</h1>
                <p>ID: <?= $user['id']?></p>
                <p>Firstname: <?= $user['firstname']?></p>
                <p>Name: <?= $user['name']?></p>
                <p>Age: <?= $user['age']?></p>
                <p>Adress: <?= $user['adress']?></p>
                <p>Biography: <?= $user['bio']?></p>
                <p><a href="index.php">Back</a> <a href="edit.php?id=<?= $user["id"]?>">Edit</a></p>
            </section>
        </div>
    </main>
</body>
</html>
