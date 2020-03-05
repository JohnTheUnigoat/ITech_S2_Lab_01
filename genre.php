<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://fonts.googleapis.com/css?family=Spartan&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	<?php
	$genre = $_GET['genre'];
	echo "<title>Movies of \"$genre\" genre</title>";
	?>
</head>
<body>
	<main>
		<?php
		include 'db_connection.php';

		$cmd = <<<EOD
		SELECT
			f.name,
			f.date,
			f.country,
			f.director
		FROM
			film AS f JOIN film_genre AS fg ON fg.FID_Film = f.ID_FILM
			JOIN genre AS g ON g.ID_Genre = fg.FID_Genre
		WHERE
			g.title = :genre;
		EOD;

		$stmt = $conn->prepare($cmd);
		$stmt->execute([':genre' => $genre]);

		echo "<h2>Movies of \"$genre\" genre</h2>";

		include 'movies_table_print.php';
		?>
	</main>
</body>
</html>
