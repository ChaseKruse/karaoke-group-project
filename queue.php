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
						<td style='width:50%;'>
							<div class='BorderBottomScheme'>
								<table class='FullWidth'>
									<tbody>
										<tr>
											<td style='width:33%;'>Queue ID</td>
											<td style='width:34%;'></td>
											<td style='width:33%;'></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class='BodyScheme'>
								<table class='FullWidth'>
									<tbody>
										<?php
											$conn = new PDO('mysql:host=courses;dbname=z1844922', 'z1844922', '2000Apr01');
											$query = '
													SELECT
														*
													FROM
														queue
													WHERE
														amountpaid = 0
												';
											$sth = $conn->prepare($query);

											$sth->execute();
											$stmt = $sth->fetchAll();
											foreach ($stmt as $row) {
												echo "";
											}
											echo "<tr><td><br><br><pre>";
											var_dump($stmt);
											echo "</pre></td></tr>";
										?>
									</tbody>
								</table>
							</div>
						</td>
						<td style='width:50%;'>
							<div class='BorderBottomScheme'>
                                                                <table class='FullWidth'>
                                                                        <tbody>
                                                                                <tr>
                                                                                        <td style='width:33%;'>Queue ID</td>
                                                                                        <td style='width:34%;'></td>
                                                                                        <td style='width:33%;'></td>
                                                                                </tr>
                                                                        </tbody>
                                                                </table>
                                                        </div>
							<div class='BodyScheme'>
                                                                <table class='FullWidth'>
                                                                        <tbody>
                                                                                <?php
                                                                                        $conn = new PDO('mysql:host=courses;dbname=z1844922', 'z1844922', '2000Apr01');
                                                                                        $query = '
                                                                                                        SELECT
														*
													FROM
														queue
													WHERE
														amountpaid != 0
													ORDER BY
														CASE
															WHEN :sortby LIKE "amountpaid" THEN amountpaid
															ELSE queuedate
														END
                                                                                                ';
                                                                                        $sth = $conn->prepare($query);
											$sortby = 'amountpaid';
                                                                                        $sth->bindParam(':sortby', $sortby);

                                                                                        $sth->execute();
                                                                                        $stmt = $sth->fetchAll();
                                                                                        foreach ($stmt as $row) {
                                                                                                echo "";
                                                                                        }
                                                                                        echo "<tr><td><br><br><pre>";
                                                                                        var_dump($stmt);
                                                                                        echo "</pre></td></tr>";
                                                                                ?>
                                                                        </tbody>
                                                                </table>
                                                        </div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</body>
</html>
