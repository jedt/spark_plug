<?php
class UserGroupPermission extends SparkPlugAppModel
{
	var $name = 'UserGroupPermission';
    var $belongsTo = array('SparkPlug.UserGroup');
    
    //TODO: terminar estas 2 y upload !
    // aftersave - crear entrada de cache para reglas del grupo
    // afterdelete borrar entrada de cache para el grupo
}
?>
