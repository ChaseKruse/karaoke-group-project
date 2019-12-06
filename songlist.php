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
	<div id = "content">
		<h1 style="color: #000;">Select a Song</h1>
		<div style='font-size:12px;'>*Click on a song for more options</div>
		<div style='font-size:12px;'>*Hover over a song to view contributors</div>
		<br />
		<select id='SearchField'
			onchange='window.location.href=window.location.href=window.location.href.split("?")[0] +
				"?searchval=" + document.getElementById("SearchVal").value +
				"&searchfield=" +  document.getElementById("SearchField").value;'>
			<?php
                        	echo "<option " . (isset($_GET["searchfield"]) && $_GET["searchfield"] == "Artist" ? "selected=selected" : "") . ">Artist</option>";
                                echo "<option " . (isset($_GET["searchfield"]) && $_GET["searchfield"] == "Title" ? "selected=selected" : "") . ">Title</option>";
                                echo "<option " . (isset($_GET["searchfield"]) && $_GET["searchfield"] == "Contributor" ? "selected=selected" : "") . ">Contributor</option>";
                       	?>
		</select>
                contains
                <input type='text' id='SearchVal' style='width:150px;'
                	value='<?php echo (isset($_GET["searchval"]) ? $_GET["searchval"] : "")?>'
                        onkeydown='if(event.which==13) { window.location.href=window.location.href.split("?")[0] +
                        "?searchval=" + document.getElementById("SearchVal").value +
                        "&searchfield=" +  document.getElementById("SearchField").value; }'/>
		<div id = "songList">
			<table style="width:100%">
				<thead>
					<tr id = "sticky">
						<th>Song ID</th>
						<th>Song Title</th>
						<th>Artist</th>
					</tr>
				</thead>
				<tbody>
					<?php
							$_GET["searchval"] = (isset($_GET["searchval"]) ? $_GET["searchval"] : "%");
							$_GET["searchfield"] = (isset($_GET["searchfield"]) ? $_GET["searchfield"] : "Artist");
                                                        $conn = new PDO('mysql:host=courses;dbname=z1844922', 'z1844922', '2000Apr01');
                                                        $query = '
                                                                                SELECT
                                                                                        S.*,
                                                                                        C.*,
                                                                                        scrole
                                                                                FROM
                                                                                        song S left outer join
                                                                                        songcontributor SC ON S.songid = SC.songid left outer join
                                                                                        contributor C ON SC.contributorid = C.contributorid AND
                                                                                                        CASE
                                                                                                                WHEN :searchfield LIKE "Contributor" THEN C.contributorname
                                                                                                                ELSE :searchval
                                                                                                        END
                                                                                                        LIKE :searchval
                                                                                WHERE
                                                                                        CASE
                                                                                                WHEN :searchfield LIKE "Artist" THEN songartist
                                                                                                WHEN :searchfield LIKE "Title" THEN songtitle
                                                                                                ELSE :searchval
                                                                                        END
                                                                                        LIKE :searchval
                                                                                ORDER BY
                                                                                        songid
                                                                ';
                                                        $sth = $conn->prepare($query);
                                                        $searchval = '%' . (isset($_GET["searchval"]) ? $_GET["searchval"] : '%') . '%';
                                                        $sth->bindParam(':searchval', $searchval);
                                                        $sth->bindParam(':searchfield', $_GET["searchfield"]);

							$sth->execute();
                                                        $stmt = $sth->fetchAll();
                                                        for ($i = 0; $i < count($stmt); $i++) {
                                                                $row = $stmt[$i];
                                                                $contributorstr = (isset($row["contributorname"]) ? $row["scrole"] . ': ' . $row["contributorname"] . '&#xA;' : '');
                                                                while($i+1 < count($stmt) && $stmt[$i+1]["songid"] == $row["songid"]) {
                                                                        $i++;
                                                                        $row = $stmt[$i];
                                                                        $contributorstr .= $row["scrole"] . ': ' . $row["contributorname"] . '&#xA;';
                                                                }
                                                                if(strlen($_GET["searchval"]) == 0 || ($_GET["searchfield"] == "Contributor" && $row["contributorname"] != NULL || $_GET["searchfield"] != "Contributor")){
                                                                        echo '<tr class="Hover" onclick="window.location.href=\'songrequest.php?songid=' . $row['songid'] . '&songtitle=' . $row['songtitle'] . '\'"
                                                                                        title="' . $contributorstr . '">' .
                                                                                '<td style="width:33%;">' . $row['songid'] . '</td>' .
                                                                                '<td style="width:34%;">' . $row['songtitle'] . '</td>' .
                                                                                '<td style="width:33%;">' . $row['songartist'] . '</td>' .
                                                                        '</tr>';
                                                                }
                                                        }
                                                ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

</body>

</html>
