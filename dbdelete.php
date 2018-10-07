<?php
include 'conn.php';
function echo_log($f_mess)
{
$today = date("Y-m-d H:i:s"); 
print "$today | $f_mess\n";
}
try {
   $db = new PDO("informix:host=$ids_host; service=$ids_service;database=$ids_db; server=$ids_server; protocol=onsoctcp; EnableScrollableCursors=1;", "$ids_user", "$ids_pass");

   echo_log("begin transaction");
   $db->begintransaction();
   for ($x = 0; $x <= 100000; $x++) 
   {
      $stmt = $db->prepare("delete from test where test = 'test-$x'");
      if (!$stmt) 
      {
          echo_log("error with delete ");
          echo "\nPDO::errorInfo():\n";
          print_r($db->errorInfo());
          echo_log("rollback database ");
          $db->rollback();
          break;
      }
      $stmt->execute();
      if ($x % 1000 == 0)
      {
         echo_log("commit database ");
         $db->commit();
         $stmt = $db->query("select count(*) from test");
         $res = $stmt->fetch( PDO::FETCH_BOTH );
         $rows = $res[0];
         echo_log("Count: $rows ");
         echo_log("begin transaction");
         $db->begintransaction();
      }
      
   }
   echo_log("commit database ");
   $db->commit();
} catch (PDOException $e) {
    print $e->getMessage();
          $db->rollback();
}

?>
