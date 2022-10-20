<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title> Tasks list </title>
    <style>
        .container{
            padding-top: 2em;
        }
        .loginform {
            border: 1px solid #a9a9a9;
            width: 400px;
            margin: 10em auto;
            height: 20em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="loginform" align=center>
                <h1>Вход</h1>
                <form action="check.php" method="post"> <br>
                    <input type="text" class="form-control" name="login" placeholder="Введите логин" value="<?=htmlspecialchars($values["login"])?>" required> <br>
                    <input type="password" name="password" class="form-control" placeholder="Введите пароль" value="<?=htmlspecialchars($values["password"])?>" required> <br>
                    <button class="btn btn-outline-dark"> Войти </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>