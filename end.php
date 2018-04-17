<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include "connect.php";

    session_start();
    $items = $_SESSION["cart_item"];

    //print("<pre>"); print_r($items); print("</pre>");

    // Calculate total price:
    $totalPrice = 0;
    foreach($items as $item) {
        $totalPrice = $totalPrice + $item["hinta"] * $item["maara"];
    }

    // Add client and order info into DB.

    // Connect to DB:
    $db_handle= new DBController();
    $connection = $db_handle->conn;

    // 1. Add client:
    $etunimi = $_POST["firstname"];
    $sukunimi = $_POST["lastname"];
    $osoite = $_POST["address"];
    $puhelinnumero = $_POST["phone"];
    $query = "insert into ASIAKAS (etunimi, sukunimi, osoite, puhelinnumero) values ('$etunimi','$sukunimi','$osoite','$puhelinnumero')";
    // print("<p>SQL: '$query'</p>");
    if (!mysqli_query($connection, $query)) {
      // printf("Errormessage: %s\n", mysqli_error($connection));
      exit();
    }

    // 2. Get client id:
    $clientId = mysqli_insert_id($db_handle->conn);

    // 3. Add order items:
    foreach($items as $item) {
      $productId = $item['TuoteID'];
      $productGroupId = $item['TuoteRyhmaID'];
      $amount = $item['maara'];
      $query = "insert into TILAUS (asiakasnumero, TuoteID, kpl, ryhmaID) values ($clientId, '$productId', $amount, $productGroupId)";
      // print("<p>SQL: '$query'</p>");
      if (!mysqli_query($connection, $query)) {
        // printf("Errormessage: %s\n", mysqli_error($connection));
        exit();
      }
    }
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
    <div>
        <!-- <form action="confirm.php" method="post"> -->
        Thank you <span><?php print( $_POST["firstname"]); ?> </span><span><?php print( $_POST["lastname"]); ?></span>, your order was submitted.
        <!-- </form> -->
        <h3>You purchased</h3>
        <dl>
            <?php foreach($items as $item) { ?>
                <dt>Item name</dt>
                <dd><?php print($item["tuotteenNimi"]);?></dd>
                <dt>Amount</dt>
                <dd><?php print($item["maara"]);?></dd>
                <dt>Price</dt>
                <dd><?php print($item["hinta"]);?> €</dd>
            <?php } ?>
        </dl>
        <dt>Total price</dt>
        <dd><?php print($totalPrice);?>.00 €</dd>
    </div>
    </body>
</html>