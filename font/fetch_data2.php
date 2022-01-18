<?php
require_once('connection/conn.php');
require_once('connection/connection.php');

@$output = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($connection, $_POST["query"]);
    $query = "
	SELECT * FROM tb_product 
	WHERE title LIKE '%" . $search . "%'
	";
} else {
    $query = "
	SELECT * FROM tb_product ORDER BY id_product";
}
$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) > 0) {


    foreach ($result as $row) {
        $productid = $row['id_product'];
        $sql = "SELECT  * FROM tb_product_image as tt
                             INNER JOIN tb_product as pp ON pp.id_product  = tt.tb_product_id
                             WHERE status = 0 AND statusimage = 1 AND tt.tb_product_id = $productid ";
        $query = mysqli_query($connection, $sql);
        $result = mysqli_fetch_assoc($query);

        $output .= '
             
   <div class="col-sm-4 col-lg-3 col-md-3 ">
      <a class="text-dark " href="product_detail.php?id=' . $row['id_product'] . '">
     <div class="card my-3">
     <img class="img2" src="../admin/upload/product/' . @$result['image'] . ' "width="auto" height="300">
     <div class="card-body">
         <p class="card-text text-center text-over">' . $row['title'] . '</p>
         <h5 class="card-title text-orage ">&#3647;' . $row['price'] . '</h5>
            <form action="insertCart.php" method="post">
       
       
            <input type="hidden" name="url" value="type_product.php">
            <input type="hidden" name="ProductID" value="' . $row['id_product'] . '">
            <input type="hidden" name="qty" value="' . "1" . '">
            <input type="hidden" name="user" value="' . @$_SESSION['id'] . '">
            <input type="hidden" name="tb_size_id2" value="' . $row['tb_size_id'] . '">
            <input type="hidden" name="tb_color_id2" value="' . $row['tb_color_id'] . '">
     </div>
    </div>
 </a> 

   </div>
 </form>
   ';
    }
    echo $output;
} else {
    echo 'Data Not Found';
}
