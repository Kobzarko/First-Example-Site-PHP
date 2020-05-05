<?php
if (!isset($_POST['logbtn'])) {
?>
    <div class="container">

        <form class="form-inline">
            <div class="form-group">
                <label for="login">Login:</label>
                <input type="text" class="form-control" name="login" placeholder="Enter login">
            </div>
            <div class="form-group">
                <label for="pass">Password:</label>
                <input type="password" class="form-control" name="pass" placeholder="Enter password">
            </div>

            <button type="submit" class="btn btn-primary" name="logbtn">Login</button>
        </form>
    </div>
<?php
} else {
    if (login($email, $pass)) {
        echo " You was authorized";
        echo ' <script>window.location = "index.php?page=1";</script>';
    }
}
?>