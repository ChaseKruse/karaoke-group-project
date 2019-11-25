<!DOCTYPE HTML>
<html>
	<head>
		<title>Song List</title>
		<link href='core.css' rel='stylesheet'>
	</head>
	<body onload="document.getElementById('SearchVal').focus();">
		<div class='TitleContainer AlignCenter' >Song List</div>
		<div style='background-color:white;height:500px;padding:50px;'>
			<table class='FullWidth'>
				<tbody>
					<tr>
						<td class='AlignRight'>
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
						<td>
					</tr>
				</tbody>
			</table>
			<div class='BorderBottomScheme'>
				<table class='FullWidth'>
					<tbody>
						<tr>
							<td style='width:33%;'>Song ID</td>
							<td style='width:34%;'>Song Title</td>
							<td style='width:33%;'>Song Artist</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class='BodyScheme' id='PartBodyDiv'>
				<table class='FullWidth'>
					<tbody>
						<?php
							$conn = new PDO('mysql:host=courses;dbname=z1844922', 'z1844922', '2000Apr01');
							$query = '
										SELECT
											S.*,
											C.*,
											scrole
										FROM
											song S left outer join
											songcontributor SC ON S.songid = SC.songid left outer join
											contributor C ON SC.contributorid = C.contributorid
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
								$contributorstr = (isset($row["scrole"]) ? $row["scrole"] . ': ' . $row["contributorname"] . '&#xA;' : '');
								while($i+1 < count($stmt) && $stmt[$i+1]["songid"] == $row["songid"]) {
									$i++;
									$row = $stmt[$i];
									$contributorstr .= $row["scrole"] . ': ' . $row["contributorname"] . '&#xA;';
								}
   			 					echo '<tr class="Hover" onclick="window.location.href=\'addsong.php?songid=' . $row['songid'] . '&songtitle=' . $row['songtitle'] . '\'"
										title="' . $contributorstr . '">' .
									'<td style="width:33%;">' . $row['songid'] . '</td>' .
									'<td style="width:34%;">' . $row['songtitle'] . '</td>' .
									'<td style="width:33%;">' . $row['songartist'] . '</td>' .
								'</tr>';
							}
							echo "<tr><td><br><br><pre>";
							var_dump($stmt);
							echo "</pre></td></tr>";
						?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>
