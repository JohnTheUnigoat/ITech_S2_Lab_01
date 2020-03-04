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
		$actor = $_GET['actor'];

		$dbh = new PDO('mysql:host=localhost;dbname=film_library', 'root', '');

		$cmd = <<<EOD
		SELECT
			f.name,
			f.date,
			f.country,
			f.director
		FROM
			film AS f JOIN film_actor AS fa ON fa.FID_Film = f.ID_FILM
			JOIN actor AS a ON a.ID_Actor = fa.FID_Actor
		WHERE
			a.name = :actor
		EOD;

		$stmt = $dbh->prepare($cmd);
		$stmt->execute([':actor' => $actor]);

		echo "<h2>Movies starring $actor</h2>";

		include 'movies_table_print.php';
		?>
	</main>
</body>
</html>
