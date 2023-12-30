<?php

namespace App\Http\Controllers;

class InvoiceController{
    public function invoiceAdd(){
        // var_dump(is_writable(STORAGE_PATH.'/'));
        echo '<form method="post" action="/invoice" enctype="multipart/form-data">
                <input type="file" name="file"/>
                <input type="submit" value="Upload" name="amount"/>
            </form>';
    }

    public function invoiceUpload(){
        $filePath = STORAGE_PATH.'/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $filePath);

        header('Location: /');
    }

    public function invoiceDownload(){
        header('Content-type: application/pdf');
        header('Content-disposition: attachment;filename="myfile.pdf"');
        $filePath = STORAGE_PATH.'/BDRAILWAY_TICKET2023113022595119985481.pdf';
        readfile($filePath);
    }
}