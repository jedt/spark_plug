<?php
class SparkPlugAppController extends AppController
{
    var $components = array(
        'SparkPlug.Authsome' => array(
            'model' => 'User'
        )
    );

}
?>