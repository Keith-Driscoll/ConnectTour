<?php 
	//returns profile picture path string given user id
	
	function itexists($url){
  		$headers = get_headers($url);
   		return stripos($headers[0],"200 OK")?true:false;
	}
	
	function getImage($strId,$path){
		$root = "http://".$_SERVER["SERVER_NAME"];
		$profile_pica = $root."/uploads/".$path."/".$strId.'.png';
		$profile_picb = $root."/uploads/".$path."/".$strId.'.jpg';
		$profile_picc = $root."/uploads/".$path."/".$strId.'.gif';
		$profile_picd = $root."/uploads/".$path."/".$strId.'.jpeg';
				
		if(itexists ($profile_pica)){
			$theProfilePic = $profile_pica;
		}
		else if(itexists($profile_picb)){				
			$theProfilePic = $profile_picb;
		}
		else if(itexists ($profile_picc)){
			$theProfilePic = $profile_picc;
		}
		else if(itexists($profile_picd)){
			$theProfilePic = $profile_picd;
		}
		else {
			$theProfilePic = "images/logo_vector.png";
		}

		return $theProfilePic;
	}
?>