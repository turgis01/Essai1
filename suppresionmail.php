
<?php
	
	if($_GET['Email']){
		$adresseMail = $_GET['Email'];
		//$db = new PDO('mysql:host=localhost;dbname=cv;charset=utf8', 'root', 'root');
		$db = new PDO('mysql:host=exmachinefmci.mysql.db;dbname=exmachinefmci;charset=utf8', 'exmachinefmci', 'carp310M');

		$selectall = $db->query('SELECT * FROM dturgisMail WHERE Email="'.$adresseMail.'"');
        $result = $selectall->fetch();
        $counttable = (count($result));

        if($counttable >= 1){
            $delete = $db->prepare('DELETE FROM dturgisMail WHERE Email="'.$adresseMail.'"');
            $delete->execute();
        }	

		// confirmation de suppresion
		echo('Votre &ecirc;tes bien desabonn&eacute; de notre liste de diffusion');
}
	?>
