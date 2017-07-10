<?php

    require_once 'CipherFunctions.php';
    $cf = new CipherFunctions();
    $uploadOk = 1;
    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/cipher-challenge/backend/uploads/';
    $target_file = $uploaddir . basename($_FILES['encryptedFile']['name']);
    $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $cipherType = $_POST['cipherType'];

    $cipherKey = $_POST['cipherKey'];
    
    if ($_FILES["encryptedFile"]["size"] > 500000) {
        echo "Sorry, your file is too large.\n";
        $uploadOk = 0;
    }
    
    if($fileType != "txt") {
        echo "Sorry, only text files are allowed.\n";
        $uploadOk = 0;
    }

    if($uploadOk == 1) {
        if (move_uploaded_file($_FILES['encryptedFile']['tmp_name'], $target_file)) {
            // echo "File was successfully uploaded.\n";
            $output = "";
            if(strcmp($cipherType, "decrypt") === 0){
                $output = $cf->decrypt($target_file, $cipherKey);
            } else {
                $output = $cf->encrypt($target_file, $cipherKey);
            }
            echo $output;
        } else {
            echo "Error uploading file!\n";
        }
    }

?>