<?php 
if (isset($_POST['SubmitButton'])){
    $successLink=" ";
    $errorMessage=" ";
    $folderName=$_POST["folderName"];
    $fileContents=$_POST["fileContent"];
    if (is_dir($folderName)){
        $errorMessage="A directory already exists with that name.";
    } 
    mkdir("C:/xampp/htdocs/Assignment5/classes/directories/$folderName", true);
    if (!mkdir("C:/xampp/htdocs/Assignment5/classes/directories/$folderName")){
        $errorMessage="The directory could not be created.";
    }
    touch("C:/xampp/htdocs/Assignment5/classes/directories/$folderName/readme.txt", true);
    if (!file_exists("readme.txt")){
        $errorMessage="The file could not be created.";
    }
    $handle=fopen("readme.txt", "w");
    fwrite($handle, $fileContents);
    if(file_exists("readme.txt")){
        $successLink="<a href="."C:/xampp/htdocs/Assignment5/classes/directories/$folderName/readme.txt"." target="."_blank".">Path where the file is located</a>";
    }
}
?>