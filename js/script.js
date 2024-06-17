/*

Script  : Main JS
Version : 1.0
Author  : Surjith S M
URI     : http://themeforest.net/user/surjithctly

Copyright © All rights Reserved
Surjith S M / @surjithctly

*/

$(function() {
    "use strict";
    /* ================================================
          Back to top
          ================================================ */
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $("#scroll").fadeIn();
        } else {
            $("#scroll").fadeOut();
        }
    });
    $("#scroll").on("click", function(e) {
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });

   

  

    
   

    /* ================================================
        Dropdown Menu
        ================================================ */

    if ($(".dropdown-menu a.dropdown-toggle").length) {
        $(".dropdown-menu a.dropdown-toggle").on("click", function(e) {
            if (!$(this).closest(".dropdown").hasClass("show")) {
                $(this).closest(".dropdown").first().find(".show").removeClass("show");
            }
            var $subMenu = $(this).closest(".dropdown");
            $subMenu.toggleClass("show");

            $(this)
                .parents("li.nav-item.dropdown.show")
                .on("hidden.bs.dropdown", function(e) {
                    $(".dropdown-submenu .show").removeClass("show");
                });

            return false;
        });
    }
    
});

/* ================================================
      Contact Forms Powered by Web3forms.com
      ================================================ */

const form = document.getElementById("form");
const result = document.getElementById("result");

form &&
    form.addEventListener("submit", function(e) {
        const formData = new FormData(form);
        e.preventDefault();
        var object = {};
        formData.forEach((value, key) => {
            object[key] = value;
        });
        var json = JSON.stringify(object);
        result.innerHTML = "Please wait...";

        fetch("https://api.web3forms.com/submit", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: json,
            })
            .then(async(response) => {
                if (response.status == 200) {
                    let json = await response.json();
                    result.innerHTML = json.body.message;
                } else {
                    console.log(response);
                    result.innerHTML = "Something went wrong!";
                }
            })
            .catch((error) => {
                console.log(error);
                result.innerHTML = "Something went wrong!";
            })
            .then(function() {
                form.reset();
                setTimeout(() => {
                    result.style.display = "none";
                }, 5000);
            });
    });

/*

    var json = JSON.stringify(object);
    result.innerHTML = "Please wait...";

    fetch("https://api.web3forms.com/submit", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: json,
    })
      .then(async (response) => {
        if (response.status == 200) {
          let json = await response.json();
          result.innerHTML = json.body.message;
        } else {
          console.log(response);
          result.innerHTML = "Something went wrong!";
        }
      })
      .catch((error) => {
        console.log(error);
        result.innerHTML = "Something went wrong!";
      })
      .then(function () {
        form.reset();
        setTimeout(() => {
          result.style.display = "none";
        }, 5000);
      });
  });*/

/* ================================================
      Fixed menu
      ================================================ */


jQuery(document).ready(function($) {
    $(window).scroll(function() {
        var scroll = jQuery(window).scrollTop();
        if (scroll >= 1) {
            $("#fixedmenu").addClass("fixed-top  p3 p1-xs pt0 pb0 css-bg-blanco   slow-effect");
        } else {
            $("#fixedmenu").removeClass("fixed-top p3 p1-xs pt0-xs pb0-xs pt0 pb0  css-bg-blanco  ");
        }
    });
});

 /*
jQuery(document).ready(function($) {
    $(window).scroll(function() {
        var scroll = jQuery(window).scrollTop();
        if (scroll >= 1) {
            $("#sidebar-scroll").addClass("  slow-effect   ");
        } else {
            $("#sidebar-scroll").removeClass(" slow-effect     ");
        }
    });
}); */

jQuery(document).ready(function($) {
    $(window).scroll(function() {
        var scroll = jQuery(window).scrollTop();
        if (scroll >=40 ) {
            $("#sidebar-scroll2").addClass(" sidebar-scroll     ");
        } else {
            $("#sidebar-scroll2").removeClass(" sidebar-scroll    ");
        }
    });
});



