<!DOCTYPE html>
	<html>
		<body>

			<form action="image_upload.php?path=match_screenshots&file_name=screenTest&max_size=100000000&ret=index.php" method="post" enctype="multipart/form-data">
				Select image to upload:
				<input type="file" name="fileToUpload" id="fileToUpload">
				<input type="submit" value="Upload Image" name="submit">
			</form>

		</body>
	</html>