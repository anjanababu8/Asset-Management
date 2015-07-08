<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pw_md5')); ?>:</b>
	<?php echo CHtml::encode($data->pw_md5); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phones')); ?>:</b>
	<?php echo CHtml::encode($data->phones); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('mobile')); ?>:</b>
	<?php echo CHtml::encode($data->mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fn')); ?>:</b>
	<?php echo CHtml::encode($data->fn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ln')); ?>:</b>
	<?php echo CHtml::encode($data->ln); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_auth')); ?>:</b>
	<?php echo CHtml::encode($data->id_auth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('auth_method')); ?>:</b>
	<?php echo CHtml::encode($data->auth_method); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_login')); ?>:</b>
	<?php echo CHtml::encode($data->last_login); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_mod')); ?>:</b>
	<?php echo CHtml::encode($data->date_mod); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('designation')); ?>:</b>
	<?php echo CHtml::encode($data->designation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('g_id')); ?>:</b>
	<?php echo CHtml::encode($data->g_id); ?>
	<br />
	<br />



</div>