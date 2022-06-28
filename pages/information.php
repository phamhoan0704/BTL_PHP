<?php
include('./header.php');
$usernameErr = $fullnameErr = $phoneErr = $emailErr = $submit = $fullname = "";


if (!isset($_SESSION['user']))
    header('Location:log_in.php');
else {
    $name = $phone = $img = $email = "";
    $user = $_SESSION['user'];
    include '../database/connect.php';
    $sql = "Select* from tbl_user where user_name='$user';";
    $query = mysqli_query($conn, $sql);
    while ($data = mysqli_fetch_array($query)) {
        $name = $data['user_name'];
        $phone = $data['user_phone'];
        $img = $data['user_image'];
        $email = $data['user_email'];
        $fullname = $data['user_fullname'];
    }
    if (isset($_POST['btnsubmit'])) {
        if (empty($_POST['fullname']))
            $submit = $fullnameErr = "Họ tên không được để trống!";
        else
            $fullname = $_POST['fullname'];
        if (empty($_POST['email'])) {
            $submit = $emailErr = "Email không được để trống!";
        } else {
            $email = $_POST['email'];
            $regEmail = '/^\w+([.-]?\w+)@\w+([.-]?\w+)(.\w{2,3})+$/';
            if (!preg_match($regEmail, $email))
                $submit = $emailErr = "Email không đúng định dạng text123@gmail.com";
        }
        if (empty($_POST['phone']))
            $submit = $phoneErr = "Số điện thoại không được để trống!";
        else {
            $phone = $_POST['phone'];
            $regPhone = '/^\\d+$/';
            if (!preg_match($regPhone, $phone))
                $submit = $phoneErr = "Chỉ bao gồm chữ số!";
        }
        if (empty($_POST['avataruser'])) {
            $img = "";
        } else {
            $img = $_POST['avataruser'];
        }
        if ($submit == "") {
            $sql1 = "update tbl_user set user_email='$email',user_phone='$phone',user_image='$img',user_fullname='$fullname' where user_name='$user';";
            if (mysqli_query($conn, $sql1)) {
            }
        }
    } else;
}

?>



    <div class="container">
        <div class="left_menu">
            <?php include './menuleft.php' ?>
        </div>
        <div class="box_infor">
            <div class="box_inforx">
                <div class="top-box">
                    <h1>Hồ sơ của tôi<h1>
                            <div class="borderbox">
                                Quản lí thông tin hồ sơ bảo mật tài khoản
                            </div>
                </div>
                <div class="mainbox">
                    <div class="leftboxinfor">
                        <form action="" method="post">
                            <div class="box">
                                <div class="inp">
                                    <div class="label">
                                        <label for="">Tên đăng nhập</label>
                                    </div>
                                    <div class="inpuif">
                                        <div class="input">
                                            <input type="text" name="username" value="<?php echo "$name"; ?>" readonly>

                                        </div>

                                        <div class="btn">
                                            <button></button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="box">
                                <div class="inp">
                                    <div class="label">
                                        <label for="">Họ và tên</label>
                                    </div>
                                    <div class="inpuif">
                                        <div class="input">
                                            <input type="text" name="fullname" placeholder="<?php echo "$fullname"; ?>">
                                            <span>
                                                <?php echo $fullnameErr; ?>
                                            </span>

                                        </div>
                                        <div class="btn">
                                            <button>Sửa</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="inp">
                                    <div class="label">
                                        <label for="">Số điện thoại</label>
                                    </div>
                                    <div class="inpuif">
                                        <div class="input">
                                            <input type="text" name="phone" placeholder="<?php echo "$phone" ?>">
                                            <span>
                                                <?php echo $phoneErr; ?>
                                            </span>
                                        </div>

                                        <div class="btn">
                                            <button>Sửa</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="inp">
                                    <div class="label">
                                        <label for="">Email</label>
                                    </div>
                                    <div class="inpuif">
                                        <div class="input">
                                            <input type="text" name="email" placeholder="<?php echo "$email"; ?>">
                                            <span>
                                                <?php echo $emailErr; ?></span>
                                        </div>

                                        <div class="btn">
                                            <button>Sửa</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="inp boxbtn">
                                    <div class="label"><label for=""></label></div>
                                    <div class="btnsave">
                                        <button name="btnsubmit">Lưu</button>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="imgbox2">
                        <div class="avatarbox">
                            <a href="" class="avatar">
                                <div class="frame-avatar2">
                                    <div class="avatar-img2">
                                        <i class="fa-regular fa-user">
                                            <img src="../img/user/<?php echo $img ?>" alt="">
                                        </i>
                                    </div>
                                </div>
                            </a>
                            <div class="btn2">
                                <input type="file" value="Chọn Ảnh" name="avataruser">
                                <div class="fileimg">
                                    <span>Dung lượng file tối đa 1MB</span>
                                    <span>Định đạng:.JPG,.PNG</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

<?php include('./footer.php');
