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
			<option>Artist</option>
		</select>
                contains
                <input type='text' id='SearchVal' style='width:150px;'
                	value=''
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
				</tbody>
			</table>
		</div>
	</div>
	<div class='Modal'>
		<div class='ModalContainer'>
				<button class='DetailClose' onclick='window.location.href="songlist.php?searchfield=Artist&searchval="'></button>
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
                                                                                 onclick='var paid = document.getElementById("amountpaid"); paid.disabled ? paid.disabled = false : paid.disabled = true; paid.focus(); paid.value = ""'/></td>
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
</div>

</body>

</html>
