<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include_once 'Connection/classConexionDB.php';
openConnection();
include_once 'Connection/library_db_sql.php';

$registration = base64_decode( $_GET["res"]);

$reservation = getReservation($registration);

//var_dump($reservation);

if($registration != null){

    if($reservation){

        foreach($reservation as $item){


           echo' <div class="row">';
           echo '<div class="col-md-12">';
           echo '<div class="alert alert-success" role="alert">';
           echo'Afspraak gemaakt, dit is de informatie!';
           echo'</div>';
           echo'</div>';


            echo' <div class="col-md-4" style="margin-top: 10px;">';
            echo'    <label>Officiele naam</label>';
            echo'    <input type="text" class="form-control" id="inputResidence" value="'.$item->completedName.'" readonly>';

            echo'</div>';
            echo'<div class="col-md-6" style="margin-top: 10px;">';
            echo'    <label>Registratiecode</label>';
            echo'    <input type="text" class="form-control" id="inputResidence" value="'.$item->ap_meet_register.'" readonly>';

            echo'</div>';

        echo'</div>';


        echo '<div class="row" style="margin-top: 5px;">';

       echo' <div class="col-md-12" style="margin-top: 10px;">';
       echo'     <h5>Covid Test Information</h5>';

        echo'</div>';

        echo'<div class="col-md-4" style="margin-top: 10px;">';
        echo'    <label>Keuze testtype</label>';
        echo'    <input type="text" class="form-control" id="inputResidence" value="'.$item->ap_test_type.'" readonly>';

        echo'</div>';
        echo'<div class="col-md-7" style="margin-top: 10px;">';
        echo'<label>Locatie</label>';
        echo'<input type="text" class="form-control" id="inputResidence" value= "'.$item->ap_test_location.'" readonly>';

        echo' </div>';



        echo'</div>';


        echo' <div class="row">';

         echo' <div class="col-md-4" style="margin-top: 10px;">';
         echo'    <label>Datum</label>';
         echo'    <input type="text" class="form-control" id="inputResidence" value="'.$item->ap_test_date.'" readonly>';

         echo'</div>';
         echo'<div class="col-md-4" style="margin-top: 10px;">';
         echo'    <label>Time of day</label>';
         echo'    <input type="text" class="form-control" id="inputResidence" value="'.$item->ap_test_hour_specific.'" readonly>';

         echo'</div>';

     echo'</div>';

     /*
     $headers .= "Reply-To: The Sender <info@maxpromed.nl>\r\n";
     $headers .= "Return-Path: The Sender <info@maxpromed.nl>\r\n";
     $headers .= "From: Maxpromed <info@maxpromed.nl>\r\n";
     $headers .= "Organization: Maxpromed\r\n";
     $headers .= "MIME-Version: 1.0\r\n";
     $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
     $headers .= "X-Priority: 3\r\n";
     $headers .= "X-Mailer: PHP". phpversion() ."\r\n";
     // Setting the Body of the Email
     $emailBody = 'Maxpromed ' + $Name + ' ' + $LastName + ' Place: ' + $Place + ' Test Type: ' + $TestType + ' DocNumber: ' + $Docnumber + ' Test Location: ' + $TestLocation + ' Test Date: ' + $TestDate;
     //$emailBody = $ApCode;
     mail($Email, "Maxpromed", $emailBody, $headers);
     */

        }


    }
    else{
        echo '<div class="alert alert-danger" role="alert">';
           echo'Nothing has been sent - TRY AGAIN!';
           echo'</div>';
      // header("Location:../error.html");
    }
    }else{

        echo '<div class="alert alert-danger" role="alert">';
           echo'Nothing has been sent - TRY AGAIN!!';
           echo'</div>';

         }
?>
