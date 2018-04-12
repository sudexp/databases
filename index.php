<?php
session_start();
include "connect.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);

$db_handle= new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["maara"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM TUOTTEET WHERE TuoteCode='" . $_GET["TuoteCode"] . "'");
			$itemArray = array(
			  $productByCode[0]["TuoteCode"] => array(
			    'tuotteenNimi' => $productByCode[0]["tuotteenNimi"],
			    'TuoteCode' => $productByCode[0]["TuoteCode"],
			    'maara' => $_POST["maara"],
			    'hinta' => $productByCode[0]["hinta"]
        )
      );
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["TuoteCode"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
                            if($productByCode[0]["TuoteCode"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["maara"])) {
									$_SESSION["cart_item"][$k]["maara"] = 0;
								}
								$_SESSION["cart_item"][$k]["maara"] += $_POST["maara"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["TuoteCode"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>

<HTML>
<HEAD>
<TITLE>OSTOSKORISYSTEEMIMME JEEE</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
<div id="shopping-cart">
<div class="txt-heading">Shopping Cart <a id="btnEmpty" href="index.php?action=empty">Empty Cart</a><a id="checkOut" href="user-form.php">Check Out</a></div>
<?php
if(isset($_SESSION["cart_item"])){
    $item_total = 0;
?>	
<table cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;"><strong>Tuotteen nimi</strong></th>
<th style="text-align:left;"><strong>TuoteCode</strong></th>
<th style="text-align:right;"><strong>Maara</strong></th>
<th style="text-align:right;"><strong>Hinta</strong></th>
<th style="text-align:center;"><strong>Action</strong></th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
		?>
				<tr>
				<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["tuotteenNimi"]; ?></strong></td>
				<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["TuoteCode"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["maara"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo "$".$item["hinta"]; ?></td>
				<td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="index.php?action=remove&TuoteCode=<?php echo $item["TuoteCode"]; ?>" class="btnRemoveAction">Remove Item</a></td>
				</tr>
				<?php
        $item_total += ($item["hinta"]*$item["maara"]);
		}
		?>

<tr>
<td colspan="5" align=right><strong>Total:</strong> <?php echo "$".$item_total; ?></td>
</tr>
</tbody>
</table>		
  <?php
}
?>
</div>

<div id="product-grid">
	<div class="txt-heading">Products</div>
	<?php
    // here was an extra variable before "SELECT * FROM TUOTTEET"
	$product_array = $db_handle->runQuery("SELECT * FROM TUOTTEET") or die("Tuotetietoja ei voitu noutaa");
	if (!empty($product_array)) {
        foreach($product_array as $key=>$value){

	?>
		<div class="product-item">
            <!-- here was name of array instead of $value-->
			<form method="post" action="index.php?action=add&TuoteCode=<?php echo $value["TuoteCode"]; ?>">
			<div><strong><?php echo $value["tuotteenNimi"]; ?></strong></div>
			<div class="product-price">$<?php echo $value["hinta"]; ?></div>
			<div><input type="text" name="maara" value="1" size="2" /><input type="submit" value="Add to cart" class="btnAddAction" /></div>
			</form>
		</div>

	<?php
			}
	}
	?>
</div>
</BODY>
</HTML>