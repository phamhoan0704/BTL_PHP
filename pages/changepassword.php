
    <div class="changepass_container">
        <div class="changepass_left_menu">
            <?php include 'menuleft.php' ?>
        </div>
        <div class="changepass_box_infor">
            <div class="changepass_box_inforx">
                <div class="changepass_top-box">
                    <h1>Đổi mật khẩu<h1>
                            <div class="changepass_borderbox">
                                Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác
                            </div>
                </div>
                <div class="changepass_mainbox">
                    <div class="changepass_leftboxinfor">
                        <form action="" method="post">
                            <div class="changepass_box">
                                <div class="changepass_inp">
                                    <div class="changepass_label">
                                        <label for="">Mật khẩu hiện tại</label>
                                    </div>
                                    <div class="changepass_inpuif">
                                        <input type="password" name="pass">
                                        <div class="changepass_btn">
                                            <span>
                                                <?php echo $passErr; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="changepass_box">
                                <div class="changepass_inp">
                                    <div class="changepass_label">
                                        <label for="">Mật khẩu mới</label>
                                    </div>
                                    <div class="changepass_inpuif">
                                        <input type="password" name="newpass" value="">
                                        <div class="changepass_btn">
                                            <span>
                                                <?php echo $newPassErr; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="changepass_box">
                                <div class="changepass_inp">
                                    <div class="changepass_label">
                                        <label for="">Xác nhận lại mật khẩu</label>
                                    </div>
                                    <div class="changepass_inpuif">
                                        <input type="password" name="newpassconfirm">

                                        <div class="changepass_btn">
                                            <span>
                                                <?php echo $newPassConfirmErr; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="changepass_box">
                                <div class="changepass_inp boxbtn">
                                    <div class="changepass_label"></div>
                                    <div class="changepass_btnsave">
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
