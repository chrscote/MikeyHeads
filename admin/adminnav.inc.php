<table width="100%" cellpadding="2" border="0">
  <tr>
    <td><h3>Mikey Heads Administration</h3></td>
  </tr>
  <tr>
    <td><a href="admin.php"><strong>Home</strong></a></td>
  </tr>
  <tr>
  	<td><a href="../index.php"><strong>Back to site</strong></a></td>
  </tr>
  <tr>
    <td><hr size="1" noshade="noshade" /></td>
  </tr>
<?php
   if (isset($_SESSION['admin'])) {
?>
	<tr>
    	<td><a href="admin.php?content=addCat"><strong>Add Category</strong></a></td>
    </tr>
	<tr>
    	<td><a href="admin.php?content=addProd"><strong>Add Product</strong></a></td>
    </tr>
	<tr>
    	<td><a href="admin.php?content=listProd"><strong>List Products</strong></a></td>
    </tr>
	<tr>
    	<td><a href="admin.php?content=txns"><strong>List Transactions</strong></a></td>
    </tr>
<?php	   
   }
?>

</table>


