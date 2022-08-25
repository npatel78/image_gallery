<?php require "inc/functions.inc.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Image Gallery</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<?php require "inc/navbar.inc.php" ?>
	<div class="container cntr-bg-color">
		<div class="row mt-5 shadow">
			<div class="col text-center">
				<h1 class="text-center text-start text-dark display-1">Nayan's Image Gallery</h1>
				<p class="text-center lead mt-5 text-start">Populate this gallery with your favorite pet photos, vacation photos, or any photo!</p>
			</div>
		</div>
		<?php
		// check to see if file was uploaded
		$message = processSubmittedFile();
		// if file upload had an error display the message
		displayErrorMessage($message);
		// Delete the file if the URL contains ?file=
		deleteImage();
		require "inc/form.inc.html";
		?>
		<?php displayImages('Pets') ?>
		<?php displayImages('Vacation') ?>
		<?php displayImages('Misc') ?>

		<script src="js/bootstrap.min.js"></script>
</body>

</html>