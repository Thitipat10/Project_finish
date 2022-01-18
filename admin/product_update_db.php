<?php require_once('connection/connection.php') ?>
<?php require_once('connection/conn.php') ?>



<?php


  if (isset($_POST) && !empty($_POST)) {
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    $idproduct = $_POST['idpro'];
    $data = [
        'title' => $_POST['title'],
        'detail' => $_POST['detail'],
        'number' => $_POST['number'],
        'id'=> $_POST['idpro']
    ];

    $sql = "UPDATE tb_product SET title=:title,detail=:detail,number=:number WHERE id_product=:id";
    $query = $conn->prepare($sql);
    $query->execute($data);
    Header("Location:product_update.php?id=".$idproduct );


    if (empty($_FILES['filUpload']['tmp_name'][0])) {
    } else {

        $_SESSION['idid'] = $_POST['idimage'];
        $idid = $_SESSION['idid'];
        if (isset($_FILES["filUpload"])) {
            foreach ($_FILES['filUpload']['tmp_name'] as $key => $val) {

                $file_type = strrchr($_FILES['filUpload']['name'][$key], ".");
                $file_name = 'product_' . rand() . $file_type;
                $file_size = $_FILES['filUpload']['size'][$key];
                $file_tmp = $_FILES['filUpload']['tmp_name'][$key];
                $file_type = $_FILES['filUpload']['type'][$key];
                move_uploaded_file($file_tmp, 'upload/product/' . $file_name);
                $sql2 = "INSERT INTO tb_product_image (tb_product_id,image) VALUES ('$idid','$file_name')";
                $query2 = mysqli_query($connection, $sql2);
            }

            unset($_SESSION['idid']);
        }
    }
   
} 
?>