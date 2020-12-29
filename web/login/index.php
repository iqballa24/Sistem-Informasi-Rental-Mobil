<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="icon" href=""/>
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet"> 
        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <center><h1><i class="menu-icon fa fa-car "></i></h1></center>
                <center><h2></i>RENTCAR</h2></center> 
                <form class="form">
                    <input type="text" placeholder="Username">
                    <input type="password" placeholder="Password">
                    <button type="submit" id="login-button"
                    >Login</button>
                </form>
            </div>

            <?php
    include "base_template_footer.php"; //akan memanggil base_template_footer.php sebagai footer
?>
        </div>

        <script>
            $("#login-button").click(function (event) {
                event.preventDefault();

                $('form').fadeOut(500);
                $('.wrapper').addClass('form-success');
            });
        </script>
    </body>
</html>