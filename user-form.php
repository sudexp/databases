<!-- Form for user to enter his info (name, address, payment info, etc) -->
<form action="confirm.php" method="post">
    <label>Last Name</label>
    <input type="text" name="lastname" value="<?php print( $_POST["lastname"]); ?>"></input>
    <label>First Name</label>
    <input type="text" name="firstname" value="<?php print( $_POST["firstname"]); ?>"></input>
    <button type="submit">Submit</button>
</form>