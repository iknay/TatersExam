<?php include 'controllers/authController.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="taters-css.css">
  <title>Welcome Page</title>
</head>


<body>
  <div class="container" style = "margin-top:30px; text-align:center;">
    <div class="row">
      <div class="col-md-4 offset-md-4 home-wrapper">

        <!-- Display messages -->
        <?php if (isset($_SESSION['message'])): ?>
        <div class="alert <?php echo $_SESSION['type'] ?>">
          <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            unset($_SESSION['type']);
          ?>
        </div>
        <?php endif;?>

        <h4>Hello, <?php 
        echo $_SESSION['username'], '!',' Welcome to my Test Page'; 
        ?></h4>

        <div class = tables>
        <?php
        $conn = new mysqli('sql6.freemysqlhosting.net', 'sql6512385', 'm1s5QWN7mu', 'sql6512385');
        if ($conn->connect_errno) {
            echo "Error: " . $conn->connect_error;
        }

        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        $arr_users = [];
        if ($result->num_rows > 0) {
            $arr_users = $result->fetch_all(MYSQLI_ASSOC);
        }
        ?>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
        <table id="tblUser">
            <thead>
                <th>Username</th>
                <th>Fullname</th>
                <th>Barangay</th>
                <th>Municipality</th>
                <th>Mobile Number</th>
                <th>Age</th>
                <th>Gender</th>
            </thead>
            <tbody>
                <?php if(!empty($arr_users)) { ?>
                    <?php foreach($arr_users as $user) { ?>
                        <tr>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['lastname']; ?><?php echo ", " ;echo $user['firstname']; ?>
                            <td><?php echo $user['barangay']; ?></td>
                            <td><?php echo $user['municipality']; ?></td>
                            <td><?php echo $user['mobilenum']; ?></td>
                            <td><?php echo $user['age']; ?></td>
                            <td><?php echo $user['gender']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
        <script>
jQuery(document).ready(function($) {
    $('#tblUser').DataTable();
} );
</script>


      </div>
    </div>
  </div>
  
</body>
</html>