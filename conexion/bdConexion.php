<?php
// datos para la conexion a mysql
/*define('DB_SERVER','127.0.0.1');
define('DB_NAME','apunta');
define('DB_USER','root');
define('DB_PASS','');
function ConectarBD(){
$con = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
mysql_select_db(DB_NAME,$con);
}
*/


// datos para la coneccion a mysql

$connect = mysqli_connect("localhost", "root", "", "apunta");
if (mysqli_connect_errno())
{
	unset($connect);
}

?>
