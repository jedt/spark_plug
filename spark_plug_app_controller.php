<?php
class SparkPlugAppController extends AppController
{
    var $components = array(
        'Session', 'SparkPlug.Authsome' => array(
            'model' => 'User'
        )
    );
    
    var $helpers = array('SparkPlug.Trans');
}
?>