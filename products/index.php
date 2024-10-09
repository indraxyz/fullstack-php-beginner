<?php
require_once '../templates/header.php';
?>

<form action="" method="post">
    <!-- .
        another filter here
    . -->
    <div>
        <label>Price</label>
        <select name="price">
            <option value="ASC" <?php if(isset($_POST["cari"]) && ($_POST["price"]=='ASC')) {echo "selected";} ?> >Ascending</option>
            <option value="DESC" <?php if(isset($_POST["cari"]) && ($_POST["price"]=='DESC')) {echo "selected";} ?> >Descending</option>
        </select>
    </div>
    <input type="search" name="sk" placeholder="Search Name ..." <?php if(isset($_POST["cari"])) {echo "value={$_POST["sk"]}";} ?> >
    <button type="submit" name="cari">🔎</button>
</form>
<a href="/php-beginner/products/create.php">
    <button type="button">+Product</button>
</a>

<?php
    // cek cari
    if (isset($_POST['cari']) ){
        // cek parameter pencarian dan filter
        $products = $db->query("SELECT * FROM products WHERE name LIKE '%". $_POST['sk'] ."%' ORDER BY price ". $_POST['price']);
    } else {
        $products = $db->query("SELECT * FROM products");
    }

    if (isset($products)) {
        echo"
            <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Weight</th>
                <th>Discount</th>
                <th>stock</th>
                <th>Description</th>
                <th>Category</th>
                <th>Thumbnail</th>
                <th>🎮</th>
            </tr>
        ";

        while ($product = $products->fetch(PDO::FETCH_OBJ)) {
            echo"  
                <tr>
                    <td>$product->id</td>
                    <td>$product->name</td>
                    <td>$product->price</td>
                    <td>$product->weight</td>
                    <td>$product->discount</td>
                    <td>$product->stock</td>
                    <td>$product->description</td>
                    <td>". ($product->category_fk=='' ? '-':$product->category_fk) ."</td>
                    <td>". ($product->thumbnail=='' ? '-':$product->thumbnail) ."</td>
                    <td>
                        <a href='./detail.php?id=$product->id'>Detail</a>   
                        <a href='./edit.php?id=$product->id'>Edit</a>
                        <a onclick='return confirm(`Are you sure delete this data ?`)' href='./?delete&id=$product->id'>Delete</a>      
                    </td>
                </tr>
                ";
        };
    } else {
        echo "kendala pada server";
    }
    
    
?>

</table>

<?php

if (isset($_GET['delete'])) {
    if ($_GET['id']) {
        $result = $db->query("DELETE FROM products WHERE id = " . $_GET['id']);
        if ($result) {
           exit(header('Location:/php-beginner/products/',true,  301));
        }
    }
}

require_once '../templates/footer.php';
?>