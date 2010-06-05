<?php
class SparkPlugAppModel extends AppModel
{   
    function alphaNumericDashUnderscore($check)
	{
      // $data array is passed using the form field name as the key
      // have to extract the value to make the function generic
      $value = array_values($check);
      $value = $value[0];

      return preg_match('|^[0-9a-zA-Z_-]*$|', $value);
    }

	function verifies($data, $field)
	{
		$value = Set::extract($data, "{s}");
		return ($value[0] == $this->data[$this->name][$field]);
	}
	
	//Validation message i18n
	function invalidate($field, $value = true){
		parent::invalidate($field, $value);
		App::import('Helper', 'SparkPlug.Trans');
		$trans = new TransHelper();
		$this->validationErrors[$field] = $trans->__($value);
	}

}
?>