<?php

    include 'includes/header.php';
    include 'includes/scripts.php';
    require 'be/database/db_pdo.php';

    session_start();

    if(isset($_SESSION['token'])){

        $token = $_SESSION['token'];

        $sql = $conn->prepare("SELECT * from `tbl_account_staff` where `session_token` = '$token'");
        $sql->execute();
        $fetchAccount = $sql->fetch();

        if($fetchAccount['staff_role'] == 1){

            echo '
                <script>
                    window.location.replace("../admission-officer/home.php");
                </script>
            ';

        }else if($fetchAccount['staff_role'] == 2){

            echo '
                <script>
                    window.location.replace("../exam-officer/home.php");
                </script>
            ';

        }else if($fetchAccount['staff_role'] == 3){

            echo '
                <script>
                    window.location.replace("../unit-officer/home.php");
                </script>
            ';
            
        }else if($fetchAccount['staff_role'] == 4){

            echo '
                <script>
                    window.location.replace("../interviewer/home.php");
                </script>
            ';
            
        }

    }else{

        session_destroy();

    }

?>

<!-- Login Page Contents -->

<body>

    <!-- Navbar -->

    <nav class="navbar navbar-expand-sm student-navbar-main">
        <div class="student-navbar-logo-container">
            <img src="../../pages/assets/images/student_navbar_logo_container.png" class="logo-container">
            <a class="navbar-brand" href="../../index.php">
                <img src="../../pages/assets/images/navbar_logo_main.png" class="logo">
            </a>
        </div>
    </nav>

    <!-- Login Form Contents -->

    <div class="container-fluid login">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 login">
                <div class="login-form-container">
                    <form method="POST" action="be/login.php">
                        <div class="login-form-header">
                            <p class="login-form-header-text">Staff Login</p>
                            <p class="login-form-header-subtext">Please login using a valid staff account.</p>
                        </div>
                        <div class="login-form-body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="username" id="username" class="form-control" autocomplete="off" required/>
                                    <label class="form-label">Username</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="password" name="password" id="password" class="form-control" autocomplete="off" required/>
                                    <label class="form-label">Password</label>
                                    <span toggle="#password" class="fa fa-eye form-toggle-password"></span>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <p class="login-form-header-subtext" style="margin-bottom: 5px;">Login as:</p>
                                    <select class="form-control" name="role" id="role" required>
                                        <option value="0">System Administrator - MIS</option>
                                        <option value="1">Admissions Office</option>
                                        <option value="2">Examination Officer</option>
                                        <option value="3">Unit Head</option>
                                        <option value="4">Interviewer</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="login-form-buttons" align="center">
                            <button class="default-button disabled-button" id="login" name="login" type="submit" disabled>Login</button>
                            <hr class="default-divider ml-auto">
                            <p style="text-align: center; font-size: 12px; letter-spacing: 3px; color: #8B8B8B;">LNU SAIS V.1.0.0</p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

    <script>

        document.getElementById("password").addEventListener("keyup", validateFields);

        function validateFields(){

            var username = $('#username').val();
            var password = $('#password').val();

            if(username.length > 1 && password.length > 1){

                $('#login').addClass("primary-button");
                $('#login').removeClass("disabled-button");
                $('#login').attr("disabled", false);

            }else{

                $('#login').addClass("disabled-button");
                $('#login').removeClass("primary-button");
                $('#login').attr("disabled", true);

            }

        }

        //toggles show/hide password

        $('.form-toggle-password').click(function(){

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));

            if(input.attr("type") == "password"){
                input.attr("type", "text");
            }else{
                input.attr("type", "password");
            }

        })

    </script>

</body>

</html>