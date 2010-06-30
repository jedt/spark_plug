<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout; ?></title>
	<?php
	echo $this->Html->meta('icon');
	
	//echo $this->Html->css('cake.generic');
	echo $html->script('/spark_plug/js/wufoo.js');
	echo $html->css('/spark_plug/css/wufoo/structure');
	echo $html->css('/spark_plug/css/wufoo/form');
	echo $html->css('/spark_plug/css/wufoo/theme');
	echo $scripts_for_layout;
	?>
</head>
<body>
<div id="container">
<div id="header">
<h1><?php echo $title_for_layout; ?></h1>
</div>
<div id="content">
<?php if ($this->Session->check('Message.flash')) {
	echo '<h3 style="color: red;">' . $this->Session->flash() . '</h3>'; 
}?>
<?php echo $content_for_layout; ?>

</div>
<div id="footer"><?php echo $this->Html->link(
$this->Html->image('cake.power.gif', array('alt'=> __('CakePHP: the rapid development php framework', true), 'border' => '0')),
					'http://www.cakephp.org/',
array('target' => '_blank', 'escape' => false)
);
?></div>
</div>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>