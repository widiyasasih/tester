<?php 
	include "../db_connection.php";

	$query = "INSERT INTO peminjaman (id_borrower, name) VALUES ('$_POST[id_borrower]', '$_POST[name]')";

	if (mysqli_query($conn, $query)){
		$last_id = mysqli_insert_id($conn);
		echo "<br>".$last_id."<br>";

		$ids = $_POST['ids'];
		$date_repay = $_POST['tgl_kembali'];
		$nominal = $_POST['nom_angsuran'];

		$records = array();
		foreach ($ids as $i) {
			$records[] = array(
				'id_peminjaman' => $last_id,
				'tgl_kembali' => $date_repay[$i],
				'nom_angsuran' => $nominal[$i],
			);
			// var_dump($records);
		}

		if (!empty($records)) {
			$values = array();
			foreach ($records as $row) {
				$values[] = "('{$row['id_peminjaman']}', '{$row['tgl_kembali']}', '{$row['nom_angsuran']}')";
			}

			$values = implode(", ", $values);
			// var_dump($values);

			mysqli_query($conn, "INSERT INTO angsuran (id_peminjaman, date_repay, nominal) VALUES {$values}");
		}
	}
	mysqli_close($conn);
?>