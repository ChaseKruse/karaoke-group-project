<!DOCTYPE HTML>
<html>
	<head>
		<title>Supplier Part List</title>
		<link href='core.css' rel='stylesheet'>
	</head>
	<body>
		<div class='TitleContainer AlignCenter' >Song List</div>
		<div style='background-color:white;height:500px;padding:50px;'>
			<table class='FullWidth'>
				<tbody>
					<tr>
						<td class='AlignRight'>
							<select id='SearchField' onchange='window.location.href="song.php"'>
									<option>Artist</option>
									<option>Title</option>
									<option>Contributor</option>

							</select>
							contains
							<input type='text' id='SearchValue' />
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
							$query = '	SELECT
										S.*
									FROM
										song S left outer join
										songcontributor SC ON S.songid = SC.songid left outer join
										contributor C ON SC.contributorid = C.contributorid
								-- 	WHERE
								--		:SearchValue LIKE CASE
								--			WHEN "Artist" THEN songartist
								--			WHEN "Title" THEN songtitle
								--			ELSE contributorname
								--		END
									GROUP BY
										songid
								';
							$sth = $conn->prepare($query);
							$sth->bindParam(':SearchValue', $_GET['SearchValue']);

							$sth->execute();
							$stmt = $sth->fetchAll();
							foreach ($stmt as $row) {
   			 					echo '<tr class="Hover" onclick="window.location.href=\'SuppliersParts.php?songid=' . $row['songid'] . '&songtitle=' . $row['songtitle'] . '\'">' .
									'<td style="width:33%;">' . $row['songid'] . '</td>' .
									'<td style="width:34%;">' . $row['songtitle'] . '</td>' .
									'<td style="width:33%;">' . $row['songartist'] . '</td>' .
								'</tr>';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>
