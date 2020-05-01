<h3>Registration Form</h3>
<?php
// if button wasn't pressed = show form
if (!isset($_POST['regbtn'])) {
?>
    <form action="index.php?page=4" method="POST">
        <div class="form-group">
            <label for="login">Login:</label>
            <input type="text" name="login" class="form-control">
        </div>
        <div class="form-group">
            <label for="pass1">Password:</label>
            <input type="password" name="pass1" class="form-control">
        </div>
        <div class="form-group">
            <label for="pass2">Confirm Password:</label>
            <input type="password" name="pass2" class="form-control">
        </div>
        <div class="form-group">
            <label for="login">Email address:</label>
            <input type="text" name="email" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary" name="regbtn">Register</button>
    </form>
<?php
} else {
    if (register($_POST['login'], $_POST['pass1'], $_POST['pass2'], $_POST['email'])) {
        echo " <h3><span style = 'color:green;'>
        New User Added! </span> </h3>";
    }
}
?>