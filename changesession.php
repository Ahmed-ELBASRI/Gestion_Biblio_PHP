<?php

$email=$_SESSION["email"];
$pass=$_SESSION["password"];
$con = new PDO("mysql:host=localhost;dbname=gestion_biblio", "root", "");
$query="SELECT p.*, s.libelle, e.DATERESERVATION, e.archive
		FROM statut s
		INNER JOIN personne p ON s.id = p.id_statue
		LEFT JOIN reserverlivre e ON p.ID_PERSONNE = e.ID_PERSONNE
		WHERE  p.email LIKE :email AND p.password LIKE :pass";
		/*$query = "select p.*,s.libelle from PERSONNE p join statut s on p.id_statue = s.id where p.email like :email and p.password like :pass";*/
	
		$stmt = $con->prepare($query);
		$stmt->execute(array(":email" => $email, ":pass" => $pass));
		$data = $stmt->fetch(PDO::FETCH_ASSOC);



if(empty($data["DATERESERVATION"]) || $data["archive"] == 1){
    $_SESSION["livreReserver"]=0;
}
else if($data["archive"] == 0){
    $_SESSION["livreReserver"]=1;
    
}else{
    $_SESSION["livreReserver"]=1;
}


$query1 = "select * from reserverlivre r INNER join empruntlivre e on r.ID_RESERVATION = e.ID_RESERVATION where e.DATE_RETURN is null and r.ID_PERSONNE=:id";
$stmt = $con->prepare($query1);
		$stmt->execute(array(":id"=>$data["ID_PERSONNE"]));
		$data = $stmt->fetch(PDO::FETCH_ASSOC);

 if(empty($data)){
    $_SESSION["livreReserver"]=0;
 }
 else {
    $_SESSION["livreReserver"]=1;
 }       

