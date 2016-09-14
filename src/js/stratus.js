/**   Stratus Custom JS
*       Cole Cassidy
*    github.com/thecolec
*/
var siteMode = "pending";
var formCheck = false;
var userCheck = false;
var passCheck = false;
var codeCheck = false;
var token = '';
var uid = '';
var userJson = '';
// To be run on body load. Begins Stratus Client services.
function initStratus(){

  // Detects Currently Loaded Page
  var path = window.location.pathname;
  var page = path.substring(path.lastIndexOf('/')+1);

  // Sets Site Mode

  modeManager();

}
// Renders page using data stored in userJson.
function renderStratus(){
  document.getElementById("navUsername").innerHTML = userJson.username;

}

// Performs behaviors depending on site mode.
function modeManager(){
  if(siteMode == "authorized") {
    getUserInfo();
  }
  else if(siteMode == "pending") {
    checkToken();
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
    siteMode = "login";
    validateForm();
  });
}
function toggleLogin() {
  siteMode = "login";
  $('#register').modal('hide');
  $('#login').modal('show');
  validateForm();
}
function toggleRegister() {
  siteMode = "register";
  $('#login').modal('hide');
  $('#register').modal('show');
  validateForm();
}
function checkToken() {
  console.log("Checking Token");
  if(token==='' || token === NULL){
    console.log("No Token Found in JS");
    if (document.cookie.indexOf('token') > -1) {
      var b = document.cookie.match('(^|;)\\s*' + 'token' + '\\s*=\\s*([^;]+)');
      token = b ? b.pop() : '';
      console.log("Token Found in cookies");

    } else {
      console.log("Initiating Login");
      siteMode = "login";
      modeManager();
    }
  }
  if (siteMode=="pending") {
    callAPI('api/auth/tokenVer', 'POST', "token="+token, function(){
      if (this.readyState!==4) return;
      if (this.status!==200) return;
      var test = this.responseText;
      if( test !== false) {
        uid = test;
        console.log("UID: "+uid+" received");
        siteMode = "authorized";
        modeManager();
      }
      else {
        siteMode = "login";
        modeManager();
      }
    });
  }

}

// Universal functions.

// Get userdata
function getUserInfo() {
  console.log("getting userInfo for "+uid);
  callAPI('api/info/username', 'GET', "uid="+uid, function(){
    if (this.readyState!==4) return;
    if (this.status!==200) return;
    var test = this.responseText;
    if (test.length > 0){
      console.log("data received: ");
      console.log(test);
      userJson = JSON.parse(test);
      console.log(userJson.username);
      renderStratus();
    }
  });

}

// Validation functions.
// Validates Forms
function validateForm() {
  console.log(userCheck+" "+passCheck+" "+codeCheck);
  if (userCheck && passCheck && (siteMode == "login" || codeCheck)) {
    document.getElementById(siteMode+"Submit").removeAttribute("disabled");
  } else {
    document.getElementById(siteMode+"Submit").setAttribute("disabled","disabled");
  }
}
// Validates User Field
function validateUser(obj) {
  if(obj.value === null || obj.value === ""){
    document.getElementById(obj.id+'Div').className += " has-error";
    userCheck = false;
  } else if (obj.value.length < 8 || obj.value.length > 20) {
    document.getElementById(obj.id+'Div').className += " has-error";
    userCheck = false;
  } else if (/^[a-zA-Z0-9]*$/.test(obj.value) === false) {
    document.getElementById(obj.id+'Div').className += " has-error";
    userCheck = false;
  } else {
    document.getElementById(obj.id+'Div').className = "form-group has-success";
    userCheck = true;
  }
  validateForm();
}
// Validates Password(s)
function validatePass(obj) {
  if(obj.value === null || obj.value === ""){
    document.getElementById(obj.id+'Div').className += " has-error";
    passCheck = false;
  } else if (obj.value.length < 8 || obj.value.length > 20) {
    document.getElementById(obj.id+'Div').className += " has-error";
    passCheck = false;
  } else if (/^[a-zA-Z0-9]*$/.test(obj.value) === false) {
    document.getElementById(obj.id+'Div').className += " has-error";
    passCheck = false;
  } else if (obj.value != document.getElementById("regPass2").value && obj.id == "regPass") {
    document.getElementById(obj.id+'Div').className = "form-group has-warning";
    passCheck = false;
  } else if (obj.value == document.getElementById("regPass2").value && obj.id == "regPass") {
    document.getElementById(obj.id+'Div').className = "form-group has-success";
    passCheck = true;
  } else if (obj.value != document.getElementById("regPass").value && obj.id == "regPass2") {
    document.getElementById(obj.id+'Div').className = "form-group has-error";
    passCheck = false;
    validatePass(document.getElementById("regPass"));
  } else {
    document.getElementById(obj.id+'Div').className = "form-group has-success";
    passCheck = true;
  }
  if (obj.id == "regPass2") { validatePass(document.getElementById("regPass")); }
  validateForm();
}
// Validates secretcode
function validateCode(obj, test) {
  callAPI('api/auth/secretcode', 'POST', "secretcode="+obj.value, function(){
    if (this.readyState!==4) return;
    if (this.status!==200) return;
    var test = this.responseText;
  if (test == "true") {
    document.getElementById(obj.id+'Div').className = "form-group has-success";
    codeCheck = true;
  } else {
    document.getElementById(obj.id+'Div').className += " has-error";
    codeCheck = false;
  }
  validateForm();
  });
}

// Handles API calls.
function callAPI(uri, method, input, callback){
  var httpReq= new XMLHttpRequest();
  var response = '';
  if(method == "GET") {
    uri = uri+"?"+input;
    input = '';
  }
  httpReq.open(method, uri, true);
  httpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  httpReq.onreadystatechange = callback;
  if(input !== null ) {
    httpReq.send(input);
  } else {
    httpReq.send();
  }
}

// Garbage. To be deleted at a later date.
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
