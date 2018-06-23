<?php
/*
  Orri honek, hartutako parametroen arabera, honako eragiketak egiten ditu:

  Parametroak: 	action=add&url=xxxxx&title=xxxx
  Eragiketa: 	xxxx url-a MySQL-ko RSS taulara gehituko du.
  Irteera: 		Gehitutako azken elementuaren ID-a imprimatuko du.
  Formatua: 	Textua.

  Parametroak: 	action=delete&id=xx
  Eragiketa: 	xx id-a duen url-a ezabatuko du.
  Irteera: 		OK mezua imprimatuko du.
  Formatua: 	Textua.

  Parametroak: 	action=load&id=xx
  Eragiketa: 	xx id-a duen url-ra konektatuko da eta RSS feeda kargatuko du internetetik.
  Irteera: 		RSS aren XML-a.
  Formatua: 	JSON.

  Parametroak: 	action=RSSresources
  Eragiketa: 	rss taulako datu guztiak itzultzen ditu.
  Irteera: 		id, titulua eta url-a dituen JSON objetuen array-a.
  Formatua: 	JSON.

  Parametroak: 	action=numRSS
  Eragiketa: 	Taulan ditugun RSS erregistroen zenbatekoa itzuliko du.
  Irteera: 		Zenbat RSS ditugun esaten duen zenbakia.
  Formatua: 	Textua.
*/

// Datuak JSON eran bidali
header('Cache-Control: no-cache, must-revalidate');
// Cachea desgaitu
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

/* dbcreation.sql fitxategia erabili datu-basea, erabiltzailea eta taula zure MySQL zerbitzarian sortzeko.
Beharrezkoa izanez gero, konfigurazioa zure lan-ingurunera egokitu.*/

// MySQL Datu-basearen kofigurazioa
$server = "127.0.0.1";
$database = "ajax";
$user = "ajax";	
$password = "dwec";

// Zerbitzarirako konexioa sortu.
$conection=mysql_connect($server, $user, $password) or die(mysql_error());
mysql_query("SET NAMES 'utf8'",$conection);

// Konexioa erabiliz, datu-basea atzitu.
mysql_select_db($database,$conection) or die(mysql_error());
	
	
switch ($_GET['action'])
{
	case 'add':
		$sql= sprintf("insert into rss(titulo,url) values('%s','%s')",mysql_real_escape_string($_GET['titulo']),mysql_real_escape_string($_GET['url']));
		mysql_query($sql,$conection) or die(mysql_error());
		echo mysql_insert_id();
	break;

	case 'delete':
		$sql= sprintf("delete from rss where id=%s",mysql_real_escape_string($_GET['id']));
		mysql_query($sql,$conection) or die(mysql_error());
		echo "ezabaketa OK";
	break;

	
	case 'load':
		$sql=sprintf("select * from rss where id=%s",mysql_real_escape_string($_GET['id']));
		$result=mysql_query($sql,$conection) or die(mysql_error());
		$registers=mysql_fetch_assoc($result);
		

		$doc = new DOMDocument();
		$doc->load($registers['url']);
		$arrFeeds = array();
		foreach ($doc->getElementsByTagName('item') as $node) 
		{
			$itemRSS = array ( 
				'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
				'description' => $node->getElementsByTagName('description')->item(0)->nodeValue,
				'url' => $node->getElementsByTagName('link')->item(0)->nodeValue,
				'pubDate' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue
				);
				
			array_push($arrFeeds, $itemRSS);
		}	

		header('Content-Type: application/json');
		echo json_encode($arrFeeds);
	break;

	case 'RSSresources':
		$sql= sprintf("select * from rss order by id");
		$result=mysql_query($sql,$conection) or die(mysql_error());
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$data[$row['id']]=$row;
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	break;
	
	case 'numRSS':
		$sql= sprintf("select * from rss order by id");
		$result=mysql_query($sql,$conection) or die(mysql_error());
		echo mysql_num_rows($result);
	break;
}
	
mysql_close($conection);
?>