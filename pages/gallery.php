<h2>Gallery</h2>
<form action='index.php?page=3' method='post'>
    <p>Select graphics extension to display:</p>
    <select name='ext'>
        <?php
        // path to directory with images
        $path = 'images/';
        //Open directory handle
        if ($dir = opendir($path)) {
            $ar = array();
            //Read entry from directory handle
            while (($file = readdir($dir)) !== false) {
                $fullname = $path . $file;
                //Find the position of the last occurrence of a substring in a string
                $pos = strrpos($fullname, '.');
                //Return part of a string
                $ext = substr($fullname, $pos + 1);
                // Make a string lowercase jpg/JPG
                $ext = strtolower($ext);
                //Checks if a value exists in an array
                if (!in_array($ext, $ar)) {
                    $ar[] = $ext;
                    echo "<option>" . $ext . "</option>";
                }
            }
            //Close directory handle
            closedir($dir);
        } else {
            echo "error path";
        }
        ?>
    </select>
    <input type="submit" name="submit" value="Show Pictures" class="btn btn-primary" />

</form>
<br />
<?php
if (isset($_POST['submit'])) {
    $ext = $_POST['ext'];
    // Find pathnames matching a pattern
    $ar = glob($path . "*." . $ext);
    echo "<div class='panel panelprimary'>";
    echo '<div class="panel-heading">';
    echo '<h3 class="panel-title">Gallery
content</h3></div>';
    // create gallery links on images
    foreach ($ar as $a) {
        echo "<a href='" . $a . "'target='_blank'><img src='" . $a . "'height='100px' border='0'alt='picture'class='img-polaroid'/></a>";
    }
    echo "</div>";
}
?>