/* ================================================
      Slow id movement
      ================================================ */


      $(document).ready(function() {
        $('a[href^="#1"]').click(function() {
            var destino = $(this.hash);
            if (destino.length == 0) {
                destino = $('a[name="' + this.hash.substr(1) + '"]');
            }
            if (destino.length == 0) {
                destino = $('html');
            }
            $('html, body').animate({ scrollTop: destino.offset().top }, 1000);
            return false;
        });
    });
    
/* ================================================
    Change Specific Hour and update status
    ================================================ */


function getTestHour() {
    var dataTestHour = document.getElementById("inputTestingHour").value;
    var dataTestDate = document.getElementById("inputTestingDate").value;
    var dataTestLocation = document.getElementById("inputTestingLocation").value;
    //console.log("JS ->" + dataTestHour + " DATE ->" + dataTestDate);


    //Call Fucntion
    requestDataTime(dataTestHour, dataTestDate, dataTestLocation);

    //SetDate
    document.getElementById("spanDateStatus").textContent = dataTestDate;
}


// Obtengo el nombre del dia.
function Day_name(custom_date)
{
     var myDate       = custom_date;
     myDate           = myDate.split("-");
     var newDate      = myDate[0]+"-"+myDate[1]+"-"+myDate[2];
     var my_ddate     = new Date(newDate).getTime();
     var currentDate  = new Date(newDate);
     var day_name     = currentDate.getDay();
     var days         = new Array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday", "Sunday");

     return days[day_name];
}

function convertToHours(num){
  var hours               = Math.floor(num / 100);
  var minutes             = num % 100;

  minutes = (minutes < 10 ? '0' : '') + minutes;

  return hours + ":" + minutes;
}

function formatScheduleOptions(schedules){
  let availableSchedule   = "";
  let scheduleCounter     = schedules[0];
  let minutes             = 0;
  var optionarr           = ["<option value='", "'>", "</option>"];
  var openTwo             = schedules[0];
  var closeTwo            = schedules[1];

  scheduleCounter = openTwo;

  while (scheduleCounter < Math.floor(schedules[1])) {

      availableSchedule = availableSchedule + optionarr[0] + convertToHours(scheduleCounter) + optionarr[1] + convertToHours(scheduleCounter) + optionarr[2];
      if((scheduleCounter % 100) != 0){
        scheduleCounter = scheduleCounter + 70;
      }else{
        scheduleCounter = scheduleCounter + 100;
      }

  }


  return availableSchedule;
}

