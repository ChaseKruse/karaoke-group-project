<?php
	$_POST["amountpaid"] = (isset($_POST["amountpaid"]) ? $_POST["amountpaid"] : 0);
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
	header("Location: songlist.php");
        exit();
?>
