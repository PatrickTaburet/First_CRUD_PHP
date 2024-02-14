
<?php
session_start();

if($_POST){
    if(isset($_POST["firstname"]) && !empty($_POST['firstname'])
    && isset($_POST["name"]) && !empty($_POST['name'])
    && isset($_POST["age"]) && !empty($_POST['age'])
    && isset($_POST["adress"]) && !empty($_POST['adress'])
    && isset($_POST["bio"]) && !empty($_POST['bio'])){

    require_once ("connect.php"); 
    // On nettoie l'id envoyé
    $firstname = strip_tags($_POST['firstname']);
    $name = strip_tags($_POST['name']);
    $age = strip_tags($_POST['age']);
    $adress = strip_tags($_POST['adress']);
    $bio = strip_tags($_POST['bio']);
    
    $sql= "INSERT INTO user (firstname, name, age, adress, bio) VALUES (:firstname, :name, :age, :adress, :bio);";
    $query = $db->prepare($sql);
    $query->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $query->bindValue(':name', $name, PDO::PARAM_STR);
    $query->bindValue(':age', $age, PDO::PARAM_INT);
    $query->bindValue(':adress', $adress, PDO::PARAM_STR);
    $query->bindValue(':bio', $bio, PDO::PARAM_STR);
    
    $query->execute();
    $_SESSION ['message'] = 'User added';
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
    <title>Add user</title>
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
                <h1>Add User</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" id="firstname" name="firstname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" min=1 id="age" name="age" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="adress">Adress</label>
                        <input type="text" id="adress" name="adress" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="bio">Biography</label>
                        <textarea id="bio" name="bio" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  
                </form>
            </section>
        </div>
    </main>
</body>
</html>