// Envio el horario disponible ese dia.
function schedules(location, dayName){
  let availableSchedule   = "";
  var schedulesOne        = [1400, 1500];
  var schedulesTwo        = [900, 1300];
  var schedulesThree      = [1600, 1800];
  var schedulesFour       = [730, 1300];

  console.log(dayName);
  //availableSchedule = formatScheduleOptions(schedulesTwo);
  //console.log(formatScheduleOptions(schedulesTwo));
  // Beringe  (Schoorgras 20 , 5986 PK Beringe (Testing Location))
  // Monday to Saturday 1400--1500
  if(location == "Schoorgras 20 , 5986 PK Beringe (Testing Location)"){
    availableSchedule = formatScheduleOptions(schedulesOne);
  }
  // Eindhoven (Wilhelminaplein 12 , 5611 HE Eindhoven (Testing Location))
  // Monday to Friday 0900--1300
  // Weekends  1600--1800
  if(location == "Wilhelminaplein 12 , 5611 HE Eindhoven (Testing Location)"){
    //Check this schedule
    if(dayName == "Sunday" || dayName == "Saturday"){
      availableSchedule = formatScheduleOptions(schedulesThree);
    }else{
      availableSchedule = formatScheduleOptions(schedulesTwo);
    }
  }
  // Veldhoven (De Achterstraat 7, 5504 TC, Veldhoven (Testing Location) script.js:618:17), Nijmegen (Nijmegen, Kerkenbos 1002 (Testing Location))
  // Monday to Friday 0900--1300
  // Weekends 1600--1800
  if(location == "De Achterstraat 7, 5504 TC, Veldhoven (Testing Location)" || location == "Nijmegen, Kerkenbos 1002 (Testing Location)"){
    if(dayName == "Sunday" || dayName == "Saturday"){
      availableSchedule = formatScheduleOptions(schedulesTwo);
      availableSchedule = availableSchedule + formatScheduleOptions(schedulesThree);
    }else{
      availableSchedule = formatScheduleOptions(schedulesTwo);
      availableSchedule = availableSchedule + formatScheduleOptions(schedulesThree);
    }
  }
  // Helmond (Hortsedijk 106b, 5708 HE, Helmond, Netherlands (Testing Location)), Belfeld (Blauwwater 12B, 5951 DB, Belfeld, the Netherlands (Testing Location)), Weert (Industriekade 46, 6006SJ, Weert, Netherlands (Testing Location))
  // Monday to Friday 0730--1300  1600--1800
  // Weekends 0900--1300 1600-1800
  if(location == "Hortsedijk 106b, 5708 HE, Helmond, Netherlands (Testing Location)" || location == "Blauwwater 12B, 5951 DB, Belfeld, the Netherlands (Testing Location)" || location == "Industriekade 46, 6006SJ, Weert, Netherlands (Testing Location)"){
    if(dayName == "Sunday" || dayName == "Saturday"){
      availableSchedule = formatScheduleOptions(schedulesTwo);
      availableSchedule = availableSchedule + formatScheduleOptions(schedulesThree);
    }else{
      availableSchedule = formatScheduleOptions(schedulesFour);
      availableSchedule = availableSchedule + formatScheduleOptions(schedulesThree);
    }
  }
  return availableSchedule;
}

function getTestingCode() {
    var testingCode = document.getElementById("inputTestingLocation").value;
    var testingDate = document.getElementById("inputTestingDate").value;
    var testingHour = document.getElementById("inputTestingHour");
    var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

    // console.log("Testing ->" + testingCode + testingDate);
    console.log("Get location schedule");
    $.ajax({
        data: {
            "testingCode": testingCode,
            "testingDate": testingDate,

        },
        type: "POST",
        dataType: "text",
        url: "./php/getLocationSchedule.php",
    }).done(function(data, textStatus, jqXHR) {
        /*
        console.log("DATA-> " + data);
        console.log("Testing Code: ", testingCode);
        console.log("TestingDate:", testingDate);
        console.log("El dia es: ", Day_name(testingDate));
        */

        //const jsonData = JSON.parse(data);
        // console.log("JSON -> " + jsonData[5]);
        //testingHour.innerHTML = data;
        //testingHour.innerHTML = "DATA-> <option value='7:30'>7:30</option><option value='8:00'>8:00</option><option value='9:00'>9:00</option><option value='10:00'>10:00</option><option value='11:15'>11:15</option>";
        testingHour.innerHTML = schedules(testingCode, Day_name(testingDate));
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log("Request FAIL!  " + textStatus);
    });


}

//Consulta AJAX  a la base de de datos

function requestDataTime(hour, date, location) {

    var testHourAv = document.getElementById("inputTestStatus");

    $.ajax({
        data: {
            "hour": hour,
            "date": date,
            "location": location
        },
        type: "POST",
        dataType: "text",
        url: "./php/getDataHour.php",
    }).done(function(data, textStatus, jqXHR) {
        //console.log("DATA-> " + data);
        testHourAv.innerHTML = data;

    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log("Request FAIL!  " + textStatus);
    });

}



//Obtener los Valores y actualizar el DOM

function getSpecificHour() {
    var data = document.getElementById("inputTestingHour");
    var dataTestHour = data.value;

    console.log(dataTestHour);

}


//Estilo javascript selfwriting

const options = {
    strings: ['Ervin Grey'],
    typeSpeed: 125,
    backSpeed: 60,
    backDelay: 1500,
    shuffle: true,
    loop: true,
    showCursor: false
  };
  
  const typed = new Typed('#jsActiveText', options);
  