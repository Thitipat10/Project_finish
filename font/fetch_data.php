<?php

//fetch_data.php

require_once('connection/conn.php');
require_once('connection/connection.php');

if (isset($_POST["action"])) {
    $query = "
    SELECT * FROM tb_product as p
    JOIN tb_type_product as t ON p.type_product_id =t.id_type_product
    JOIN tb_size as s ON p.tb_size_id =s.id_size
    JOIN tb_color as c ON p.tb_color_id = c.id_color WHERE p.status = '0' AND p.number != 0  ";

    if (isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"])) {
        $query .= "
   AND price BETWEEN '" . $_POST["minimum_price"] . "' AND '" . $_POST["maximum_price"] . "'
  ";
    }
    if (isset($_POST["title_type"])) {
        $title_type_filter = implode("','", $_POST["title_type"]);
        $query .= "
   AND title_type IN('" . $title_type_filter . "')
  ";
    }
    if (isset($_POST["title_color"])) {
        $color_filter = implode("','", $_POST["title_color"]);
        $query .= "
   AND title_color IN('" . $color_filter . "')
  ";
    }
    if (isset($_POST["title_size"])) {
        $size_filter = implode("','", $_POST["title_size"]);
        $query .= "
   AND title_size IN('" . $size_filter . "')
  ";
    }
  // if (isset($_POST["search"])) {
  //   $search = mysqli_real_escape_string($connection, $_POST["search"]);
  //   $query = "
	// SELECT * FROM tb_product 
	// WHERE title LIKE '%" . $search . "%'
	// ";
  // } else {
  //   $query = "
	// SELECT * FROM tb_product ORDER BY id_product";
  // };

    //     if (isset($_POST["ram"])) {
    //         $ram_filter = implode("','", $_POST["ram"]);
    //         $query .= "
    //    AND product_ram IN('" . $ram_filter . "')
    //   ";
    //     }
    //     if (isset($_POST["storage"])) {
    //         $storage_filter = implode("','", $_POST["storage"]);
    //         $query .= "
    //    AND product_storage IN('" . $storage_filter . "') ";
    //     }

    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();

    $output = '';
    if ($total_row > 0) {
        
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
         <h5 class="card-title text-orage ">&#3647;'. $row['price'] . '</h5>
            <form action="insertCart.php" method="post">
       
       
            <input type="hidden" name="url" value="type_product.php">
            <input type="hidden" name="ProductID" value="'. $row['id_product'] . '">
            <input type="hidden" name="qty" value="' . "1" . '">
            <input type="hidden" name="user" value="' .@$_SESSION['id'] .'">
            <input type="hidden" name="tb_size_id2" value="'.$row['tb_size_id'] .'">
            <input type="hidden" name="tb_color_id2" value="'. $row['tb_color_id'] . '">
     </div>
    </div>
 </a> 

   </div>
 </form>
   ';
        }
    } else {
        $output = '<h3>ไม่มีรายการสินค้า</h3>';
    }
    echo $output;
}

// $output = '';

// if (isset($_POST["action"])) {
//   $search = mysqli_real_escape_string($connection, $_POST["query"]);
//   $query = "
// 	SELECT * FROM tb_product 
// 	WHERE title LIKE '%" . $search . "%'
// 	";
// } else {
//   $query = "
// 	SELECT * FROM tb_product ORDER BY id_product";
// }
// $result = mysqli_query($connection, $query);
// if (mysqli_num_rows($result) > 0) {


//   foreach ($result as $row) {
//     $productid = $row['id_product'];
//     $sql = "SELECT  * FROM tb_product_image as tt
//                              INNER JOIN tb_product as pp ON pp.id_product  = tt.tb_product_id
//                              WHERE status = 0 AND statusimage = 1 AND tt.tb_product_id = $productid ";
//     $query = mysqli_query($connection, $sql);
//     $result = mysqli_fetch_assoc($query);

//     $output .= '
             
//    <div class="col-sm-4 col-lg-3 col-md-3 ">
//       <a class="text-dark " href="product_detail.php?id=' . $row['id_product'] . '">
//      <div class="card my-3">
//      <img class="img2" src="../admin/upload/product/' . $result['image'] . ' "width="auto" height="300">
//      <div class="card-body">
//          <p class="card-text text-center text-over">' . $row['title'] . '</p>
//          <h5 class="card-title text-orage ">&#3647;' . $row['price'] . '</h5>
//             <form action="insertCart.php" method="post">
       
       
//             <input type="hidden" name="url" value="type_product.php">
//             <input type="hidden" name="ProductID" value="' . $row['id_product'] . '">
//             <input type="hidden" name="qty" value="' . "1" . '">
//             <input type="hidden" name="user" value="' . @$_SESSION['id'] . '">
//             <input type="hidden" name="tb_size_id2" value="' . $row['tb_size_id'] . '">
//             <input type="hidden" name="tb_color_id2" value="' . $row['tb_color_id'] . '">
//      </div>
//     </div>
//  </a> 

//    </div>
//  </form>
//    ';
//   }
//   echo $output;
// } else {
//   echo 'Data Not Found';
// }