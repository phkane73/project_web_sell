<?php
include './db_connection.php';

if (isset($_POST['submit'])) {

    $query = 'SELECT sdt FROM user WHERE sdt = :sdt';
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':sdt', $_POST['sdt']);
    $stmt->execute();
    $user = $stmt->fetchColumn();
    if ($user == false) {
        $password = md5($_POST['password']);
        $query = 'Insert into user(tenKh,sdt,password,diaChi) values (?,?,?,?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            $_POST['name'], $_POST['sdt'], $password, $_POST['diaChi']
        ]);
        echo '<div class="row">
        <div class="alert alert-success alert-dismissible position-absolute col-md-2 offset-md-5 alert-autocloseable-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong><br> Đăng ký thành công</div>
        </div>';
    } else {
        echo '<div class="row">
        <div class="alert alert-danger alert-dismissible position-absolute col-md-2 offset-md-5">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong> Đăng ký thất bại. Số điện thoại đã tồn tại</div>
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
    <title>Đăng ký tài khoản</title>
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
                        <h3>Đăng ký tài khoản</h3>
                    </div>
                    <div class="card-body">
                        <form action="register.php" id="register_form" method="post">
                            <div class="form-group">
                                <label for="name">Tên của bạn:</label>
                                <input type="text" class="form-control" placeholder="Nhập tên của bạn" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="sdt">Số điện thoại:</label>
                                <input type="text" class="form-control" placeholder="Nhập số điện thoại" id="sdt" name="sdt" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu:</label>
                                <input type="password" class="form-control" placeholder="Nhập mật khẩu" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="re_password">Nhập lại mật khẩu:</label>
                                <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" id="re_password" name="re_password" required>
                            </div>
                            <div class="form-group">
                                <label for="diaChi">Địa chỉ</label>
                                <input type="text" class="form-control" placeholder="Nhập địa chỉ" id="diaChi" name="diaChi" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary" value="Signup">Đăng ký</button>
                            <a href="login.php" class="btn btn-primary float-right">Đăng nhập</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="./lib/jquery.validate.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#register_form").validate({
                    rules: {
                        name: "required",
                        sdt: {
                            required: true,
                            minlength: 10
                        },
                        password: {
                            required: true,
                            minlength: 5,
                            maxlength: 50
                        },
                        re_password: {
                            required: true,
                            minlength: 5,
                            maxlength: 50,
                            equalTo: "#password"
                        },
                        diaChi: {
                            required: true,
                            maxlength: 100
                        }
                    },
                    messages: {
                        name: "Vui lòng nhập tên!",
                        sdt: {
                            required: "Vui lòng nhập số điện thoại!",
                            minlength: "Số điện thoại phải từ 10 số"
                        },
                        password: {
                            required: "Vui lòng nhập mật khẩu!",
                            minlength: "Mật khẩu phải nhiều hơn 5 ký tự",
                            maxlength: "Mật khẩu không được nhiều hơn 50 ký tự"
                        },
                        re_password: {
                            required: "Vui lòng nhập lại mật khẩu!",
                            minlength: "Mật khẩu phải nhiều hơn 5 ký tự",
                            maxlength: "Mật khẩu không được nhiều hơn 50 ký tự",
                            equalTo: "Nhập lại mật khẩu không chính xác"
                        },
                        diaChi: {
                            required: "Vui lòng nhập địa chỉ của bạn!",
                            maxlength: "Địa chỉ không được quá 100 ký tự"
                        }
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