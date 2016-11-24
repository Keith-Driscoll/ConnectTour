<?php 
	//returns profile picture path string given user id
	
	function UR_exists($url){
  		$headers=get_headers($url);
   		return stripos($headers[0],"200 OK")?true:false;
	}
	
	function getProfilePicture($strId){
		$id = intval($strId);
		$root = "http://".$_SERVER["SERVER_NAME"];
		$profile_pica = $root."/uploads/profile_pictures/".$id.'.png';
		$profile_picb = $root."/uploads/profile_pictures/".$id.'.jpg';
		$profile_picc = $root."/uploads/profile_pictures/".$id.'.gif';
		$profile_picd = $root."/uploads/profile_pictures/".$id.'.jpeg';
				
		if(UR_exists ($profile_pica)){
			$theProfilePic = $profile_pica;
		}
		else if(UR_exists ($profile_picb)){				
			$theProfilePic = $profile_picb;
		}
		else if(UR_exists ($profile_picc)){
			$theProfilePic = $profile_picc;
		}
		else if(UR_exists ($profile_picd)){
			$theProfilePic = $profile_picd;
		}
		else {
			$theProfilePic = "images/logo_vector.png";
		}

		return $theProfilePic;
	}
?>