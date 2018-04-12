<?php 
    // session_start();
    // $_SESSION["lastname"] = $_POST["lastname"]
    // print("<pre>");
    // print_r($_POST);
    // print("</pre>");
?>
Please confirm your information:
<!-- Data List, Data Term, Data Description -->
<dl>
    <dt>Last Name</dt>
    <dd><?php print( $_POST["lastname"]); ?></dd>
    <dt>First Name</dt>
    <dd><?php print( $_POST["firstname"]); ?></dd>
</dl>
<form action="user-form.php" method="post">
    <input type="hidden" name="lastname" value="<?php print( $_POST["lastname"]); ?>"></input>
    <input type="hidden" name="firstname" value="<?php print( $_POST["firstname"]); ?>"></input>
    <button type="submit">Back</button>
</form>
<form action="end.php" method="post">
    <button type="submit">End</button>
</form>