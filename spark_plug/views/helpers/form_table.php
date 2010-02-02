<?php
class FormTableHelper extends FormHelper
{
    var $helpers = array('Form');

	function input($fieldname,$options=null)
	{
		return $this->_input("Basic",$fieldname,$options);
	}
	function inputCompact($fieldname,$options=null)
	{
		return $this->_input("Compact",$fieldname,$options);
	}
	function submit($label=null,$options=array())
	{
		$output = "<tr><td colspan='2'>";
		$output .= $this->Form->submit($label,$options);
		$output .= "</td></tr>";
		return $output;
	}
	function button($label,$options=array())
	{
		$output = "<tr><td colspan='2'>";
		$output .= $this->Form->button($label,$options);
		$output .= "</td></tr>";
		return $output;
	}
	function htmlRow($html)
	{
		$output = "<tr><td colspan='2'>".$html."</td></tr>";
		return $output;
	}
	function label($html)
	{
		$output = '<tr><td colspan="2">'.$html.'</td></tr>';
		return $output;
	}
	function _input($layout,$fieldname,$options=null)
	{
		$label = null;
		if (!empty($options['label']))
			$label = $options['label'];
			
		$options['label'] = false;
		$output = "";
		if ($layout=="Basic")
		{
			$output .= '<tr>';
			$output .= '<td class="label">';
			$output .= 	$this->Form->label($fieldname,$label);
			$output .= '</td>';
			$output .= '<td>';
			$output .= 	$this->Form->input($fieldname,$options);
			$output .= '</td>';
			$output .= '</tr>';
		}
		else
		{
			$output .= '<tr>';
			$output .= '<td colspan="2">';
			$output .= 	$this->Form->label($fieldname,$label);
			$output .= 	$this->Form->input($fieldname,$options);
			$output .= '</td>';
			$output .= '</tr>';
		}
		return $this->output($output);
	}
}