	<?php echo $this->element("box/start", array("title"=>"Control Panel")) ?>
			<?php 
			if ($session->read("user_id"))
			{
				echo $this->element("user_control_panel");
			} else {
			?>
			<div id="login_pane" class="box" align="left">
				<h3 class="titlebar_a"> &raquo; Please Sign in:</h3>		
				<?php 
					echo $form->create("User",array("action"=>"login"));
					echo "<div style='padding:12px'>";
					echo "<table>";
					echo "<tr>";
					echo "<td> {$form->label("username","Username")} </td>";
					echo "<td> {$form->text("username")} </td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td> {$form->label("password","Password")} </td>";
					echo "<td> {$form->password("password")} </td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td colspan=2> {$form->Submit("Log in")} </td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td> {$html->link("Register","/users/register")} </td>";
					echo "<td> {$html->link("Forgot Password","/users/forgotPassword")} </td>";
					echo "</tr>";
					echo "</table>";
					echo "</div>";
					echo $form->end();
				?>
			</div>							
			<?php 
			}
			?>

	<?php echo $this->element("box/end") ?>
	<!-- end: #col1 -->