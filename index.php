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
	<!-- Data from DB -->
	<?php
	include 'db_connection.php';

	$stmt = $conn->prepare("SELECT title FROM genre");
	$stmt->execute();

	$genres = $stmt->fetchAll(PDO::FETCH_NUM);

	$stmt = $conn->prepare("SELECT name FROM actor");
	$stmt->execute();

	$actors = $stmt->fetchAll(PDO::FETCH_NUM);

	$cmd = <<<EDO
	SELECT
		MIN(date) AS min,
		MAX(date) AS max
	FROM film
	EDO;
	$stmt = $conn->prepare($cmd);
	$stmt->execute();

	$date_defaults = $stmt->fetch(PDO::FETCH_ASSOC);
	?>
	<main>
		<div class='container'>
			<!-- Genre form -->
			<div class='item'>
				<h2>Select movies by genre</h2>
				<form action="genre.php" method="get">
					<label class="input" for="genre">Genre</label>
					<select class="input" name="genre" id="genre">
						<?php
						foreach ($genres as $genre_row){
							$genre = $genre_row[0];
							echo "<option value='$genre'>$genre</option>";
						}
						?>
					</select><br>
					<input class="input" type="submit" value="Submit">
				</form>
			</div>

			<!-- Actor form -->
			<div class='item'>
				<h2>Select movies by actor</h2>
				<form action="actor.php" method="get">
					<label class="input" for="actor">Actor</label>
					<select class="input" name="actor" id="actor">
						<?php
						foreach ($actors as $actor_row){
							$actor = $actor_row[0];
							echo "<option value='$actor'>$actor</option>";
						}
						?>
					</select><br>
					<input class="input" type="submit" value="Submit">
				</form>
			</div>

			<!-- Time period form -->
			<div class='item'>
				<h2>Select movies by time period</h2>
				<form action="time_period.php" method="get">
					<label class="input" for="start">Start date</label>
					<?php
					echo "<input class='input' type='date' name='start' 		id='start'value='$date_defaults[min]'>";
					?><br>

					<label class="input" for="end">End date</label>
					<?php
					echo "<input class='input' type='date' name='end' 	id='end'value='$date_defaults[max]'>";
					?><br>
					<input class="input" type="submit" value="Submit">
				</form>
			</div>
		</div>
	</main>
</body>
</html>
