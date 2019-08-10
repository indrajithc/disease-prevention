<?php

/**
 * @Author: indran
 * @Date:   2018-09-01 00:55:58
 * @Last Modified by:   indran
 * @Last Modified time: 2018-09-10 08:50:35
 */
?><?php 
try {
	session_start(); 
} catch (Exception $e) {
	
}
try { 
	session_destroy();
} catch (Exception $e) {
	
}

?>
<script type="text/javascript">
	location.href=".";
</script>