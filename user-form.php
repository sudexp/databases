<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Page Title</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="style.css"/>
        <title>Verkkokauppa</title>
    </head>
    <body>
        <!-- Form for user to enter his info (name, address, payment info, etc) -->
        <form action="confirm.php" method="post">
            <label>First Name</label>
            <input type="text" name="firstname" value="<?php print( $_POST["firstname"]); ?>"></input>
            <label>Last Name</label>
            <input type="text" name="lastname" value="<?php print( $_POST["lastname"]); ?>"></input>
            <label>Phone number</label>
            <input type="text" name="phone" value="<?php print( $_POST["phone"]); ?>"></input>
            <label>Address</label>
            <input type="text" name="address" value="<?php print( $_POST["address"]); ?>"></input>
            <!-- <label>Client ID</label>
            <input type="text" name="clientID" value="<?php print( $_POST["clientID"]); ?>"></input> -->
            <button type="submit">Submit</button>
        </form>
    </body>
</html>