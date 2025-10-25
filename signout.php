<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Movies Bank </title>
    </head>
    <body>
        <?php
            setcookie("UID", "", time() - 1, '/');
        ?>
        <script>
            window.location.href = "login_signup/login_signup.php";
        </script>
    </body>
</html>