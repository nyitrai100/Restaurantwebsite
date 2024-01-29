<?php
$pdfFilePath = './RestaurantMenu.pdf';


if (file_exists($pdfFilePath)) {
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($pdfFilePath) . '"');
    header('Content-Length: ' . filesize($pdfFilePath));


    readfile($pdfFilePath);
    exit;
} else {
    echo 'File not found.';
}

