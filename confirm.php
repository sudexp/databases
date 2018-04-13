<?php 
    // session_start();
    // $_SESSION["lastname"] = $_POST["lastname"]
    // print("<pre>");
    // print_r($_POST);
    // print("</pre>");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Page Title</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <script src="main.js"></script>
    </head>
    <body>
        Please confirm your information:
        <!-- Data List, Data Term, Data Description -->
        <dl>
            <dt>First Name</dt>
            <dd><?php print( $_POST["firstname"]); ?></dd>
            <dt>Last Name</dt>
            <dd><?php print( $_POST["lastname"]); ?></dd>
            <dt>Phone number</dt>
            <dd><?php print( $_POST["phone"]); ?></dd>
            <dt>Address</dt>
            <dd><?php print( $_POST["address"]); ?></dd>
            <!-- <dt>Client ID</dt>
            <dd><?php print( $_POST["clientID"]); ?></dd> -->
        </dl>
        <form action="user-form.php" method="post">
            <input type="hidden" name="lastname" value="<?php print( $_POST["firestname"]); ?>"></input>
            <input type="hidden" name="firstname" value="<?php print( $_POST["lastname"]); ?>"></input>
            <input type="hidden" name="phone" value="<?php print( $_POST["phone"]); ?>"></input>
            <input type="hidden" name="address" value="<?php print( $_POST["address"]); ?>"></input>
            <!-- <input type="hidden" name="clientID" value="<?php print( $_POST["clientID"]); ?>"></input> -->
            <button type="submit">Back</button>
        </form>
        <form action="end.php" method="post">
            <input type="hidden" name="lastname" value="<?php print( $_POST["lastname"]); ?>"></input>
            <input type="hidden" name="firstname" value="<?php print( $_POST["firstname"]); ?>"></input>
            <input type="hidden" name="phone" value="<?php print( $_POST["phone"]); ?>"></input>
            <input type="hidden" name="address" value="<?php print( $_POST["address"]); ?>"></input>
            <!-- <input type="hidden" name="clientID" value="<?php print( $_POST["clientID"]); ?>"></input> -->
            <button type="submit">End</button>
        </form>
    </body>
</html>
