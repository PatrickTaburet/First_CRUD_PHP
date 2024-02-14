
<?php
session_start();
require_once ("connect.php"); 
$sql = "SELECT * FROM user";
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
require_once("close.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP</title>
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
                if(!empty($_SESSION['message'])){
                    echo '<div class="alert alert-success" role="alert">
                    '.$_SESSION['message'].'</div>';
                    $_SESSION['message'] = "";
                }
            ?>
                <h1 class="text-center mb-5">Users Table</h1>
                <table class="table ">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Firstname</th>
                        <th>Age</th>
                        <th>Adress</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach($result as $user){
                        ?>
                            <tr>
                                <td><?= $user['id']?></td>
                                <td><?= $user['name']?></td>
                                <td><?= $user['firstname']?></td>
                                <td><?= $user['age']?></td>
                                <td><?= $user['adress']?></td>
                                <td><a href="details.php?id=<?= $user['id']?>">Details</a> <a href="edit.php?id=<?= $user['id']?>">Edit</a>  <a href="delete.php?id=<?= $user['id']?>">Delete</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <a href="add.php" class="btn btn-primary">Add user</a>
            </section>
        </div>
    </main>
</body>
</html>
