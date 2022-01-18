
<?php require_once('connection/conn.php');

$data = [

    'user' => $_POST['user'],
    'pass' => md5($_POST['pass']),

];

$sql = "SELECT * FROM tb_admin WHERE user=:user AND pass=:pass";
$query = $conn->prepare($sql);
$query->execute($data);
$result = $query->fetch(PDO::FETCH_ASSOC);

if ($query->rowCount() == 1) {
    echo "<script>alert('เข้าสู่ระบบ')</script>";
    header("Location:index.php");
    $_SESSION['id'] = $result['id'];
    $_SESSION['user'] = $result['user'];
    $_SESSION['email'] = $result['email'];
    $_SESSION['firstname'] = $result['firstname'];
    $_SESSION['image'] = $result['image'];
    $_SESSION['login'] = 1;
} else {
    $_SESSION['login'] = 2;

    header("Location:login.php");
}


?>
