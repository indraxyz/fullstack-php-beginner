<?php
require_once '../templates/header.php';

$query = $db->prepare("SELECT * FROM products WHERE id = " . $_GET['id']);
$query->execute();
$product = $query->fetch(PDO::FETCH_OBJ);

?>

<h3>Edit Product</h3>
<form action="" method="post">
    <input type="hidden" name="id" value="<?= $product->id;?>"> <br>
    <input type="text" name="name" id="" placeholder="Name" value="<?= $product->name;?>"> <br>
    <input type="number" name="price" id="" placeholder="Price" value="<?= $product->price;?>"> <br>
    <input type="number" name="weight" id="" placeholder="Weight" value="<?= $product->weight;?>"> <br>
    <input type="number" name="discount" id="" placeholder="Discount" value="<?= $product->discount;?>"> <br>
    <input type="number" name="stock" id="" placeholder="Stock" value="<?= $product->stock;?>"> <br>
    <textarea name="description" id="" rows="7" placeholder="Description" value="<?= $product->description;?>"></textarea> <br>
    <span>Category</span>
     <select name="category_fk" id="">
        <option value="1">xxx</option>
        <option value="2">yyy</option>
        <option value="3">zzz</option>
    </select> <br>
     <span>Thumbnail</span>
     <input type="file" name="thumbnail" id="" placeholder="Thumbnail" ><br><br>
    <button type="submit" name="create">Submit</button>
</form>

<!-- update here -->