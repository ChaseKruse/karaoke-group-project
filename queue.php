<!DOCTYPE HTML>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Karaoke Project</title>
</head>

<body>

<h1 style = "margin-top: 25px; text-align: center;">Karaoke Page</h1>

<div id = "wrap">
	<div id = "nav">
		<a href = "index.php" style = "margin-left: 20px;">Song List</a>
		<a href = "queue.php">Song Queue</a>
	</div>
	<div style="background-color:#ddd;padding-left:10px;padding-right:10px;">
		<table style="width:100%;">
			<tbody>
				<tr><td><h2 style='color:black;'>Now Playing</td></tr>
				<?php
					echo "<tr>" .
						"<td colspan='2' style='font-size:14pt;font-weight:bold;margin-left:20px;'>" . (isset($_GET["songtitle"]) ? $_GET["songtitle"] : "---") . "</td>" .
					     "</tr>" .
					     "<tr>" .
						"<td>" . (isset($_GET["artist"]) ? $_GET["artist"] : "---") . "</td>" .
						"<td class='AlignRight'>Requested By: " . (isset($_GET["username"]) ? $_GET["username"] : "---") . "</td>" .
					    "</tr>" .
					    "<tr><td><br /></td></tr>";
				?>
			</tbody>
		</table>
	</div>
	<div id = "content">
                <div style='font-size:12px;'>*Click a song to begin playing</div>
		<table width="100%;">
			<tbody>
				<tr>
					<td style="width:50%;">
						<div style='text-align:center;'><h3>Free Queue</h3></div>
						<select style="visibility:hidden;"><option>&nbsp;</option></select>
						<div id = "songList">
							<table style="width:100%">
								<thead>
									<tr id = "sticky">
										<th style='width:70px;'>Song</th>
										<th>Artist</th>
										<th>Requested By</th>
										<th>Paid</th>
										<th>Time</th>
									</tr>
								</thead>
								<tbody>
										<?php
                                                                                        $conn = new PDO('mysql:host=courses;dbname=z1844922', 'z1844922', '2000Apr01');
                                                                                        $query = '
                                                                                                        SELECT
                                                                                                                queueid,
                                                                                                                username,
                                                                                                                filedesc,
                                                                                                                songtitle,
														amountpaid,
                                                                                                                songartist,
                                                                                                                queuedate
                                                                                                        FROM
                                                                                                                queue Q left outer join user U ON Q.userid = U.userid
                                                                                                                left outer join karaoke K ON Q.fileid = K.fileid
                                                                                                                left outer join song S ON K.songid = S.songid
                                                                                                        WHERE
                                                                                                                amountpaid = 0';
                                                                                        $sth = $conn->prepare($query);

									                $sth->execute();
                                                                                        $stmt = $sth->fetchAll();
                                                                                        foreach ($stmt as $row) {
                                                                                                echo "<tr class='Hover' style='text-align:center;' onclick='window.location.href=\"removefromqueue.php?queueid=" . $row['queueid'] .
														"&songtitle=" . $row["songtitle"] . "&artist=" . $row["songartist"] . "&username=" . $row["username"] . "\"'>" .
                                                                                                                "<td style='width:20%;'>" . $row["songtitle"] . " - " . $row["filedesc"] . "</td>" .
                                                                                                                "<td style='width:20%;'>" . $row["songartist"] . "</td>" .
                                                                                                                "<td style='width:20%;'>" . $row["username"] . "</td>" .
                                                                                                                "<td style='width:20%;'>$" . number_format((float)$row["amountpaid"], 2, '.', '') . "</td>" .
                                                                                                                "<td style='width:20%;text-align:center;'>" . $row["queuedate"] . "</td>" .
                                                                                                        "</tr>";
                                                                                        }
                                                                                ?>
								</tbody>
							</table>
						</div>
					</td>
					<td style="width:50%;">
						<div style='text-align:center;'><h3>Accelerated Queue</h3></div>
						<div class="AlignRight">
                        				Sort by:
                        				<select name="sort" onchange="window.location.href='queue.php?sortby=' + this.options[this.selectedIndex].text;">
                                				<?php
                                       					echo "<option " . (isset($_GET["sortby"]) && $_GET["sortby"] == "Time" ? "selected=selected" : "") . ">Time</option>";
                                        				echo "<option " . (isset($_GET["sortby"]) && $_GET["sortby"] == "Paid" ? "selected=selected" : "") . ">Paid</option>";
                                				?>
                        				</select>
                				</div>
						<div id = "songList">
                                                        <table style="width:100%">
                                                                <thead>
                                                                        <tr id = "sticky">
                                                                                <th>Song</th>
                                                                                <th>Artist</th>
                                                                                <th>Requested By</th>
                                                                                <th>Paid</th>
                                                                                <th>Time</th>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
										<?php
                                                                                        $conn = new PDO('mysql:host=courses;dbname=z1844922', 'z1844922', '2000Apr01');
                                                                                        $sortby = (isset($_GET["sortby"]) ? $_GET["sortby"] : "Time");
											$query = '
                                                                                                        SELECT
                                                                                                                queueid,
                                                                                                                username,
                                                                                                                filedesc,
                                                                                                                songtitle,
                                                                                                                songartist,
                                                                                                                queuedate,
                                                                                                                amountpaid
                                                                                                        FROM
                                                                                                                queue Q left outer join user U ON Q.userid = U.userid
                                                                                                                left outer join karaoke K ON Q.fileid = K.fileid
                                                                                                                left outer join song S ON K.songid = S.songid
                                                                                                        WHERE
                                                                                                                amountpaid != 0
                                                                                                        ORDER BY
                                                                                                ' . ($sortby == "Paid" ? " amountpaid DESC" : " queuedate");
                                                                                        $sth = $conn->prepare($query);
                                                                                        $sth->bindParam(':sortby', $sortby);

	        	                                                                $sth->execute();
          	                                                              		$stmt = $sth->fetchAll();
                                                                                        foreach ($stmt as $row) {
                                                                                               	echo "<tr class='Hover' style='text-align:center;' onclick='window.location.href=\"removefromqueue.php?queueid=" . $row['queueid'] .
                                                                                                                "&songtitle=" . $row["songtitle"] . "&artist=" . $row["songartist"] . "&username=" . $row["username"] . "\"'>" .
                                                                                                                "<td style='width:20%;'>" . $row["songtitle"] . " - " . $row["filedesc"] . "</td>" .
                                                                                                                "<td style='width:20%;'>" . $row["songartist"] . "</td>" .
                                                                                                                "<td style='width:20%;'>" . $row["username"] . "</td>" .
                                                                                                                "<td style='width:20%;'>$" . number_format((float)$row["amountpaid"], 2, '.', '') . "</td>" .
                                                                                                                "<td style='width:20%;text-align:center;'>" . $row["queuedate"] . "</td>" .
                                                                                                        "</tr>";
                                                                                        }
                                                                                ?>
                                                                </tbody>
                                                        </table>
                                                </div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

</body>

</html>
