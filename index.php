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
                $dbh = new PDO('mysql:host=localhost;dbname=film_library', 'root', '');

                $stmt = $dbh->prepare("SELECT title FROM genre");
                $stmt->execute();

                $genres = $stmt->fetchAll();

                $stmt = $dbh->prepare("SELECT name FROM actor");
                $stmt->execute();

                $actors = $stmt->fetchAll();

                foreach ($genres as $genre_row){
                    $genre = $genre_row[0];
                    echo "<option value='$genre'>$genre</option>";
                }
            ?>
        </select>
        <input type="submit" value="Submit">
    </form>

    <!-- Actor form -->
    <form action="actor.php">
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
</body>
</html>
