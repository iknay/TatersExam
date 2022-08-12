 <!DOCTYPE html>
 <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content = "IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link rel="stylesheet" href="taters-css.css">
</head>

<header>Tater's Test Form</header>

<body>
<div class ="content">
 <?php 
    include 'controllers/authController.php';

    function generate_textbox($name, $value){
        return '<input type="text" name="' . $name . '" value="' . $value . '">';
    }
    function generate_password($name, $value){
        return '<input type="password" name="' . $name . '" value="' . $value . '">';
    }
    function generate_tel($name, $value){
        return '<input type="number" name="' . $name . '" value="' . $value . '" >';
    }
    function generate_house($name, $value){
        return '<input type="text" name="' . $name . '" value="' . $value . '" placeholder="e.g. TEI Center, 3536 Hilario Street" size ="50">';
    }
    function generate_email($name, $value){
        return '<input type="text" name="' . $name . '" value="' . $value . '" size ="40">';
    }
    function generate_age($name, $value){
        return '<input type="number" name="' . $name . '" value="' . $value . '" style= "width: 30px">';
    }

    $username = isset($_POST['txtUsername']) ? $_POST['txtUsername'] : '';
    $password = isset($_POST['txtPassword']) ? $_POST['txtPassword'] : '';
    $lastname = isset($_POST['txtLastname']) ? $_POST['txtLastname'] : '';
    $firstname = isset($_POST['txtFirstname']) ? $_POST['txtFirstname'] : '';
    $houseaddress = isset($_POST['txtHouseaddress']) ? $_POST['txtHouseaddress'] : '';
    $barangay = isset($_POST['selBarangay']) ? $_POST['selBarangay'] : '';
    $municipality = isset($_POST['selMunicipality']) ? $_POST['selMunicipality'] : '';
    $mobilenum = isset($_POST['Mobilenum']) ? $_POST['Mobilenum'] : '';
    $age = isset($_POST['numAge']) ? $_POST['numAge'] : '';
    $gender = isset($_POST['selGender']) ? $_POST['selGender'] : '';
    $email = isset($_POST['txtemailadd']) ? $_POST['txtemailadd'] : '';

    $barangaylist=file_get_contents ("barangay.json");
    $barangayfilter= json_decode($barangaylist,true);
    $citylist=file_get_contents ("cities.json");
    $cityfilter= json_decode($citylist,true);


    if (count($_POST) == 0) {
        echo '<form method="post" action="">';
        echo '<table>';
        echo '<tr><td colspan=2></td></tr>';

        echo '<tr><td>Username</td><td>',
        generate_textbox('txtUsername', $username);
        echo '<tr><td>Password</td><td>',
        generate_password('txtPassword', $password);
        echo '<tr><td>Last Name</td><td>',
        generate_textbox('txtLastname', $lastname);
        echo '<tr><td>First Name</td><td>',
        generate_textbox('txtFirstname', $firstname);
        echo '<tr><td>House, Street, Village </td><td>', 
        generate_house('txtHouseaddress', $houseaddress);

        echo '<tr><td>Barangay</td><td>';
        echo '<select name="selBarangay" id="brgy">';
        foreach($barangayfilter as $t){
        echo '<option value="'. $t['Barangay'].  '">'. $t['Barangay'].'</option>';
        }
        echo '</select>';
        echo '<tr><td>Municipality</td><td>';
        echo '<select name="selMunicipality" id="city">';
        foreach($cityfilter as $t){
        echo '<option value="'. $t['City'].  '">'. $t['City'].'</option>';
        }
        echo '</select>';

        echo '<tr><td>Mobile Number</td><td>',
        generate_tel('Mobilenum', $mobilenum);
        echo '<tr><td>Age</td><td>',
        generate_age('numAge', $age);

        echo '<tr><td>Gender</td><td>',
        '<input type="radio" name="selGender" value="Male" />Male &nbsp;';
        echo '<input type="radio" name="selGender" value="Female" /> Female';

        echo '<tr><td>Email Address</td><td>',
        generate_email('txtemailadd', $email);
        
        echo '<tr><td><br>';
        echo '<input type="submit" name="signupbutton" value="SIGN UP" id="signupbutton">&nbsp;', '</br></td></tr>';
        echo '</table>';
        echo '</form>';
    }

    ?>
    
</div>
</body>
</html>
    
    
