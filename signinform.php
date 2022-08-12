<!DOCTYPE html>
 <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content = "IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link rel="stylesheet" href="taters-css.css">
</head>

<body>
<div class ="nav">
<?php
    include 'controllers/authController.php';

    function generate_textbox($name, $value){
        return '<input type="text" name="' . $name . '" value="' . $value . '">';
    }
    function generate_password($name, $value){
        return '<input type="password" name="' . $name . '" value="' . $value . '">';
    }

    $username = isset($_POST['txtUsername']) ? $_POST['txtUsername'] : '';
    $password = isset($_POST['txtPassword']) ? $_POST['txtPassword'] : '';

    if (count($_POST) == 0) {
        echo '<form method="post" action="home.php">';
        echo '<table>';
        echo '<tr><td colspan=2></td></tr>';

        echo '<tr><td>Username</td><td>',
        generate_textbox('txtUsername', $username);
        echo '<tr><td>Password</td><td>',
        generate_password('txtPassword', $password);

        echo '<tr><td><br>';
        echo '<button type="submit" name="signinbutton" id="signinbutton">SIGN IN</button>&nbsp;', '</br></td></tr>';
        echo '</table>';
        echo '</form>';
    }


    
?>
</div>
</body>
</html>