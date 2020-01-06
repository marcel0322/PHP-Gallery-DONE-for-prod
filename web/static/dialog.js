window.addEventListener("DOMContentLoaded",(event)=>{
  var dialog = document.getElementById("onSubmitDialog");
  dialog.setAttribute("onclick", "dialog()");
});

function dialog() {
  $( function() {
        $( "#dialog" ).dialog();
    });
}
