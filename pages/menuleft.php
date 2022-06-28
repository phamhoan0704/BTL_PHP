<?php include('../database/connect.php');

$img="";
if(!isset($_SESSION['user']))
echo"<script>window.location.href='./log_in.php'<script>";
else{
    $username=$_SESSION['user'];
    $sql="SELECT * FROM tbl_user WHERE user_name='$username';";
    $reslut=mysqli_fetch_array(mysqli_query($conn,$sql));
    $img=$reslut['user_image'];

}
?>
<!DOCTYPE html>

<body>
<div class="left_menu">
            <div class="profile">
                <div class="imgbox">
                    <a href="..img/prod/" class="avatar">
                        <div class="frame-avatar">
                           
                            <div class="avatar-img">
                           <img src="../img/product/<?php echo $img?>" alt="">
                                <i class="fa fa-regular fa-user"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div classs="namebox">
                    <div class="nameuser">
                        <!-- <?php echo $user?> -->
                    </div>
                    <div class="altterInfor">
                        <a href="profile.php" class="altter">
                            <i class="fa fa-solid fa-pen"></i> Sửa hồ sơ
                        </a>
                    </div>
                </div>
            </div>
            <div class="list_e">
                <div class="stardust-dropdown stardust-dropdown-open">
                    <div class="stardust-dropdown-header">
                        <a href="">
                            <div class="imgPurchase">
                                <img src="../img/user.png" alt="">
                            </div>
                            <div>
                                <span>Tài khoản của tôi</span>
                            </div>
                        </a>
                    </div>
                    <div class="stardust-dropdown-itembody stardust-dropdown-itembody-open">
                        <div class="frame_box">
                            <a href="information.php">Hồ sơ</a>
                            <a href="">Ngân Hàng</a>
                            <a href="">Địa chỉ</a>
                            <a href="./newpass.php">Đổi mật khẩu</a>

                        </div>
                    </div>

                </div>
                <div class="stardust-dropdown">
                    <div class="stardust-dropdown-header">
                        <a href="./user_order_list.php">
                            <div class="imgPurchase">
                                <img src="../img/purchase.png" alt="">
                            </div>
                            <div>
                                <span>Đơn mua</span>
                            </div>
                        </a>
                    </div>
                    <div class="stardust-dropdown-itembody">

                    </div>
                </div>


            </div>
            <div class="stadust-dropdown">
                <div class="stardust-dropdown-header">
                    <a href="">Thông báo</a>
                </div>
                <div class="stardust-dropdown-itembody">

                </div>
            </div>
            <div class="stadust-dropdown">
                <div class="stardust-dropdown-header">
                    <a href="">Kho voucher</a>
                </div>
                <div class="stardust-dropdown-itembody">

                </div>
            </div>

        </div>
</body>
</html>