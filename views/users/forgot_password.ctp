<?php
$javascript->link('wufoo.js', false);
//$html->css('/css-basic/wufoo/structure', null, null, false);
$html->css('/css-basic/wufoo/form', null, null, false);
$html->css('/css-basic/wufoo/theme', null, null, false);

$html->css('framework.css', null, null, false);

?>
<h2>Password recovery</h2>
<p>Please enter the e-mail used during registration.</p>
<?php echo $form->create("User",array("action"=>"forgotPassword")) ?>
	<ul>
		<li><?php echo $form->text("email",array("size"=>"40")) ?></li>
		<li><?php echo $form->submit("Submit",array("class"=>"buttons")) ?></li>
	</ul>
<?php echo $form->end() ?>