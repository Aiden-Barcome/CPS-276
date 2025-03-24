<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$errorMessage="";
$file="";
$uploadStatus="";
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST["submit"])){
        if(isset($_FILES["fileUpload"])){
            $file=$_FILES["fileUpload"];
        }
    
        if($file["size"]>100000){
            $errorMessage="File is too large.";
        }else{
            $fileType=mime_content_type($file["tmp_name"]);
            if($fileType != "application/pdf"){
                $errorMessage="Incorrect format.";
            }
        }

        if (isset($_FILES["fileUpload"]) && $_FILES["fileUpload"]["error"] === UPLOAD_ERR_OK) {
            $file = $_FILES["fileUpload"];
        } else {
            $errorMessage = "File upload error: " . $_FILES["fileUpload"]["error"];
        }

        $fileExt="pdf";

        if(move_uploaded_file($file["tmp_name"],"/home/a/b/abarcome/public_html/cps276/Assignments/Assignment7/Files/{$_POST['fileName']}.{$fileExt}")){
            $uploadStatus="File was successfully uploaded.";
            $uploadStatus .= "<p><a href=\"Assignment7/Files/{$_POST['fileName']}.{$fileExt}\" target=\"_blank\">View PDF</a></p>";
        }else{
            $uploadStatus="There was a problem.";
        }
    }
}
?>