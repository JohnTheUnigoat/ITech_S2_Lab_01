<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
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

        $rows = $stmt->fetchAll();

        $colCount = $stmt->columnCount();

        echo '<table border="1px">';
        foreach($rows as $row){
            
            echo '<tr>';
            
            for($i = 0; $i < $colCount; $i++){
                echo "<td>$row[$i]</td>";
            }
            
            echo '</tr>';
        }
        echo '</table>';
    ?>
</body>
</html>