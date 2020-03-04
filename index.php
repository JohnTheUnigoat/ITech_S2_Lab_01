<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	<!-- Genre form -->
	<form action="genre.php" method="get">
		<label for="genre">Genre</label>
		<select name="genre" id="genre">
			<?php
				$conn = new PDO('mysql:host=localhost;dbname=film_library', 'root', '');

				$stmt = $conn->prepare("SELECT title FROM genre");
				$stmt->execute();

				$genres = $stmt->fetchAll();

				$stmt = $conn->prepare("SELECT name FROM actor");
				$stmt->execute();

				$actors = $stmt->fetchAll();

				$cmd = <<<EDO
					SELECT
						MIN(date) AS min,
						MAX(date) AS max
					FROM film
				EDO;
				$stmt = $conn->prepare($cmd);
				$stmt->execute();

				$date_defaults = $stmt->fetch(PDO::FETCH_ASSOC);

				foreach ($genres as $genre_row){
					$genre = $genre_row[0];
					echo "<option value='$genre'>$genre</option>";
				}
			?>
		</select>
		<input type="submit" value="Submit">
	</form>

	<!-- Actor form -->
	<form action="actor.php" method="get">
		<label for="actor">Actor</label>
		<select name="actor" id="actor">
			<?php
				foreach ($actors as $actor_row){
					$actor = $actor_row[0];
					echo "<option value='$actor'>$actor</option>";
				}
			?>
		</select>
		<input type="submit" value="Submit">
	</form>

	<!-- Time period form -->
	<form action="time_period.php" method="get">
		<label for="start">Start date</label>
		<?php
			echo "<input type='date' name='start' id='start' value='$date_defaults[min]'>";
		?>
		<label for="end">End date</label>
		<?php
			echo "<input type='date' name='end' id='end' value='$date_defaults[max]'>";
		?>
		<input type="submit" value="Submit">
	</form>
</body>
</html>
