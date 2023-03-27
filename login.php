<?php
include './db_connection.php';
if (isset($_POST['submit'])) {

    $query = 'SELECT sdt FROM user WHERE sdt = :sdt and password = :password';
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':sdt', $_POST['sdt']);
    $stmt->bindValue(':password', md5($_POST['password']));
    $stmt->execute();
    $user = $stmt->fetchColumn();
    if ($user == true) {
        header('Location:./public/index.php');
    } else {
        echo '<div class="row">
        <div class="alert alert-danger alert-dismissible position-absolute col-md-2 offset-md-5 text-center">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong> Sai số điện thoại hoặc mật khẩu</div>
        </div>';
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <?php
    include './link.php';
    ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card" style="margin-top: 100px;">
                    <div class="card-header text-center">
                        <h3>Đăng nhập</h3>
                    </div>
                    <div class="card-body">
                        <form action="login.php" id="login_form" method="post">
                            <div class="form-group">
                                <label for="sdt">Số điện thoại:</label>
                                <input type="text" class="form-control" placeholder="Nhập số điện thoại" id="sdt" name="sdt" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu:</label>
                                <input type="password" class="form-control" placeholder="Nhập mật khẩu" id="password" name="password" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary" value="Signup">Đăng nhập</button>
                            <a href="register.php" class="btn btn-primary float-right">Đăng ký</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="./lib/jquery.validate.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#login_form").validate({
                    rules: {
                        sdt: {
                            required: true,
                            minlength: 10
                        },
                        password: {
                            required: true,
                            minlength: 5,
                            maxlength: 50
                        },
                    },
                    messages: {

                        sdt: {
                            required: "Vui lòng nhập số điện thoại!",
                            minlength: "Số điện thoại phải từ 10 số"
                        },
                        password: {
                            required: "Vui lòng nhập mật khẩu!",
                            minlength: "Mật khẩu phải nhiều hơn 5 ký tự",
                            maxlength: "Mật khẩu không được nhiều hơn 50 ký tự"
                        },
                    },
                    errorElement: "div",
                    errorPlacement: function(error, element) {
                        error.addClass("invalid-feedback");
                        error.insertAfter(element);

                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass("is-invalid").removeClass("is-valid");
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).addClass("is-valid").removeClass("is-invalid");
                    }
                });
            });
        </script>
</body>

</html>