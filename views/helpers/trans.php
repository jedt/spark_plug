<?php
/**
 * Helps the translation inside the plugin
 * @author Steinkel
 *
 */
class TransHelper extends AppHelper {
    function __($key) {
    	return __d('spark_plug', $key, true);
    }
}

?>
