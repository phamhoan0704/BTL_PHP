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

<div class="infor_container">
    <div class="infor_left_menu">
        <?php include './menuleft.php' ?>
    </div>
    <div class="infor_box_infor">
        <div class="infor_box_inforx">
            <div class="infor_top-box">
                <h1>Hồ sơ của tôi<h1>
                        <div class="infor_borderbox">
                            Quản lí thông tin hồ sơ bảo mật tài khoản
                        </div>
            </div>
            <div class="infor_mainbox">
                <div class="infor_leftboxinfor">
                    <form action="" method="post">
                        <div class="infor_box">
                            <div class="infor_inp">
                                <div class="infor_label">
                                    <label for="">Tên đăng nhập</label>
                                </div>
                                <div class="infor_inpuif">
                                    <div class="infor_input">
                                        <input type="text" name="username" value="<?php echo "$name"; ?>" readonly>

                                    </div>

                                    <div class="infor_btn">
                                        <button></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="infor_box">
                            <div class="infor_inp">
                                <div class="infor_label">
                                    <label for="">Họ và tên</label>
                                </div>
                                <div class="infor_inpuif">
                                    <div class="infor_input">
                                        <input type="text" name="fullname" placeholder="<?php echo "$fullname"; ?>">
                                        <span>
                                            <?php echo $fullnameErr; ?>
                                        </span>

                                    </div>
                                    <div class="infor_btn">
                                        <button>Sửa</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="infor_box">
                            <div class="infor_inp">
                                <div class="infor_label">
                                    <label for="">Số điện thoại</label>
                                </div>
                                <div class="infor_inpuif">
                                    <div class="infor_input">
                                        <input type="text" name="phone" placeholder="<?php echo "$phone" ?>">
                                        <span>
                                            <?php echo $phoneErr; ?>
                                        </span>
                                    </div>

                                    <div class="infor_btn">
                                        <button>Sửa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="infor_box">
                            <div class="infor_inp">
                                <div class="infor_label">
                                    <label for="">Email</label>
                                </div>
                                <div class="infor_inpuif">
                                    <div class="infor_input">
                                        <input type="text" name="email" placeholder="<?php echo "$email"; ?>">
                                        <span>
                                            <?php echo $emailErr; ?></span>
                                    </div>

                                    <div class="infor_btn">
                                        <button>Sửa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="infor_box">
                            <div class="infor_inp boxbtn">
                                <div class="infor_label"><label for=""></label></div>
                                <div class="infor_btnsave">
                                    <button name="btnsubmit">Lưu</button>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="infor_imgbox2">
                    <div class="infor_avatarbox">
                        <a href="" class="infor_avatar">
                            <div class="infor_frame-avatar2">
                                <div class="infor_avatar-img2">
                                    <i class="infor_fa fa-regular fa-user">
                                        <img src="../img/user/<?php echo $img ?>" alt="">
                                    </i>
                                </div>
                            </div>
                        </a>
                        <div class="infor_btn2">
                            <input type="file" value="Chọn Ảnh" name="avataruser">
                            <div class="infor_fileimg">
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
