<!DOCTYPE html>
<html>
    <head>
        <title>Login - Warung ABC</title>
    </head>
    <body>
        <h1>Login Aplikasi Kasir Warung ABC</h1>
    </body>
    <?php
    session_start();
    if (isset($_SESSION['pesan_error'])) {
        echo '<p>' . $_SESSION['pesan_error'] . '</p>';
        unset($_SESSION['pesan_error']);
    }
    ?>

    <form action="proses_login.php" method="POST">
        <table>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type="text" name="username" require></td>
            </tr>
            <tr>
                <td>password</td>
                <td>:</td>
                <td><input type="password" name="password" require></td>
                <td colspan= "3">
                    <input type="submit" value="Login">
                </td>
            </tr>
        </table>
    </form>
</html>