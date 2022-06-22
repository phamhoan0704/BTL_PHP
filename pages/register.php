<?php
include('./header.php');
include('../database/connect.php');
//tạo hàm chuẩn hóa lại dữ liệu do người dùng nhập vào
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
//định nghĩa các biến và khởi tạo rỗng
$username = $pass = $passAgain = $email = $phone = "";
$usernameErr = $passErr = $passAgainErr = $emailErr = $phoneErr = $register = "";

//Kiểm tra nếu người dùng bấm submit chưa
if (isset($_POST['submit_btn'])) {
    if (empty($_POST['ipnName'])) {
        $register = $usernameErr = "Tên người dùng không được để trống";
    }
     else {
        $username = $_POST['ipnName'];
        $regUserName = '/^\\w*$/';
        if (!preg_match($regUserName, $username))
            $register = $usernameErr = "Tên đăng nhập có trên 4 kí tự chữ cái và số!";
        else 
        {
            $sqli = "SELECT * from tbl_user where user_name='$username';";
            $query = mysqli_query($conn, $sqli);
            $num_rows = mysqli_num_rows($query);
            if ($num_rows != 0)
                $usernameErr = $register = "Tên đăng nhập này đã tồn tại !";
        }
    }
    if (empty($_POST['ipnPass']))
        $register = $passErr = "Mật khẩu không được để trống";
    else {
        $pass = $_POST['ipnPass'];
        $regPass = '/((?=.*\\d)(?=.*[a-z])(?=.*[@#$%!]).{4,20})/';
        if (!preg_match($regPass, $pass)) 
        {
            $register = $passErr = "Mật khẩu dài trên 6 kí tự gồm chữ cái, số, kí tự đặc biệt!";
        }
    }
    if (empty($_POST['ipnPassAgain'])) {
        $register = $passAgainErr = "Xác nhận lại mật khẩu";
    } else 
    {
        $passAgain = $_POST['ipnPassAgain'];
        if (!$passAgain == $pass) 
        {
            $register = $passAgainErr = "Mật khẩu không trùng khớp!";
        } else
            $passmd5 = md5($passAgain);
    }
    if (empty($_POST['ipnEmail'])) {
        $register = $emailErr = "Email không được để trống!";
    } else {
        $email = $_POST['ipnEmail'];
        $regEmail = '/^\w+([.-]?\w+)@\w+([.-]?\w+)(.\w{2,3})+$/';
        if (!preg_match($regEmail, $email))
            $register = $emailErr = "Email không đúng định dạng text123@gmail.com";
    }
    if (empty($_POST['ipnPhone']))
        $register = $phoneErr = "Số điện thoại không được để trống!";
    else {
        $phone = $_POST['ipnPhone'];
        $regPhone = '/^\\d+$/';
        if (!preg_match($regPhone, $phone))
            $register = $phoneErr = "Chỉ bao gồm chữ số!";
    }
    if (empty($register)) {
        $sql = "INSERT INTO `tbl_user`( `user_name`, `user_password`, `user_email`, `user_phone`, `user_type`)
         values ('$username','$passmd5','$email','$phone','2');";
        if (mysqli_query($conn, $sql)) {
            $user_id=$conn->insert_id;       
            $sql2="INSERT INTO `tbl_cart`(`user_id`) VALUES('$user_id')";
            mysqli_query($conn,$sql2);
              // header("location:./log_in.php");
         echo "<script>window.location.href='./log_in.php'</script>";
        } else
            echo "Error " . mysqli_error($conn);
    }
    {
        
    mysqli_close($conn);
        

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký thành viên</title>

    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="wapper">
            <div class="tittle">
                <h2>Tạo tài khoản<h2>
            </div>
            <form class="form" method="post">

                <div class="group userip">
                    <div class="loginf">
                        <div class="icon">
                            <i class="fa-regular fa-user"></i>
                        </div>
                        <div id="user">
                            <input type="text" value="" name="ipnName" placeholder="Tên đăng nhập">
                        </div>
                    </div>

                    <div class="messerror spName ">
                        <span><?php echo $usernameErr; ?></span>
                    </div>
                </div>
                <div class="group passwordip">
                    <div class="loginf">
                        <div class="icon">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div id="pass">
                            <input type="password" id="ipnPassword" placeholder="Mật khẩu" name="ipnPass" value="">
                        </div>
                        <div id="showpass">
                            <button id="btnPassword" type="button">
                                <i class="fa-regular fa-eye" id="btnEye"></i>

                            </button>

                        </div>

                    </div>
                    <div class="messerror ">
                        <span><?php echo $passErr; ?></span>
                    </div>

                </div>
                <div class="group passwordipagain">
                    <div class="loginf">
                        <div class="icon">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div id="pass">
                            <input type="password" id="ipnPasswordAgain" placeholder="Xác nhận mật khẩu" name="ipnPassAgain" value="">
                        </div>
                        <div id="showpass">
                            <button id="btnPasswordAgain" type="button">
                                <i class="fa-regular fa-eye" id="btnEye"></i>

                            </button>

                        </div>


                    </div>
                    <div class="messerror ">
                        <span><?php echo $passAgainErr; ?></span>
                    </div>
                    <div class="group emailip">
                        <div class="loginf">
                            <div class="icon">
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                            <div id="user">
                                <input type="text" value="" name="ipnEmail" placeholder="Email">
                            </div>
                        </div>

                        <div class="messerror spName ">
                            <span><?php echo $emailErr; ?></span>
                        </div>
                    </div>
                    <div class="group phoneip">
                        <div class="loginf">
                            <div class="icon">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div id="user">
                                <input type="text" value="" name="ipnPhone" placeholder="Số điện thoại">
                            </div>
                        </div>

                        <div class="messerror spName ">
                            <span><?php echo $phoneErr; ?></span>
                        </div>
                    </div>
                    <div class=" submit_btn">
                        <button name="submit_btn">Đăng ký</button>
                    </div>

                    <!-- <span>hoặc</span><hr> -->
                    <div class="separator">
                        <span>hoặc</span>
                    </div>
                    <!-- <div class="orthericon">

                        <div class="quick_login facebook">
                            <div class="logo">
                                <i class="fab fa-facebook-f"></i>
                            </div>
                            <div class="text">Đăng nhập bằng Facebook</div>


                        </div>
                        <div class="quick_login google">
                            <div class="logo">
                                <i class="fab fa-google-plus-g"></i>
                            </div>
                            <div class="text">Đăng nhập bằng Google</div>
                        </div>

                    </div> -->
                    <div class="sp1">
                        <span>Bạn đã có tài khoản? Đăng nhập <a href="../includes/log_in.php">Tại đây</a></span>
                    </div>


                </div>

            </form>
        </div>
    </div>

    <script src="../js/register.js"></script>
</body>

</html>
<?php include('./footer.php') ?>;