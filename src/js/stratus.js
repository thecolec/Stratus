/**   Stratus Custom JS
*       Cole Cassidy
*    github.com/thecolec
*/
var siteMode = "";

// To be run on body load. Begins Stratus Client services.
function renderStratus(){

  // Detects Currently Loaded Page
  var path = window.location.pathname;
  var page = path.substring(path.lastIndexOf('/')+1);

  // Sets Site Mode
  if(page == "index.php"){
    siteMode = "index";
  }
  else if(page == "login.php") {
    siteMode = "login";
  }

  modeManager();
}

// Performs behaviors depending on site mode.
function modeManager(){
  if(siteMode == "index") {

  }
  else if(siteMode == "login") {
    loginModalLoader();
  }
}

// Index Mode functions

// Login Mode functions
function loginModalLoader(){
  $(document).ready(function () {
    $('#login').modal('show');
  });
}
function toggleLogin() {
  $('#register').modal('hide');
  $('#login').modal('show');
}
function toggleRegister() {
  $('#login').modal('hide');
  $('#register').modal('show');
}

// Garbage. To be deleted at a later date.
//handles calls to the serverside api
function callAPI(uri){
  var httpReq= new XMLHttpRequest();
  httpReq.open('GET', uri, true);
  httpReq.onreadystatechange = function() {
    if (this.readyState!==4) return;
    if (this.status!==200) return;
    var response = JSON.parse(this.responseText);
    console.log(this.responseText);
    //document.getElementById('inventorygrid').innerHTML = this.responseText;
    createItemGrid(response);

  };
  httpReq.send();
}

//detects what panels need to be created based off of JSON input.
function createItemGrid(items){
  console.log(items.length);
  console.log(items[1]);
  for(x = 0; x <= items.length-1; x++) {
    createItemPanel(items[x]);
  }
}

//handles loading and populating panels
function createItemPanel(itemJson){

}
