<?php


$enc_pass=crypt($password, 'salt');

 $connection = Yii::app()->db;
 $sql = "select * from users where name='$username' and password='$enc_pass'";
 $command = $connection->createCommand($sql);
 $dataReader = $command->query();
 $row = $dataReader->read();
if($row!="")
{
    echo "1";
}
else
{
    echo "0";
}
?>
