<?php
    include 'includes/header.php';
    session_start();
?>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">LNU | <b>SAIS</b></a>
            <small>Student Admission and Information SYSTEM</small>
        </div>
        <div class="card">
            <div class="body">
                <form action="be/login.php" id="sign_in" method="POST">
                    <div class="msg">
                        <h3>Sign in to start your session</h3>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">

                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-blue waves-effect" name="login" type="submit">SIGN IN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'includes/scripts.php';?>
</body>

</html>