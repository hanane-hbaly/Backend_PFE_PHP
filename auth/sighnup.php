<?php
include "../connect.php";

$id = filterRequest("id");
$cin = filterRequest("cin");



// $stmt = $con->prepare("SELECT * FROM users WHERE id = ? and cin = ? and service=1 ");
// $stmt->execute(array( $id, $cin));
// $count = $stmt->rowCount();
// $row=$stmt->fetch();
// $type=$row['type'];
// result($count,$type) ; 

getData("users","id = ? and cin = ? and service=1",array($id,$cin));




