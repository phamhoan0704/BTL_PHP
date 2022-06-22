<?php
    if(isset($_POST['submit']))
    {
        $email_to = 'luyenchunji@gmail.com';
        $email_subject = $_POST['contactName'];
        $email_message= $_POST['contactBody'];
        $headers= 'From: '.$_POST['contactEmail'];
        $success = mail ($email_to,$email_subject,$email_message,$header);

        if( $success == true )
        {
            echo "Đã gửi mail thành công...";
        }
        else
        {
            echo "Không gửi đi được...";
        }
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .contact_container {
            display: flex;
            width: 80%;
            margin: 32px auto;
            font-family: 'Open Sans', sans-serif!important;
            font-size: 14px;
            color: #555555;
            box-sizing: border-box;
        }
        
        .contact_container h3 {
            font-size: 22px;
        }
        
        .contact_container p {
            margin: 20px 0 20px 0;
            line-height: 21px;
        }
        
        .contactFormWrapper {
            margin-right: 60px;
        }
        
        hr {
            margin-top: 20px;
            margin-bottom: 20px;
            border: 0;
            border-top: 1px solid #eee;
        }
        
        .contact-form {
            display: flex;
            flex-direction: column;
        }
        
        .contact-form input {
            padding: 10px 16px;
            font-size: 14px;
            line-height: 17px;
            border-radius: 4px;
            margin: 12px 0;
            border: 1px solid #ccc;
        }
        
        .contact-form textarea {
            padding: 8px 16px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin: 12px 0;
        }
        
        .contact_btn {
            padding: 10px 32px;
            font-size: 16px;
            border-radius: 5px;
            margin-bottom: 35px;
            background-color: #01a14b;
            border: none;
            width: 25%;
            color: white;
        }
        
        .info-address {
            list-style: none;
            padding: 0;
        }
        
        .info-address li {
            margin: 12px 0;
        }
        
        .info-address i {
            border: 1px solid #ccc;
            display: inline-block;
            height: 26px;
            width: 26px;
            line-height: 26px;
            text-align: center;
        }
        
        .info-address span {
            line-height: 26px;
        }
    </style>
</head>

<body>
    <?php include "header.php" ?>
    <div class="contact_container">
        <div class="contactFormWrapper">
            <h3>Viết nhận xét</h3>
            <hr class="line-left" />
            <p>
                Nếu bạn có thắc mắc gì, có thể gửi yêu cầu cho chúng tôi, và chúng tôi sẽ liên lạc lại với bạn sớm nhất có thể.
            </p>
            <form accept-charset='UTF-8' action='' method='post'>
                <div class="contact-form">
                    <input required type="text" class="form-control input-lg" name="contactName" placeholder="Tên của bạn" autocapitalize="words">
                    <input required type="email" name="contactEmail" placeholder="Email của bạn" class="form-control input-lg" autocorrect="off" autocapitalize="off">
                    <textarea required rows="6" name="contactBody" class="form-control" placeholder="Nội dung" id="contactFormMessage"></textarea>
                    <button type="submit" class="contact_btn submit">Gửi liên hệ </button>
                </div>
            </form>
        </div>
        <div class="contactInfo">
            <h3>Chúng tôi ở đây</h3>
            <hr class="line-right" />
            <h3 class="name-company">Innovative Publishing and Media</h3>
            <p> Công ty Cổ phần Xuất bản và Truyền thông IPM </p>
            <ul class="info-address">
                <li>
                    <i class="fa-solid fa-location-dot"></i>
                    <span>110 Nguyễn Ngọc Nại Hà Nội</span>
                </li>
                <li>
                    <i class="fa-solid fa-envelope"></i>
                    <span>online.ipmvn@gmail.com</span>
                </li>

                <li>
                    <i class="fa-solid fa-square-phone"></i> <span>03 3319 3979</span>
                </li>

            </ul>

        </div>
    </div>
    <?php include "footer.php" ?>

</body>

</html>