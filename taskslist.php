<?php
    //Проверка на действительность сессии юзера
    if(!isset($_COOKIE['user'])){
        header('Location: index.php');
    }
    //Подключение файла, где будут производиться работа с БД
    if(file_exists('tasklisthandler.php')) include 'tasklisthandler.php';

    function draw(){ //Вывод таблицы с задачами на страницу
        $items = getItemsFromDB();
        while($row = $items->fetch()) {
            echo '<form action="" method="post">';
            echo '<input type="hidden" name="id" value="'.htmlspecialchars($row['id']) . '">';
            echo '<tr>';
            if($row['status'] == '0'){
                echo '<td> <button class="btn btn-danger disabled">  </button> </td>';
            }
            else{
                echo '<td> <button class="btn btn-success disabled">  </button> </td>';
            }
            echo '<td>' . $row['description'] . '</td>';
            echo '<td>' . $row['created_at'] . '</td>';
            if($row['status'] == '0'){
                echo ' <td class="tabbut"> <button type="submit" class="btn btn-outline-dark" name="ready"><b> READY </b></button></td>';
            }
            else{
                echo ' <td class="tabbut"> <button type="submit" class="btn btn-outline-dark" name="unready"><b> UNREADY </b></button></td>';
            }
            echo ' <td class="tabbut"> <button type="submit" class="btn btn-outline-dark" name="delete"><b> DELETE </b></button></td>';
            echo '</tr>';
            echo '</form>';    
        }
    }
?>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title> Tasks list </title>
    <style>
        .btn-danger{
            height: 3em;
            width: 3em;
        }
        .btn-success{
            height: 3em;
            width: 3em;
        }
        .row{
            padding-bottom: 1em;
        }
        .container{
            padding-top: 2em;
        }
        .tabbut{
            text-align: center;
        }
        td { 
            white-space:pre 
        }
    </style>
</head>
<body>
    <div class="container">
    <h1> Welcome, <?=$_COOKIE['user']?> </h1>
        <div class="row">
            <h3> Tasks list </h3>
            <form action="" method="post">
                <div class="row row-col-2">
                    <div class="col-6">
                        <input type="text" class="form-control" name="task" placeholder="Enter text..."> 
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-dark" name="add"><b>ADD TASK</b></button>
                    </div>
                </div>
                <div class="row row-col-2">
                    <div class="col-3">
                        <button type="submit" class="btn btn-outline-dark" name="remove"><b>REMOVE ALL</b> </button>
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-outline-dark" name="readyall"><b>READY ALL</b> </button>
                    </div>
                </div>
            </form>
        </div>
        <div>
            <table class="table">
            <?php
                if(isset ($_POST['remove'])){ //Очищает весь список заданий
                    clearDB();
                }

                if(isset ($_POST['add'])){ //Добавление задания
                    if(!empty($_POST['task'])){ //Проверка на пустое задание
                        addInDB();
                    }
                }
                
                if(isset ($_POST['ready'])){ //Меняет статус задания с "Не готово" на "Выполнено"
                    changeStatusReadyInDB();
                }

                if(isset ($_POST['unready'])){  //Меняет статус задания с "Выполнено" на "Не готово"
                    changeStatusUnreadyInDB();
                }

                if(isset ($_POST['readyall'])){ //Все задания в списке отмечаются выполненными
                    changeStatusAllReadyInDB();
                }

                if(isset ($_POST['delete'])){ //Удаляет блок с текущим заданием из списка
                    deleteFromDB();
                }
                draw();                  
            ?>
            </table>
        </div>
    </div>
</body>
</html>