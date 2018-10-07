
<?php
include 'conn.php';
try {
$db = new PDO("informix:host=$ids_host; service=$ids_service;database=$ids_db; server=$ids_server; protocol=onsoctcp; EnableScrollableCursors=1;", "$ids_user", "$ids_pass");

$stmt = $db->query("Select sh_mode from sysmaster:sysshmvals");
$res = $stmt->fetch( PDO::FETCH_BOTH );
$f_mode = $res[0];
$f_type="Secondary";
if ($f_mode == "5")
{
$f_type="Primary";
}
echo " \n";
echo "Mode: $f_mode $f_type \n";
echo " \n";
} catch (PDOException $e) {
    print $e->getMessage();
}

?>
