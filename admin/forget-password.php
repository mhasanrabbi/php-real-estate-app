<?php

require_once 'layouts/top.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['form_forget_password'])) {
    try {
        if($_POST['email'] == '') {
            throw new Exception("Email can not be empty");
        }
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email is invalid");
        }
        $q = $pdo->prepare("SELECT * FROM users WHERE email=? AND role=? ");
        $q->execute([$_POST['email'], 'admin']);
        $total = $q->rowCount();

        if(!$total) {
            throw new Exception("Email is not found");
        }

        $token = time();

        $email_message = "Please click on the following link in order to reset the password: ";
        $email_message .= '<a href="'.ADMIN_URL.'reset-password.php?email='.$_POST['email'].' & token='.$token.'">Reset Password</a>';



        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = SMTP_ENCRYPTION;
        $mail->Port = SMTP_PORT;
        $mail->setFrom(SMTP_FROM);
        $mail->addAddress($_POST['email']);
        $mail->isHTML(true);
        $mail->Subject = 'Reset Password';
        $mail->Body = $email_message;
        $mail->send();
        $success_message = 'Please check your email and follow the steps.';

        header('location: '.ADMIN_URL.'login.php');
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    } 
}


?>

<section class="section">
    <div class="container container-login">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="card card-primary border-box">
                    <div class="card-header card-header-auth">
                        <h4 class="text-center">Forget Password</h4>
                    </div>
                    <div class="card-body card-body-auth">
                        <?php 
                            if(isset($error_message)) {
                                echo $error_message;
                            }
                        ?>
                        <?php 
                            if(isset($success_message)) {
                                echo $success_message;
                            }
                        ?>
                        <form method="POST" action="">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email Address" value="" autofocus autocomplete="off">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg w_100_p" name="form_forget_password">
                                    Submit
                                </button>
                            </div>
                            <div class="form-group">
                                <div>
                                    <a href="<?php echo ADMIN_URL; ?>login.php">
                                        Back to login
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'layouts/footer.php' ?>