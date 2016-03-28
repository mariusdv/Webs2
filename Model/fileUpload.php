<?php

/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 25-3-2016
 * Time: 15:41
 */
class fileUpload
{

    public function upload($file, $name)
    {

        $path_parts = pathinfo($file["name"]);
        $imageFileType = $path_parts['extension'];

        $target_dir = "Resources/Images/";
        $target_file = $target_dir . $name . "." . $imageFileType;

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($file["tmp_name"]);
            if ($check === false) {

                apologize("File is not an image");
                exit();
            }
        }


        // Check file size
        if ($file["size"] > 500000) {
            apologize("your file is too large.");
            exit();
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        ) {
            apologize("only JPG, JPEG, PNG files are allowed. You send in a file with extension: $imageFileType");
            exit();
        }
        if (move_uploaded_file($file["tmp_name"], $target_file)) {

            return "/" . $target_file;
        } else {
            apologize("Something went wrong while uploading to $target_file");
            exit();
        }
    }

}
