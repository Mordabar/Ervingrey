<?php
include_once 'Connection/classConexionDB.php';
openConnection();
include_once 'Connection/library_db_sql.php';

//Get Data from HTML name
$Name               = $_POST["max_name"];
$LastName           = $_POST["max_lastname"];
$Gender             = $_POST["max_gender"];
$Birthdate          = $_POST["max_birthdate"];
$Email              = $_POST["max_email"];
$Phone              = $_POST["max_phonenumber"];
$Street             = $_POST["max_street"];
$SecAddress         = $_POST["max_second_add"];
$Place              = $_POST["max_place"];
//$Province = $_POST["max_province"];

$Postcode           = $_POST["max_postcode"];
$Country            = $_POST["max_country"];
$Idmethod           = $_POST["max_id_method"];
$BSNnumber          = $_POST["max_bsn_number"];
$Docnumber          = $_POST["max_doc_number"];
$Voor               = $_POST["max_voor"];

//Get Data Schedule
$TestType           = $_POST["max_test_type"];
$TestLocation       = $_POST["max_test_location"];
$TestDate           = $_POST["max_test_date"];
$TestHourWhole      = $_POST["max_test_hour"];
$TestHourAvailable  = $_POST["max_test_hour_av"];
$Consent            = $_POST["max_consent"];

//New request id
$code               = rand(9999,999999);
$ApCode             = "AP".$code;

//Save Data in DB
//$request = newAppointment($ApCode,$Name, $LastName,$Gender,$Birthdate,$Email, $Phone,$Street,$SecAddress,$Place,$Province,$Postcode,$Country,$Idmethod,$BSNnumber,$Docnumber,$Voor,$TestType,$TestLocation,$TestDate,$TestHourWhole,$TestHourAvailable,1,$Consent);
// Province removed according to requirements.
$request = newAppointment($ApCode,$Name, $LastName,$Gender,$Birthdate,$Email, $Phone,$Street,$SecAddress,$Place,"default",$Postcode,$Country,$Idmethod,$BSNnumber,$Docnumber,$Voor,$TestType,$TestLocation,$TestDate,$TestHourWhole,$TestHourAvailable,1,$Consent);

if($request){
  //
  $headers .= "Reply-To: The Sender <info@maxpromed.nl>\r\n";
  $headers .= "Return-Path: The Sender <info@maxpromed.nl>\r\n";
  $headers .= "From: Maxpromed <info@maxpromed.nl>\r\n";
  $headers .= "Organization: Maxpromed\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
  $headers .= "X-Priority: 3\r\n";
  $headers .= "X-Mailer: PHP". phpversion() ."\r\n";

  //**For English Please See Below**

$emailBody = "Beste ". $Name . " " . $LastName .",

Uw " . $TestType .", - in de corona teststraat van MaxProMed in ". $TestLocation . " is bevestigd.

Uw reserveringscode is " . $ApCode . " " . $TestDate .

 " om " . $TestHourAvailable .
" Bedankt voor het gebruik maken van onze diensten.

Gelieve ten alle tijden uw paspoort, ID-kaart of rijbewijs mee te nemen. Komt u voor een test met reis certificaat, zorg er dan voor dat u een ID kaart of Paspoort meeneemt (uw reisdocument). Een rijbewijs volstaat niet voor internationale reizen.


Komt u naar Veldhoven? De teststraat ligt langs Chinees restaurant Wah Sing (de achterzijde van het restaurant) in De Achterstraat. Gelieve te parkeren op De Plaatse, vanwaar het 100 meter lopen is.

Tot snel!



Stay Safe, Stay Negative!



Met vriendelijke groet,

MaxProMed
+31646626613

*English*


Dear ". $Name . " " . $LastName .",

Your " . $TestType .", - in the Covid-19 testing location of MaxProMed in ". $TestLocation . " is hereby confirmed.

Your reservation code is " . $ApCode . " " . $TestDate .

 " om " . $TestHourAvailable .
" Thanks for making use of our services.

Please remember to bring your Passpord, ID card or Dutch Driver licence. In case you need a travel certificate please make sure you take the document with which you are traveling (ID card or Passport). A driver licence is not sufficient for international travels.


Are you visiting us in Veldhoven? the testing location is next to Chinese restaurant Wah Sing (backside of the restaurant) in 'De Achterstraat'. Please park at 'De Plaatse' from where it is 100 meters walking.

See you soon!



Stay Safe, Stay Negative!



Kind regards,

MaxProMed
+31646626613";

  //
  // Setting the Body of the Email
  //$emailBody = 'Maxpromed ' . $Name . ' ' . $LastName . ' Place: ' . $Place . ' Test Type: ' . $TestType . ' DocNumber: ' . $Docnumber . ' Test Location: ' . $TestLocation . ' Test Date: ' . $TestDate;
  //$emailBody = $ApCode;
  mail($Email, "Maxpromed", $emailBody, $headers);
  //
  header("Location:../appointment-resume.php?res=".base64_encode($ApCode));
  //echo "register";

}else{
    //echo "Ocurrio un error";

}

?>
