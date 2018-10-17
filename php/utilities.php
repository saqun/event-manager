<?php
	function h($string="") {
		return htmlspecialchars($string);
	}
	
	function empty_str($str) {
		if (isset($str) && strlen($str) > 0) {
			return false;
		} else {
			return true;
		}		
	}


function gen_select_opts($selectValue, $optionArray) {
	$html = '';
	foreach ($optionArray as $key => $option) {
		$html .= '<option value=' . $key 
				 . (($selectValue == $key)? ' selected ':' ') . '>' 
				 . $option . '</option>';
	}
	return $html;
}

function formatted_date($str_date) {
	$date=date_create($str_date);
	return date_format($date,"d/m/Y");
}

?>
	