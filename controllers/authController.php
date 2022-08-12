<?php
require_once 'sendemails.php';
session_start();
$username = "";
$email = "";
$errors = [];

$conn = new mysqli('sql6.freemysqlhosting.net', 'sql6512385', 'm1s5QWN7mu', 'sql6512385');

// SIGN UP USER
if (isset($_POST['signupbutton'])) {
    if (empty($_POST['txtUsername'])) {
        $errors['txtUsername'] = 'Username required';
    }
    if (empty($_POST['txtPassword'])) {
        $errors['txtPassword'] = 'Password required';
    }
    if (empty($_POST['txtLastname'])) {
        $errors['txtLastname'] = 'Last name required';
    }
    if (empty($_POST['txtFirstname'])) {
        $errors['txtFirstname'] = 'First name required';
    }
    if (empty($_POST['txtHouseaddress'])) {
        $errors['txtHouseaddress'] = 'House address required';
    }
    if (empty($_POST['selBarangay'])) {
        $errors['selBarangay'] = 'Barangay required';
    }
    if (empty($_POST['selMunicipality'])) {
        $errors['selMunicipality'] = 'Barangay required';
    }
    if (empty($_POST['Mobilenum'])) {
        $errors['Mobilenum'] = 'Mobile number required';
    }
    if (empty($_POST['numAge'])) {
        $errors['numAge'] = 'Age required';
    }
    if (empty($_POST['selGender'])) {
        $errors['selGender'] = 'Age required';
    }
    if (empty($_POST['txtemailadd'])) {
        $errors['txtemailadd'] = 'Email required';
    }
    

    $username = $_POST['txtUsername'];
    $email = $_POST['txtemailadd'];
    $lastname = $_POST['txtLastname'];
    $firstname = $_POST['txtFirstname'];
    $houseaddress = $_POST['txtHouseaddress'];
    $barangay = $_POST['selBarangay'];
    $municipality = $_POST['selMunicipality'];
    $mobilenum = $_POST['Mobilenum'];
    $age = $_POST['numAge'];
    $gender= $_POST['selGender'];
    $token = bin2hex(random_bytes(50)); // generate unique token
    $password = password_hash($_POST['txtPassword'], PASSWORD_DEFAULT); //encrypt password

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $errors['email'] = "Email already exists";
    }

        $query = "INSERT INTO users SET username=?, email=?, token=?, password=?, lastname=?,
        firstname=?, houseaddress=?, barangay=?, municipality=?, mobilenum=?, age=?, gender=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssssssssss', $username, $email, $token, $password, $lastname, $firstname,
                         $houseaddress, $barangay, $municipality, $mobilenum, $age, $gender);
        $result = $stmt->execute();

        if ($result) {
            $user_id = $stmt->insert_id;
            $stmt->close();
    
            // TO DO: send verification email to user
            sendVerificationEmail($email, $token);
    
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = false;
            header('location:index.php');
    
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }

    
    
}

// LOGIN
if (isset($_POST['signinbutton'])) {
    if (empty($_POST['txtUsername'])) {
        $errors['txtUsername'] = 'Username or email required';
    }
    if (empty($_POST['txtPassword'])) {
        $errors['txtPassword'] = 'Password required';
    }
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];

        $query = "SELECT * FROM users WHERE username=? OR email=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $username, $password);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) { // if password matches
                $stmt->close();

                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['verified'] = $user['verified'];
                $_SESSION['message'] = 'You are now signed in!';
                $_SESSION['type'] = 'alert-success';
                header('location: home.php');

                exit(0);
            } else { // if password does not match
                $errors['login_fail'] = "Wrong username / password";
            }
        } else {
            $_SESSION['message'] = "Database error. Login failed!";
            $_SESSION['type'] = "alert-danger";
        }
    
}