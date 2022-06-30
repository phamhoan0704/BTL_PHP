<?php 
include('./header.php');
if (!isset($_SESSION['user'])) {
    header('Location:log_in.php');
} else {
    $user = $_SESSION['user'];
    echo $user;
    include '../database/connect.php';
    $sql = "select * from tbl_user where user_name='$user';";
    $pass_data = mysqli_query($conn, $sql);
    if ($pass_data) {
        $product = mysqli_fetch_array($pass_data);
        $result = $product[2];
        // đọc dữ liệu do người dùng nhập vào;
        function test_input($data)
        {
            //xóa các chuỗi kí tự \0 \n\t\x0B\r và các kí tự do người dùng yêu cầu
            $data = trim($data);
            //Loại bỏ các thẻ html và php ra khỏi chuỗi, tham số thứ hai của hàm giữ lại các chuỗi theo yêu cầu 
            $data = strip_tags($data);
            //Thêm các slashes(\) trước các kí tự đặc biệt trong chuỗi
            $data = addslashes($data);
            return $data;
        }
        $pass = $newPass = $newPassConfirm = "";
        $passErr = $newPassErr = $newPassConfirmErr = $Err = "";
        if (isset($_POST['btnsubmit'])) {
            if (empty($_POST['pass']))
                $passErr = $Err = "Mật khẩu không được bỏ trống!";
            else {
                $pass = $_POST['pass'];
                if ($pass != $result) {
                    $passErr = $Err = "Mật khẩu không chính xác!";
                }
            }
            if (empty($_POST['newpass']))
                $newPassErr = $Err = "Nhập mật khẩu mới!";
            else {
                $newPass = test_input($_POST['newpass']);
                $patternPass = '/((?=.*\\d)(?=.*[a-z])(?=.*[@#$%!]).{4,20})/';
                if (!preg_match($patternPass, $newPass))
                    $newPassErr = $Err = "Mật khẩu gồm chữ, số và kí tự đặc biệt!";
            }
            if (empty($_POST['newpassconfirm']))
                $newPassConfirmErr = $Err = "Xác nhận lại mật khẩu mới!";
            else {
                $newPassConfirm = test_input($_POST['newpassconfirm']);
                if ($newPass != $newPassConfirm)
                    $newPassConfirmErr = $Err = "Mật khẩu không trùng khớp!";
            }
            if ($Err == "") {
                $sqlupdate = "update account set password='$pass' where username='$user';";
                mysqli_query($conn, $sqlupdate);
                echo "<script type ='text/JavaScript'>";
                echo "alert('Đổi mật khẩu thành công!')";
                echo "</script>";
            }
        }
    }
}
include 'changepassword.php';
include'./footer.php';
mysqli_close($conn);
?>
