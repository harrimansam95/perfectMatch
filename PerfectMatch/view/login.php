
<?php include"header4.php"; ?>

<div id="login_wrapper">
    <p id="logintxt">Login below or click sign up to register.</p>
    <p style="color: red; text-align: center; padding: 1%;">
        <?php
        if (!empty($_SESSION['ERROR_LOGIN'])) {
            echo $_SESSION['ERROR_LOGIN'];
        } else {
            echo " ";
        }
        ?>
    </p>
    <form action="../members/login_auth.php" method="post">
        <label>Username: </label><input type="text" class="logincl" name="login_username"/>
        <label>Password: </label><input type="password" class="logincl" name="login_password"/>
        <input type="submit" name="Login" value="Login" id="loginbtn" />
    </form>
    <a href="../members/signup.php"><input type="button" value="Sign Up" id="loginbtn" /></a>
</div>
<?php include "../view/footer.php" ?>
