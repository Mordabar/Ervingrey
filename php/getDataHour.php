<?php
include_once 'Connection/classConexionDB.php';
openConnection();
include_once 'Connection/library_db_sql.php';


$hour = $_POST["hour"];
$date = $_POST["date"];
$location = $_POST["location"];


//Verify Hour
$dataMinutesExp = explode(":",$hour);
//echo "  ->".$dataMinutesExp[1] ;

//////////////////////////////////////////////////////////////////////////////////
// Aqui se configura el horario disponible.
/*if($dataMinutesExp[1] == 15 || $dataMinutesExp[1] == 30 ){

    echo "<option value ='".$hour."' class='optionAvailable'>".$hour."</option>";
    console.log("Message here");

}*/
if($dataMinutesExp[1] == 15 || $dataMinutesExp[1] == 30 ){

  $hourWhole = explode(":",$hour);
  $hourFinish = $hourWhole[0].":59";

  //QUERY
  $dataState = getBusyHour($location,$date,$hour,$hourFinish);

  //var_dump($dataState);
  $convertDataState = convert_object_to_array($dataState);

  //SET MINUTES
  if(isset($convertDataState)){

          //Explode
          $arrayMinutes = array();
          $k = 0;
              while($k < count($convertDataState)){
                  $mainHour =$convertDataState[$k]["ap_test_hour_specific"];
                  array_push($arrayMinutes,$mainHour);
                  $k++;
              }

          //echo "Horas de la bd ";
          //print_r($arrayMinutes);

          //Get hour
          $timeHour = explode(":",$convertDataState[0]["ap_test_hour_specific"]);
      // echo "hour ->" .$timeHour[0];

          //Create new array with 4 elements and hour
          $h = 0;
          $starMinutes = array("30","35","40","45","50","55");
          $newArrayHour = array();

          while($h < 6){
              $concatHour = $timeHour[0].":".$starMinutes[$h];
              array_push($newArrayHour,$concatHour);
              $h++;
          }
          echo "Nuevo array de horas ";

          //var_dump($newArrayHour);

          /////////////////////////////////////////////////////////////////////////////////////

          //Add elements to complete 12 items in the hour from db
          if(count($arrayMinutes) <6)
          {
              $j = 0 ;
              $rest = 6 - count($arrayMinutes);
              //echo "COUNT->  ".count($arrayMinutes);
              //echo  "resta -> ". $rest;

              while($j < $rest){
                  array_push($arrayMinutes,"xx");
                  $j++;
              }

              //echo "Sample Hour with 77";
              //print_r($arrayMinutes);

              //Get differents hours in the array

              $freeHour= array_diff($newArrayHour,$arrayMinutes);

              //Sort elements

              sort($freeHour);
          // print_r($freeHour);

              $varSample = arrayStatus($freeHour,$convertDataState);

          }
          else{
              //  > 4
              printLabelHTMLWhole($convertDataState);
          }

  }
  else{
      //echo "Don´t exist data to show";
      //Data is null
      //Create all cases in available
      printHTMLOption($hourWhole[0]);

  }

}else{
  console.log("Message here");

            ///////////////////////////////////

        //QUERY PARAMS TO SET A SPECIFI HOUR
        $hourWhole = explode(":",$hour);
        $hourFinish = $hourWhole[0].":59";

        //QUERY
        $dataState = getBusyHour($location,$date,$hour,$hourFinish);

        //var_dump($dataState);
        $convertDataState = convert_object_to_array($dataState);

        //SET MINUTES
        if(isset($convertDataState)){

                //Explode
                $arrayMinutes = array();
                $k = 0;
                    while($k < count($convertDataState)){
                        $mainHour =$convertDataState[$k]["ap_test_hour_specific"];
                        array_push($arrayMinutes,$mainHour);
                        $k++;
                    }

                //echo "Horas de la bd ";
                //print_r($arrayMinutes);

                //Get hour
                $timeHour = explode(":",$convertDataState[0]["ap_test_hour_specific"]);
            // echo "hour ->" .$timeHour[0];

                //Create new array with 4 elements and hour
                $h = 0;
                $starMinutes = array("00","05","10","15","20","25","30","35","40","45","50","55");
                $newArrayHour = array();

                while($h < 12){
                    $concatHour = $timeHour[0].":".$starMinutes[$h];
                    array_push($newArrayHour,$concatHour);
                    $h++;
                }
                echo "Nuevo array de horas ";

                //var_dump($newArrayHour);

                /////////////////////////////////////////////////////////////////////////////////////

                //Add elements to complete 12 items in the hour from db
                if(count($arrayMinutes) <12)
                {
                    $j = 0 ;
                    $rest = 12 - count($arrayMinutes);
                    //echo "COUNT->  ".count($arrayMinutes);
                    //echo  "resta -> ". $rest;

                    while($j < $rest){
                        array_push($arrayMinutes,"xx");
                        $j++;
                    }

                    //echo "Sample Hour with 77";
                    //print_r($arrayMinutes);

                    //Get differents hours in the array

                    $freeHour= array_diff($newArrayHour,$arrayMinutes);

                    //Sort elements

                    sort($freeHour);
                // print_r($freeHour);

                    $varSample = arrayStatus($freeHour,$convertDataState);

                }
                else{
                    //  > 4
                    printLabelHTMLWhole($convertDataState);
                }

        }
        else{
            //echo "Don´t exist data to show";
            //Data is null
            //Create all cases in available
            printHTMLOption($hourWhole[0]);

        }

        //echo "ERROR";



}


