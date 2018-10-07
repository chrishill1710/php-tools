
<?php
include 'conn.php';
try {
$db = new PDO("informix:host=$ids_host; service=$ids_service;database=$ids_db; server=$ids_server; protocol=onsoctcp; EnableScrollableCursors=1;", "$ids_user", "$ids_pass");

$stmt = $db->query("select count(*) from test");
$res = $stmt->fetch( PDO::FETCH_BOTH );
$rows = $res[0];
echo "Count: $rows ";
} catch (PDOException $e) {
    print $e->getMessage();
}

?>
