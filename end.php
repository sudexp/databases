<?php
    session_start();
    $items = $_SESSION["cart_item"];
    // print("<pre>");
    // print_r($items);
    // print("</pre>");
    $totalPrice = 0;  
    foreach($items as $item) {
        $totalPrice = $totalPrice + $item["hinta"] * $item["maara"];
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