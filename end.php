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
<div>
    Thank you firstname lastname, your order was submitted.
    <h3>You purchased</h3>
    <dl>
        <?php foreach($items as $item) { ?>
            <dt>Item name</dt>
            <dd><?php print($item["tuotteenNimi"]);?></dd>
            <dt>Amount</dt>
            <dd><?php print($item["maara"]);?></dd>
            <dt>Price</dt>
            <dd><?php print($item["hinta"]);?></dd>
        <?php } ?>
    </dl>
    <dt>Total price</dt>
    <dd><?php print($totalPrice);?></dd>
</div>