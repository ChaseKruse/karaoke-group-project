<?php
	$conn = new PDO('mysql:host=courses;dbname=z1844922', 'z1844922', '2000Apr01');
	$query = '
			DELETE FROM queue
			WHERE queueid = :queueid
		';
	$sth = $conn->prepare($query);
	$sth->bindparam(':queueid', $_GET['queueid']);

	$sth->execute();
	header("Location: queue.php?songtitle=" . $_GET["songtitle"] . "&artist=" . $_GET["artist"] . "&username=" . $_GET["username"]);
        exit();
?>
