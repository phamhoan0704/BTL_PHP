<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/changepassword.css">
    <link rel="stylesheet" href="../Font/fontawesome/css/all.min.css">
    
</head>

<body>
    <div class="container">
        <div class="left_menu">
            <?php include 'menuleft.php' ?>
        </div>
        <div class="box_infor">
            <div class="box_inforx">
                <div class="top-box">
                    <h1>Đổi mật khẩu<h1>
                            <div class="borderbox">
                                Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác
                            </div>
                </div>
                <div class="mainbox">
                    <div class="leftboxinfor">
                        <form action="" method="post">
                            <div class="box">
                                <div class="inp">
                                    <div class="label">
                                        <label for="">Mật khẩu hiện tại</label>
                                    </div>
                                    <div class="inpuif">
                                        <input type="password" name="pass">
                                        <div class="btn">
                                            <span>
                                                <?php echo $passErr; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="inp">
                                    <div class="label">
                                        <label for="">Mật khẩu mới</label>
                                    </div>
                                    <div class="inpuif">
                                        <input type="password" name="newpass" value="">
                                        <div class="btn">
                                            <span>
                                                <?php echo $newPassErr; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="inp">
                                    <div class="label">
                                        <label for="">Xác nhận lại mật khẩu</label>
                                    </div>
                                    <div class="inpuif">
                                        <input type="password" name="newpassconfirm">

                                        <div class="btn">
                                            <span>
                                                <?php echo $newPassConfirmErr; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="inp boxbtn">
                                    <div class="label"></div>
                                    <div class="btnsave">
                                        <button name="btnsubmit">Xác nhận</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>