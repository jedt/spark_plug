<?php
class SparkPlugAppController extends AppController
{
    var $components = array(
        'SparkPlug.Authsome' => array(
            'model' => 'User'
        )
    );
    
    var $helpers = array('SparkPlug.Trans');
}
?>