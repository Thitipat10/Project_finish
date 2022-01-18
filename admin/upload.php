<?php 




if(isset($_FILES['upload']['name']) && !empty($_FILES['upload']['name'])){
    //ประเภทไฟล์
    $target = 'upload/test/';
    //ไฟล์ที่จะเก็บรูปภาพ
    $filename = $_FILES['upload']['name'];
    $filetmp = $_FILES['upload']['tmp_name'];

        if (!file_exists($target . $filename)) {  // ไม่มีชื่อไฟล์ซ้ำ
            if (move_uploaded_file($filetmp, $target . $filename)) {
                $filename = $filename;
            } 
        } else {        
            $newfilename = time() . $filename;
            if (move_uploaded_file($filetmp, $target . $newfilename)) {
                $filename = $newfilename;
            }
        }
        $function_number = $_GET['CKEditorFuncNum'];
        $url = 'http://localhost/project/admin/upload/test/'.$filename;
        $message = '';
        echo '<script>';
        echo 'window.parent.CKEDITOR.tools.callFunction("'. $function_number.'","'
        .$url.'","' .$message.'")';
        echo '</script>';
}




?>