    <?php require_once('connection/conn.php') ?>
    <?php require_once('connection/connection.php') ?>
  <?php
  

    if (isset($_GET['offadmin'])) {
        $data = [
            'id' => $_GET['offadmin'],
            'status' => 1
        ];
        try {
            $sql = "UPDATE tb_admin SET status=:status WHERE id=:id";
            $query = $conn->prepare($sql);
            $query->execute($data);
            $_SESSION['m'] = 1;
            Header("Location:member.php");
        } catch (PDOException $e) {
            echo 'ลบไม่สำเร็จ' . $e->getMessage();
        }
    }


    if (isset($_GET['onadmin'])) {
        $data = [
            'id' => $_GET['onadmin'],
            'status' => 0
        ];
        try {
            $sql = "UPDATE tb_admin SET status=:status WHERE id=:id";
            $query = $conn->prepare($sql);
            $query->execute($data);
            $_SESSION['m'] = 1;
            Header("Location:member.php");
        } catch (PDOException $e) {
            echo 'ลบไม่สำเร็จ' . $e->getMessage();
        }
    }



    if (isset($_GET['offadmintest'])) {
        $data = [
            'id' => $_GET['offadmintest'],
            'status' => 1
        ];
        try {
            $sql = "UPDATE tb_admin SET status=:status WHERE id=:id";
            $query = $conn->prepare($sql);
            $query->execute($data);
            $_SESSION['m'] = 1;
            Header("Location:admin.php");
        } catch (PDOException $e) {
            echo 'ลบไม่สำเร็จ' . $e->getMessage();
        }
    }


    if (isset($_GET['onadmintest'])) {
        $data = [
            'id' => $_GET['onadmintest'],
            'status' => 0
        ];
        try {
            $sql = "UPDATE tb_admin SET status=:status WHERE id=:id";
            $query = $conn->prepare($sql);
            $query->execute($data);
            $_SESSION['m'] = 1;
            Header("Location:admin.php");
        } catch (PDOException $e) {
            echo 'ลบไม่สำเร็จ' . $e->getMessage();
        }
    }
    ?>

    