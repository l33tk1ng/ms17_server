<?php

require('conf.php');

go_home();

$conn = mysqli_connect($server, $user, $pass);

if (!$conn) {
	die("<p>Ühendusega on halvasti".mysqli_connect_error."</p>");
}
echo "Ühendus on olemas!";


//kirje lisamise "loogika"
function write_record($conn) {
	$sql_write = "INSERT INTO ms17.nimekiri (EesNimi, PereNimi, id_code) VALUES ('Endel','Eesvärav','32132231234')";

	if (mysqli_query($conn, $sql_write)) {
	echo "<p>Kirje lisamine õnnestus!</p>";
	} else {
	echo "<p>Viga: ".mysqli_error($conn)."</p>";
	}

	mysqli_close($conn);
}

//kõikide kirjete "loogika"
function show_all($conn){
	$sql_select_all = "SELECT * FROM ms17.nimekiri";
	$result = mysqli_query($conn, $sql_select_all);

	if (mysqli_num_rows($result) > 0){
		while($row =mysqli_fetch_assoc($result)){
			echo "<p>id: ".$row["id"].
			" Eesnimi: ".$row["EesNimi"].
			" Perenimi: ".$row["PereNimi"].
			" Isikukood: ".$row["id_code"].
			" Sisestusaeg: ".$row["time"]."</p>";
		}
	}	else { echo "Tabel on tühi";}
	mysqli_close($conn);
}

//kirje lisamine baasi
function write_button($conn) {
	echo "<input type='submit' name='insert_record' value='Sisesta kirje'>";
	if(isset($_POST['insert_record'])) {
		write_record($conn);
	}
}

//kõikide kirjete näitamine
function show_all_button($conn){
	echo "<input type='submit' name='show_all' value='Näita kõiki kirjeid'>";
	if(isset($_POST['show_all'])){
		show_all($conn);
	}
}

?>

<!1-- Sisestusvorm -->
<form action ="" method="post">
	<p><?php write_button($conn); ?></p>
</form>

<!1-- Väljastusvorm (näitab kõiki kirjeid) -->
<form action="" method="post">
	<p><?php show_all_button($conn); ?></p>
</form>

<form action="" method="get">
	<ul>
		<li>
			<label for="ID">ID</label>
			<input type="text" name="id">
		</li>
		<li>
			<?php search_by_button($conn); ?>
		</li>
	</ul>
</form>