////////////////////////////////////

//$printFunction = verifyStartCloseHour($date,$hour,$location);
//echo "func  ".$printFunction;



/////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////FUNCTION/////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////



function arrayStatus($arrayA,$arrayDataBase){
console.log("Message here");
    $h = 0;
    $newArrayHour = array();

        while($h < count($arrayA)){
            array_push($newArrayHour,array("ap_test_hour_specific" => $arrayA[$h],"ap_time_status" => 0));
            $h++;
        }

//echo "Nuevo array de horas ";
//print_r($newArrayHour);


/////////////////
//Merge array from database and create
$mergeResult = array_merge($newArrayHour,$arrayDataBase);
//print_r($mergeResult);

//Sort

sort($mergeResult);
//echo "sort ";
//print_r($mergeResult);

//call function

printLabelHTML($mergeResult);


}

function printLabelHTML($arrayDouble){
console.log("Message here");
    for($i = 0; $i < count($arrayDouble); ++$i){

        if($arrayDouble[$i]["ap_time_status"] == 1){

            echo "<option value ='".$arrayDouble[$i]["ap_test_hour_specific"]."' class='optionBusy' disabled>".$arrayDouble[$i]["ap_test_hour_specific"]."</option>";

        }else{

            echo "<option value ='".$arrayDouble[$i]["ap_test_hour_specific"]."' class='optionAvailable'>".$arrayDouble[$i]["ap_test_hour_specific"]."</option>";

        }

    }
}


function printLabelHTMLWhole($arrayHour){
console.log("Message here");
    for($i = 0; $i < count($arrayHour); ++$i){

        if($arrayHour[$i]["ap_time_status"] == 1){

            echo "<option value ='".$arrayHour[$i]["ap_test_hour_specific"]."' class='optionBusy' disabled>".$arrayHour[$i]["ap_test_hour_specific"]."</option>";

        }else{

            echo "<option value ='".$arrayHour[$i]["ap_test_hour_specific"]."' class='optionAvailable'>".$arrayHour[$i]["ap_test_hour_specific"]."</option>";

        }

    }
}

function printHTMLOption($Hour){
console.log("Message here");
    $star = array("00","05","10","15","20","25","30","35","40","45","50","55");
    $arrayHour = array();
    $x = 0 ;

    while($x < 12){
        $concatHour = $Hour.":".$star[$x];
        array_push($arrayHour,$concatHour);
        $x++;
    }

    for($i = 0; $i < count($arrayHour); ++$i){

            echo "<option value ='".$arrayHour[$i]."' class='optionAvailable'>".$arrayHour[$i]."</option>";



    }

}


function verifyStartCloseHour($dateLocation,$hourLocation,$locationName){
console.log("Message here");
    //date
    $date = str_replace('-"', '/', $dateLocation);
    $newDate = date("l", strtotime($date));

    $queryDate = "sc_".strtolower(strval($newDate)) ;

    ///////////////////////
    //QUERY PARAMS TO SET A SPECIFI HOUR
    $hourWhole = explode(":",$hourLocation);
    $hourFinish = $hourWhole[0].":59";


    //Consulta
    $dateHour = getLocationHourinRange($locationName,$queryDate,$hourLocation,$hourFinish);

    $dataLocation = convert_object_to_array($dateHour);

    //print_r($dataLocation);



}


?>
