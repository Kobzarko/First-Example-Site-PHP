<h3>Upload Form</h3>

<?php
if (isset($_SESSION['registered_user']))
    if (!isset($_POST['uppbtn'])) {
?>
    <form action="index.php?page=2" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="myfile">Select file for upload: </label>
            <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
            <!-- accept="image/* choose only image files -->
            <input type="file" class="form-control" name="myfile" accept="SitePHP/images/*">
        </div>
        <button type="submit" class="btn btn-primary" name="uppbtn">Send File</button>
    </form>

<?php
    } else {
        if (isset($_POST['uppbtn'])) {
            //error handling

            switch ($_FILES['myfile']['error']) {
                case 0:
                    echo " <h3><span style = 'color:green;'>
                Upload successfuly! <br/> " . $_FILES['myfile']['error'] . " errors.</span> </h3>";
                    break;
                case 1:
                    echo " <h3><span style = 'color:red;'>
                Upload error code:  " . $_FILES['myfile']['error'] . "</span><br>
                Uploaded file size larger than the limit set
                Upload_max_filesize parameter in php.ini </h3> 
                ";
                    exit();
                    break;
                case 2:
                    echo " <h3><span style = 'color:red;'>
                Upload error code:  " . $_FILES['myfile']['error'] . "</span><br>
                Uploaded file size larger than the limit set.Parameter MAX_FILE_SIZE in the form </h3> ";

                    echo "server size " . ini_get("post_max_size");
                    echo  " file size " . ini_get("MAX_FILE_SIZE");
                    return false; // exit();
                    break;
                case 3:
                    echo " <h3><span style = 'color:red;'>
                    Upload error code:  " . $_FILES['myfile']['error'] . "</span>
                    <br> The file is not fully loaded </h3>";
                    exit();
                    break;
                case 4:
                    echo " <h3><span style = 'color:red;'>
                    Upload error code:  " . $_FILES['myfile']['error'] . "</span><br>
                    File was not loaded, invalid file path specified </h3>";
                    exit();
                    break;
            }
            //example from metanit
            // if ($_FILES && $_FILES['myfile']['error'] == UPLOAD_ERR_OK) {
            //     $name = $_FILES['myfile']['name'];
            //     move_uploaded_file($_FILES['myfile']['tmp_name'], $name);
            //     echo "Файл загружен";
            // }
            //does the file exist on server in temp folder?
            if (is_uploaded_file($_FILES['myfile']['tmp_name'])) {
                //remove the file from temp folder into images
                //folder with origin name 

                //echo 'post_max_size = ' . ini_get('post_max_size') . "\n";
                move_uploaded_file($_FILES['myfile']['tmp_name'], "./images/" . $_FILES['myfile']['name']);
            }
            // echo " <h3><span style = 'color:green;'>
            // Upload successfuly! </span> </h3>";
        }
    }
?>