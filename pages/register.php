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


<body>
    <div class="register_container">
        <div class="register_wapper">
            <div class="register_tittler">
                <h2>Tạo tài khoản<h2>
            </div>
            <form class="register_form" method="post">

                <div class="register_group userip">
                    <div class="register_loginf">
                        <div class="register_icon">
                            <i class="register_fa-regular fa fa-user"></i>
                        </div>
                        <div id="user">
                            <input type="text" value="" name="ipnName" placeholder="Tên đăng nhập">
                        </div>
                    </div>

                    <div class="register_messerror spName ">
                        <span><?php echo $usernameErr; ?></span>
                    </div>
                </div>
                <div class="register_group passwordip">
                    <div class="register_loginf">
                        <div class="register_icon">
                            <i class="register_fa-solid fa fa-lock"></i>
                        </div>
                        <div id="pass">
                            <input type="password" id="ipnPassword" placeholder="Mật khẩu" name="ipnPass" value="">
                        </div>
                        <div id="showpass">
                            <button id="btnPassword" type="button">
                                <i class="register_fa-regular fa fa-eye" id="btnEye"></i>

                            </button>

                        </div>

                    </div>
                    <div class="register_messerror ">
                        <span><?php echo $passErr; ?></span>
                    </div>

                </div>
                <div class="register_group passwordipagain">
                    <div class="register_loginf">
                        <div class="register_icon">
                            <i class="register_fa-solid fa fa-lock"></i>
                        </div>
                        <div id="pass">
                            <input type="password" id="ipnPasswordAgain" placeholder="Xác nhận mật khẩu" name="ipnPassAgain" value="">
                        </div>
                        <div id="showpass">
                            <button id="btnPasswordAgain" type="button">
                                <i class="register_fa-regular fa fa-eye" id="btnEye"></i>

                            </button>

                        </div>


                    </div>
                    <div class="register_messerror ">
                        <span><?php echo $passAgainErr; ?></span>
                    </div>
                    <div class="register_group emailip">
                        <div class="register_loginf">
                            <div class="register_icon">
                                <i class="register_fa-regular fa fa-envelope"></i>
                            </div>
                            <div id="user">
                                <input type="text" value="" name="ipnEmail" placeholder="Email">
                            </div>
                        </div>

                        <div class="register_messerror spName ">
                            <span><?php echo $emailErr; ?></span>
                        </div>
                    </div>
                    <div class="register_group phoneip">
                        <div class="register_loginf">
                            <div class="register_icon">
                                <i class="register_fa-solid fa fa-phone"></i>
                            </div>
                            <div id="user">
                                <input type="text" value="" name="ipnPhone" placeholder="Số điện thoại">
                            </div>
                        </div>

                        <div class="register_messerror spName ">
                            <span><?php echo $phoneErr; ?></span>
                        </div>
                    </div>
                    <div class="register_submit_btn">
                        <button name="submit_btn">Đăng ký</button>
                    </div>

                    <!-- <span>hoặc</span><hr> -->
                    <div class="register_separator">
                        <span>hoặc</span>
                    </div>
                    <!-- <div class="register_orthericon">

                        <div class="register_quick_login facebook">
                            <div class="register_logo">
                                <i class="register_fab fa fa-facebook-f"></i>
                            </div>
                            <div class="register_text">Đăng nhập bằng Facebook</div>


                        </div>
                        <div class="register_quick_login google">
                            <div class="register_logo">
                                <i class="register_fab fa fa-google-plus-g"></i>
                            </div>
                            <div class="register_text">Đăng nhập bằng Google</div>
                        </div>

                    </div> -->
                    <div class="register_sp1">
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