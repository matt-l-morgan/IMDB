<html>
<head>
<title>Studio deleted</title>
<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Mr+Dafoe'>

    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
if(isset($_POST['submit'])){

    $data_missing = array();

    if(empty($_POST['sid'])){
        $data_missing[] = 'sid';
    } else {

        $sid = trim($_POST['sid']);

    }


    if(empty($data_missing)){

        require_once('../mysql_connect.php');

        $query = "DELETE FROM studio WHERE sid=?;";
        $stmt = mysqli_prepare($dbc, $query);

        mysqli_stmt_bind_param($stmt, "i", $sid);

        mysqli_stmt_execute($stmt);

        $affected_rows = mysqli_stmt_affected_rows($stmt);

        if($affected_rows == 1){

            echo 'Studio Deleted';

            mysqli_stmt_close($stmt);

            mysqli_close($dbc);

        } else {

            echo 'Error Occurred<br />';
            echo mysqli_error();

            mysqli_stmt_close($stmt);

            mysqli_close($dbc);
        }

    } else {

        echo 'You need to enter the following data<br />';

        foreach($data_missing as $missing){

            echo "$missing<br />";

        }

    }

}

?>

<form action="deletedstudio.php" method="post">
  <center>
    <h1>Delete another studio</h1>
    <p>Person ID:
    <input type="text" name="pid" size="30" value="" />
    <input type="submit" name="submit" value="Send" />
    </p>
  </center>
</html>
