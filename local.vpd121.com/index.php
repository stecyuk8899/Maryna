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
    <?php include $_SERVER["DOCUMENT_ROOT"]."/connection_database.php"; ?>
    <h1 class="text-center">Список користувачів</h1>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Фото</th>
                <th scope="col">Ім'я</th>
                <th scope="col">Пошта</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT id, name, email,image FROM users;";
            if(isset($dbh)){
                $command = $dbh->query($sql);
                foreach($command as $row){
                    $name = $row["name"];
                    $id = $row["id"];
                    $email = $row["email"];
                    $image = $row["image"];

                    echo "
                        <tr>
                            <th>$id</th>
                            <th><img src='$image' width='50'></th>
                            <th>$name</th>
                            <th>$email</th>
                            <th><a class='btn btn-success' href='/edit.php?id=$id'>Змінити</a></th>
                        </tr>
                    ";
                }
            }
            ?>
            </tbody>
        </table>
    </div>
    <script src="/JS/bootstrap.bundle.min.js"></script>
</body>
</html>