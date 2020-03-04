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
        <label>Genre</label>
        <select name="genre" id="genre">
            <?php
                $dbh = new PDO('mysql:host=localhost;dbname=film_library', 'root', '');

                $stmt = $dbh->prepare("SELECT title FROM genre");
                $stmt->execute();

                $arr = $stmt->fetchAll();

                foreach ($arr as $genre_row){
                    $genre = $genre_row[0];
                    echo "<option value='$genre'>$genre</option>";
                }
            ?>
        </select>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
