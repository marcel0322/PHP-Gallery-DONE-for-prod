window.addEventListener("DOMContentLoaded",(event)=>{

  if (typeof(Storage) !== "undefined") {
    displayswitch = sessionStorage.getItem("toggle");
    if(displayswitch == null) {
      sessionStorage.setItem("toggle", 'true');
      displayswitch = sessionStorage.getItem("toggle");
    }
    console.log("0var displayswitch="+displayswitch);
    createDDButton();
    driverDisplay();
  }
  else {
    createDDButton();
    alert("Web Storage is not supported in this browser");
  }
});

function createDDButton() {
  var btn = document.createElement("BUTTON");
  btn.innerHTML = "Toggle Driver Display";
  btn.setAttribute("type", "button");
  btn.setAttribute("class", "button toggledd");

  var p = document.createElement("P");
  p.appendChild(btn);
  
  var driverdisplay = document.getElementById("driverdisplay");
  driverdisplay.insertBefore(p, driverdisplay.childNodes[0]);
}

function driverDisplay() {

  if(displayswitch == 'false'){
    var driver = document.getElementsByClassName("driver");
    var i;
    for (i = 0; i < driver.length; i++) {
    driver[i].style.display = "block";
    }
    displayswitch = 'true';
    sessionStorage.setItem("toggle", 'false');
    console.log("2var displayswitch="+displayswitch);
  }
  else if(displayswitch == 'true') {
    var driver = document.getElementsByClassName("driver");
    var i;
    for (i = 0; i < driver.length; i++) {
    driver[i].style.display = "none";
    }
    displayswitch = 'false';
    sessionStorage.setItem("toggle", 'true');
    console.log("3var displayswitch="+displayswitch);
  }
}

$(document).ready(function(){
    $("button.toggledd").click(function(){
      $(".driver").slideToggle(300);
      setTimeout(driverDisplay, 300);
    });
});