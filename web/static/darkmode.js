window.addEventListener("DOMContentLoaded",(event)=>{

  if (typeof(Storage) !== "undefined") {
    darkswitch = localStorage.getItem("darkmode");
    if(darkswitch == null) {
      localStorage.setItem("darkmode", 'false');
      darkswitch = localStorage.getItem("darkmode");
    }
    console.log("0var darkswitch="+darkswitch);
    createDarkButton();
    darkMode();
  }
  else {
    createDarkButton();
    alert("Web Storage is not supported in this browser");
  }
});

function darkMode() {

  if(darkswitch == 'false')
  {
    var h2dark = document.getElementsByClassName("h2dark");
    var i;
    for (i = 0; i < h2dark.length; i++) {
      h2dark[i].style.backgroundColor = "#333";
      h2dark[i].style.color = "whitesmoke";
    }
    var gallerybox = document.getElementsByClassName("gallerybox");
    var i;
    for (i = 0; i < gallerybox.length; i++) {
      gallerybox[i].style.borderColor = "black";
      gallerybox[i].style.backgroundColor = "whitesmoke";
    }
    document.getElementById("content-dark").style.backgroundColor = "whitesmoke";
    document.getElementById("para-dark").style.color = "black";
    document.getElementById("para-dark").style.borderColor = "black";
    document.getElementById("darkbtn").innerHTML = "Turn Dark Mode ON";
    var driver = document.getElementsByClassName("driver");
    var i;
    for (i = 0; i < driver.length; i++) {
        driver[i].style.borderColor = "black";
    }
    darkswitch = 'true';
    localStorage.setItem("darkmode", 'false');
    console.log("2var darkswitch="+darkswitch);
  }
  else if(darkswitch == 'true')
  {
    var h2dark = document.getElementsByClassName("h2dark");
    var i;
    for (i = 0; i < h2dark.length; i++) {
      h2dark[i].style.backgroundColor = "whitesmoke";
      h2dark[i].style.color = "black";
    }
    var gallerybox = document.getElementsByClassName("gallerybox");
    var i;
    for (i = 0; i < gallerybox.length; i++) {
      gallerybox[i].style.borderColor = "whitesmoke";
      gallerybox[i].style.backgroundColor = "black";
    }
    document.getElementById("content-dark").style.backgroundColor = "black";
    document.getElementById("para-dark").style.color = "whitesmoke";
    document.getElementById("para-dark").style.borderColor = "whitesmoke";
    document.getElementById("darkbtn").innerHTML = "Turn Dark Mode OFF";
    var driver = document.getElementsByClassName("driver");
    var i;
    for (i = 0; i < driver.length; i++) {
      driver[i].style.borderColor = "whitesmoke";
    }
    darkswitch = 'false';
    localStorage.setItem("darkmode", 'true');
    console.log("3var darkswitch="+darkswitch);
  }
  
}

function createDarkButton() {
  var btn = document.createElement("BUTTON");
  btn.innerHTML = "Turn Dark Mode ON";
  btn.setAttribute("type", "button");
  btn.setAttribute("class", "button");
  btn.setAttribute("id", "darkbtn");
  btn.setAttribute("onclick", "darkMode()");
  var footer = document.getElementById("footer");
  footer.insertBefore(btn, footer.childNodes[0]);
}