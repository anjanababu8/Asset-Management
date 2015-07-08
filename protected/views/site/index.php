<html>
    <style>
    .blink {
    animation-duration: 1s;
    animation-name: blink;
    animation-iteration-count: infinite;
    animation-direction: alternate;
    animation-timing-function: ease-in-out;
}
@keyframes blink {
    from {
        opacity: 1;
    }
    to {
        opacity: .5;
    }
}
    </style>
</html>
<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<br/>
<br/>
<br/>
<h1 class="blink well span8">Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<br/>


