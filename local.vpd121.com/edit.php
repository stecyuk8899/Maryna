<?php
include $_SERVER["DOCUMENT_ROOT"] . "/connection_database.php";
$name = $image = $email = $password = "";
$id = $_GET['id'];
$sql = "SELECT id, name, email, image, password FROM users WHERE id = $id;";
if(isset($dbh)){
    $command = $dbh->query($sql);
    foreach($command as $row){
        $name = $row["name"];
        $email = $row["email"];
        $image = $row["image"];
        $password = $row["password"];
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="/CSS/site.css">
</head>
<body>
<?php include $_SERVER["DOCUMENT_ROOT"]."/navbar.php"; ?>
<h1 class="text-center">Редагувати користувача</h1>
<div class="container">
    <form class="col-md-8 offset-md-2" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Ім'я</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Електронна пошта</label>
            <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Шлях до фото</label>
            <input type="text" class="form-control" id="image" name="image" value="<?php echo $image; ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Редагувати</button>
    </form>
</div>
<script src="/JS/bootstrap.bundle.min.js"></script>
</body>
</html>