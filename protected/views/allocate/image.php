<?php
header('Content-Type: ' . $model->barcodeFileType);
print $model->barcode; 
exit(); 
?>