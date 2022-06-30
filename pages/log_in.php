<?php
include('./header.php');
$iName = $iPass = $loginErr = "";
    $nameErr = $passErr = $passmd5="";
//Lưu ý: empty và isset sẽ trả về TRUE nếu biến không tồn tại 
if (isset($_POST['submit_btn'])) {
    
    $iName = $_POST['ipnName'];
    $iPass = $_POST['ipnPass'];
    $patternName = '/^\\w*$/';
    //$patternName = '/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';
    // mật khẩu yêu cầu có ít nhất 1  chữ thường, 1 chữ hoa, 1 số, có tối đa 20 kí tự

    $patternPass = '/((?=.*\\d)(?=.*[a-z])(?=.*[@#$%!]).{4,20})/';

    //Loại bỏ tất cả các thẻ html và php ra khỏi chuỗi. Nếu thẻ nào muốn giữ lại thì strip_tag(chuỗi,"tên thẻ")
    //$iName = strip_tags($iName);
    //thêm các \ trước các kí tự đặc biệt {',",\,...}
    // $iName = addslashes($iName);
    $iPass = strip_tags($iPass);
    $iPass = addslashes($iPass);

    if (empty($iName)) {
        $nameErr = "Họ tên không được bỏ trống!";
    }

    //kiểm tra tên chỉ nhập bằng chữ
    else if (!preg_match($patternName, $iName)) {
        $nameErr = "Không tồn tại tên đăng nhập này";
    }
    if (empty($iPass)) {
        $passErr = "Password không được bỏ trống!";
    } else {
        if (!preg_match($patternPass, $iPass))
            $passErr = "Mật khẩu không đúng";
            else
            $passmd5=md5($iPass);
    }
    //Kết nối đến csdl
    include '../database/connect.php';
    //câu lệnh sql
    
    $sql = "select *from tbl_user where user_name='$iName' and user_password='$passmd5' ";
    $query = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($query);
    if ($num_rows == 0) {
        $loginErr = "Tên đăng nhập hoặc mật khẩu không đúng";
    } else {
        //Lưu tên đăng nhập và mật khẩu vào session để tiện xử lý sau này
       $_SESSION['user']=$iName;

       
        //thực thi hành động sua khi lưu thông tin
        //=> chuyển hướng trang web tới một tragn index.php
        // if($_GET['action']=='cart'){
        //     echo "<script>window.location.href='./cart_view.php'</script>";
        // }
        // else
       echo "<script>window.location.href='./home.php'</script>";
    }
}


?>

    <div class="login_container">
        <div class="login_wapper">
            <div class="login_tittle">
                <h2>Đăng nhập<h2>
            </div>
            <form method="post" action="">
                <div class="login_group userip">
                    <div class="login_loginf">
                        <div class="login_icon">
                            <i class="login_fa-regular fa fa-user"></i>
                        </div>
                        <div id="login_user">
                            <input type="text" value="" name="ipnName" placeholder="Tên đăng nhập" autofocus>
                        </div>
                    </div>

                    <div class="login_messerror"> <span><?php echo $nameErr; ?></span></div>
                </div>
                <div class="login_group passwordip">
                    <div class="login_loginf">
                        <div class="login_icon">
                            <i class="login_fa-solid fa fa-lock"></i>
                        </div>
                        <div id="login_pass">
                            <input type="password" id="login_ipnPassword" placeholder="Mật khẩu" name="ipnPass">
                        </div>
                        <div id="login_showpass">
                            <button id="login_btnPassword" type="button">
                                <i class="login_fa-regular fa fa-eye" id="login_btnEye"></i>

                            </button>

                        </div>
                    </div>
                    <div class="login_messerror">
                        <span>
                            <?php if($passErr=="")
                            echo ("$loginErr");
                            else
                            echo("$passErr");

                         ?></span>
                    </div>
                </div>
                <div class="login_submit_btn">
                    <button name="submit_btn">Đăng nhập</button>
                </div>
                <div class="login_sp1">
                <div>
                <span ><a>Quên mật khẩu</a></span>

                </div>
                <div>

                <span >Bạn đã có tài khoản chưa? Đăng ký <a href="register.php">Tại đây</a></span>
                </div>
                </div>

                </from>
        </div>
    </div>

    <script src="../js/log_in.js"></script>

<?php include('./footer.php');