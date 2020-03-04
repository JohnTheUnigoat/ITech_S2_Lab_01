<?php
	$rows = $stmt->fetchAll();

	echo '<table border="1px">';

	echo '<tr>';
	echo '<th>Name</th>';
	echo '<th>Date</th>';
	echo '<th>Country</th>';
	echo '<th>Director</th>';
	echo '</tr>';

	foreach($rows as $row){
		echo '<tr>';
		for($i = 0; $i < 4; $i++){
			echo "<td>$row[$i]</td>";
		}
		echo '</tr>';
	}
	echo '</table>';
?>