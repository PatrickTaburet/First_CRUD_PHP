
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

if($_POST){
    if(isset($_POST["firstname"]) && !empty($_POST['firstname'])
    && isset($_POST["id"]) && !empty($_POST['id'])
    && isset($_POST["name"]) && !empty($_POST['name'])
    && isset($_POST["age"]) && !empty($_POST['age'])
    && isset($_POST["adress"]) && !empty($_POST['adress'])
    && isset($_POST["bio"]) && !empty($_POST['bio'])){

    require_once ("connect.php"); 
    // On nettoie l'id envoyé
    $id = strip_tags($_POST['id']);
    $firstname = strip_tags($_POST['firstname']);
    $name = strip_tags($_POST['name']);
    $age = strip_tags($_POST['age']);
    $adress = strip_tags($_POST['adress']);
    $bio = strip_tags($_POST['bio']);
    
    $sql= "UPDATE user SET firstname=:firstname, name=:name, age=:age, adress=:adress, bio=:bio WHERE id = :id";
    $query = $db->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $query->bindValue(':name', $name, PDO::PARAM_STR);
    $query->bindValue(':age', $age, PDO::PARAM_INT);
    $query->bindValue(':adress', $adress, PDO::PARAM_STR);
    $query->bindValue(':bio', $bio, PDO::PARAM_STR);
    
    $query->execute();
    $_SESSION ['message'] = 'User modified';
    require_once("close.php");
    header('Location: index.php');

  

    } else {
        $_SESSION["error"] = 'The form is incomplete';
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                    if(!empty($_SESSION['error'])){
                        echo '<div class="alert alert-danger" role="alert">
                        '.$_SESSION['error'].'</div>';
                        $_SESSION['error'] = "";
                    }
                ?>
                <h1>Edit User</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" id="firstname" name="firstname" class="form-control" value="<?= $user['firstname']?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?= $user['name']?>">
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" min=1 id="age" name="age" class="form-control" value="<?= $user['age']?>">
                    </div>
                    <div class="form-group">
                        <label for="adress">Adress</label>
                        <input type="text" id="adress" name="adress" class="form-control" value="<?= $user['adress']?>">
                    </div>
                    <div class="form-group">
                        <label for="bio">Biography</label>
                        <textarea id="bio" name="bio" cols="30" rows="10" class="form-control"><?= $user['bio']?></textarea>
                    </div>
                    <input type="hidden" value="<?= $user['id']?>" name="id" id="id">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </div>
                  
                </form>
            </section>
        </div>
    </main>
</body>
</html>
