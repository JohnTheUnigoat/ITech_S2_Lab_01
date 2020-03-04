<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://fonts.googleapis.com/css?family=Spartan&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	<title>Document</title>
</head>
<body>
	<main>
		<?php
		$genre = $_GET['genre'];
		echo "<h2>Movies of genre \"$genre\"</h2>";

		$dbh = new PDO('mysql:host=localhost;dbname=film_library', 'root', '');

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

		$stmt = $dbh->prepare($cmd);
		$stmt->execute([':genre' => $genre]);

		include 'movies_table_print.php';
		?>
	</main>
</body>
</html>
