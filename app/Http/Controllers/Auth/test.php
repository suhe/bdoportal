<?php
	$response = [
				"error" => true,
				"error_msg" => "Required parameters (name, email or password) is missing!"
			];
	echo json_encode($response);
?>