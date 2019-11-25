<?php
	$conn = new PDO('mysql:host=courses;dbname=z1844922', 'z1844922', '2000Apr01');
	$query = '
			INSERT INTO
				queue(
					userid,
					fileid,
					amountpaid,
					queuedate
				)
			VALUES
				(
					:userid,
					:fileid,
					:amountpaid,
					Now()
				);
		';
	$sth = $conn->prepare($query);
	$sth->bindparam(':userid', $_POST['userid']);
	$sth->bindparam(':fileid', $_POST['fileid']);
	$sth->bindparam(':amountpaid', $_POST['amountpaid']);

	$sth->execute();
	header("Location: http:\/\/students.cs.niu.edu/~z1844922/karaoke-group-project/song.php");
        exit();
?>
