<?php
	$rows = $stmt->fetchAll();

	echo '<div class="table-container">';
	echo '<table>';

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
	echo '</div>';
?>
