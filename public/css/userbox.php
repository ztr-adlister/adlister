<?php
// $boxdata = $dbc->prepare('SELECT boxcolor FROM users WHERE username = :username');
// $boxdata->bindValue(':username', $_SESSION['Loggedinuser'], PDO::PARAM_STR);
// $boxdata->execute();
// $boxcolor = $boxdata->fetch(PDO::FETCH_ASSOC);
?>
<style>
#box {
		/*background-color: <?=$boxcolor['boxcolor']?>;*/
		width: 200px;
		height: 200px;
		margin-left: 42%;
		border: 5px solid black;
		text-align: center;
	}
</style>