<?php
    if(file_exists('connect.php')) include 'connect.php';

    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
    $date = date("Y/m/d"); //Берется текущая дата системы
    $users = array($login,$pass);

    $usersListStmt = $pdo->prepare("SELECT * FROM `users` WHERE `login` = ? AND `password` = ?");
    $usersListStmt->execute($users);
    $data =  $usersListStmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($data) == 0){
        $query = "INSERT INTO `users` (`login`,`password`,`created_at`) VALUES (:login,:password,:date)";
        $params = [
            ':login' => $login,
            ':password' => $pass,
            ':date' => $date
        ];
        print_r($params);
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
    }

    setcookie('user',$login, time() + 3600, "/");
    setcookie('id',$data[0]['id'], time() + 3600, "/");

    header('Location: taskslist.php');
?>