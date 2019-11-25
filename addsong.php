<!DOCTYPE HTML>
<html>
	<head>
		<title>Song List</title>
		<link href='core.css' rel='stylesheet'>
	</head>
	<body>
		<div class='TitleContainer AlignCenter' >Song List</div>
		<div style='background-color:white;height:500px;padding:50px;'>
			<table class='FullWidth'>
				<tbody>
					<tr>
						<td class='AlignRight'>
							<select id='SearchField'>
								<option>Artist</option>
							</select>
							contains
							<input type='text' id='SearchValue'/>
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
					<tbody></tbody>
				</table>
			</div>
		</div>
		<div class='Modal'>
                        <div class='ModalContainer'>
                                <button class='DetailClose' onclick='window.location.href="song.php?SearchField=Artist&SearchValue="'></button>
                                <div class='DetailTitle'><?php echo $_GET["songtitle"]; ?></div>
                                <div style='background-color:white;padding:50px;height:350px;'>
                                        <form action='addtoqueue.php' method='POST'>
                                                <table class='FullWidth'>
                                                        <tbody>
                                                                <tr>
                                                                        <td>Karaoke File</td>
                                                                        <td class='AlignRight'>
										<select name='fileid' style='width:184px;'>
											<?php
												$conn = new PDO('mysql:host=courses;dbname=z1844922', 'z1844922', '2000Apr01');
                                                        					$query = '
													SELECT
														fileid,
														filedesc
													FROM
														karaoke
													WHERE
														songid = :songid
                                                                				';
                                                        					$sth = $conn->prepare($query);
                                                        					$sth->bindParam(':songid', $_GET["songid"]);

                                                        					$sth->execute();
                                                        					$stmt = $sth->fetchAll();
												foreach($stmt as $row) {
													echo '<option value="' . $row["fileid"] . '">' . $row["filedesc"] . '</option>';
												}
											?>
										</select>
									</td>
                                                                </tr>
                                                                <tr>
                                                                        <td>User</td>
                                                                        <td class='AlignRight'>
										<select name='userid' style='width:184px;'>
                                                                                        <?php
                                                                                                $conn = new PDO('mysql:host=courses;dbname=z1844922', 'z1844922', '2000Apr01');
                                                                                                $query = '
                                                                                                        SELECT
                                                                                                                *
                                                                                                        FROM
                                                                                                                user
                                                                                                ';
                                                                                                $sth = $conn->prepare($query);

                                                                                                $sth->execute();
                                                                                                $stmt = $sth->fetchAll();
                                                                                                foreach($stmt as $row) {
                                                                                                        echo '<option value="' . $row["userid"] . '">' . $row["username"] . '</option>';
                                                                                                }
                                                                                        ?>
                                                                                </select>
									</td>
                                                                </tr>
								<tr>
									<td colspan='2'><br/></td>
								</tr>
                                                                <tr>
                                                                        <td>Accelerated Queue <span style='color:blue;cursor:pointer;font-size:10pt;vertical-align:top;font-weight:bolder;'
										 title='The by paying money, you will place your song in an &#xA;accelerated queue, where it will get played earlier. '>&#x3f;</span></td>
                                                                        <td class='AlignRight'><input type="checkbox" style="width:15px;height:15px;"
									 	 onclick='var paid = document.getElementById("amountpaid"); paid.disabled ? paid.disabled = false : paid.disabled = true; paid.focus();'/></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td class='AlignRight'>$<input type="number" min="0.00" step="0.01" name='amountpaid' placeholder="0.00" id='amountpaid' disabled='disabled'/></td>
                                                                </tr>
                                                                <tr>
                                                                        <td colspan='2'><br /></td>
                                                                </tr>
                                                                <tr>
                                                                        <td colspan='2'><input type='submit' value='Add to Queue' class='DetailBtn' style='min-width:100%;;'/></td>
                                                                </tr>
                                                        </tbody>
                                                </table>
                                        </form>
                                </div>
                        </div>
                </div>
	</body>
</html>
