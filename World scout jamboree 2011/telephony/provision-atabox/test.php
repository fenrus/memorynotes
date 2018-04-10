<?php

include "db.php";

db(true)->connect('localhost','provision','password','provision');


print_r(db()->fetchAll("SELECT * from phones where id = %d;",1));

print_r(db()->fetchSingle("SELECT * from phones where id = %d;",1));

print_r(db()->fetchOne("SELECT mac from phones where id = %d;",1));

print_r(db()->fetchAllOne("SELECT mac from phones;"));

$asd = db()->fetchAll("SELECT * from phones");
foreach ($asd as $line) {
	echo "telefon ".$line["mac"]."\n";
}

?>
