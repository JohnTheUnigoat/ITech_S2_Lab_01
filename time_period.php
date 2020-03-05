<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://fonts.googleapis.com/css?family=Spartan&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	<?php
	$start = $_GET['start'];
	$end = $_GET['end'];

	echo "<title>Movies from $start to $end</title>";
	?>
	<title>Document</title>
</head>
<body>
	<main>
		<?php
		$dbh = new PDO('mysql:host=localhost;dbname=film_library', 'root', '');

		$cmd = <<<EOD
		SELECT
			name,
			date,
			country,
			director
		FROM film
		WHERE date BETWEEN :start AND :end
		ORDER BY date
		EOD;

		$stmt = $dbh->prepare($cmd);
		$stmt->execute([':start' => $start, ':end' => $end]);

		echo "<h2>Movies that came out from $start to $end</h2>";

		include 'movies_table_print.php';
		?>
	</main>
</body>
</html>
