<?php
header('Content-Type: ' . $model->imageFileType);
print $model->image; 
exit(); 
?>