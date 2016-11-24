<?php
	session_start();
	if($_POST['submit']){
		$target_file = basename($_FILES["fileToUpload"]["name"]);
		echo $target_file . "<br>";
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$fileName = $_GET['file_name'].'.'.$imageFileType;
			// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . "." . "<br>";
				$uploadOk = 1;
			} else {
				echo "File is not an image." . "<br>";
				//
				$uploadOk = 0;
			}
		
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > $_GET['max_size']) {
				$str .= "Sorry, your file is too large." . "<br>";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				echo "-> ".$imageFileType;
				$str .= "Sorry, only JPG, JPEG, PNG and GIF files are allowed." . "<br>";
				$uploadOk = 0;
			}
			
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$str .= "Your file was not uploaded." . "<br>";
				session_start();
				if($_GET['path']=='profile_pictures'){
					header('Location: profile.php?id='. $_SESSION['user_id'] . '&error=' .$str);
				}
				else{
					header('Location: index.php');
				}
				exit();
			// if everything is ok, try to upload file
			} else {
				$file_pattern = "uploads/".$_GET['path']."/".$_GET['file_name'].".*";
				array_map( "unlink", glob($file_pattern));
				
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "uploads/".$_GET['path']."/".$fileName)) {
					$filePath = "uploads/".$_GET['path']."/".$fileName;			
					if($_GET['path']=='profile_pictures'&&$imageFileType!="gif"){					
						// *** Include the class
						include("resize_class.php");
						// *** 1) Initialise / load image
						$resizeObj = new resize($filePath);
						// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
						$resizeObj -> resizeImage(150, 150,"exact");
						// *** 3) Save image
						$resizeObj -> saveImage($filePath, 100);						
					}
						session_start();
						header('Location: '.$_GET['ret']);
						exit();
					
				} else {
					echo "Sorry, there was an error uploading your file." . "<br>";
				}
			}
		}
	}	
?>