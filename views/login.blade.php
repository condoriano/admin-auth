<!doctype html>
<html>
<head>
    <title>Admin Login</title>

    <meta charset="UTF-8"/>

    <link rel="stylesheet" href="/css/admin/bootstrap.min.css"/>
    <link rel="stylesheet" href="/css/admin/font-awesome.min.css"/>
    <link rel="stylesheet" href="/css/admin/auth.css"/>

    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="/js/admin/bootstrap.min.js"></script>
</head>
<body>
<input type="hidden" name="_token" value="{{ csrf_token() }}"/>

<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">

            <div class="login-container">
                <div id="output"></div>
                <div class="avatar"></div>
                <div class="form-box">
                    <form method="post" action="/admin/login">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input name="username" type="text" placeholder="Имя пользователя">
                        <input name="password" type="password" placeholder="Пароль">

                        <button class="btn btn-primary btn-block login" type="submit">Вход</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>