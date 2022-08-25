<?php
function displayImages($dir)
{
	// display folders 
	echo "<h1 class='display-5'>$dir</h1>";

	if (is_dir($dir)) {
		$dir_array = scandir($dir);
		echo '<div class="img-container mb-5 shadow">';
		foreach ($dir_array as $file) {
			// don't display the . and .. directories. Using the strpos() for this.
			if (strpos($file, '.') > 0) {
				// display image and delete button
				echo '<div class="inline-img-block">';
				echo "<div class='mt-5 mb-3'><img class='shadow img-thumbnail' width='300' src='" . $dir . "/{$file}'></div>
				<div><a class='shadow btn btn-primary d-grid gap-2 col-3 mx-auto mb-5' href='?file=$dir" . "/" . "$file'>Delete</a></div>";
				echo '</div>';
			}
		}
		echo '</div>';
	}
}

function processSubmittedFile()
{
	// Define these errors in an array
	$upload_errors = array(
		UPLOAD_ERR_OK 				=> "No errors.",
		UPLOAD_ERR_INI_SIZE  		=> "Larger than upload_max_filesize.",
		UPLOAD_ERR_FORM_SIZE 		=> "Larger than form MAX_FILE_SIZE.",
		UPLOAD_ERR_PARTIAL 			=> "Partial upload.",
		UPLOAD_ERR_NO_FILE 			=> "No file.",
		UPLOAD_ERR_NO_TMP_DIR 		=> "No temporary directory.",
		UPLOAD_ERR_CANT_WRITE 		=> "Can't write to disk.",
		UPLOAD_ERR_EXTENSION 		=> "File upload stopped by extension."
	);
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		// what file do we need to move?
		$tmp_file = $_FILES['file_upload']['tmp_name'];
		// set target file name
		// basename gets just the file name
		$target_file = basename($_FILES['file_upload']['name']);
		// set upload folder name
		// $upload_dir = 'uploads';
		$upload_dir = $_POST["folder"];
		// Now lets move the file
		// move_uploaded_file returns false if something went wrong
		if (move_uploaded_file($tmp_file, $upload_dir . "/" . $target_file)) {
			$message = "<div class='row'><div class='col-4'></div><div class='fs-5 text-center alert alert-success col-4'>File uploaded successfully</div><div class='col-4'></div></div>";
		} else {
			$error = $_FILES['file_upload']['error'];
			$message = "<div class='row'><div class='col-4'></div><div class='fs-5 text-center alert alert-danger col-4'>" . $upload_errors[$error] . "</div><div class='col-4'></div></div>";
		}
		return $message;
	}
}

function displayErrorMessage($message)
{
	if (!empty($message)) {
		echo "<p>{$message}</p>";
	}
}

function deleteImage()
{
	if (isset($_GET['file'])) {
		@unlink($_GET['file']);
	}
}
