/**   Stratus Custom JS
*       Cole Cassidy
*    github.com/thecolec
*/
var siteMode = "pending";
var formCheck = false;
var userCheck = false;
var passCheck = false;
var codeCheck = false;
var hasAdmin  = false;
var token = '';
var uid = '';
var userJson = '';
var invJson = '';
var x=0;
var contentGrid = document.getElementById("contentgrid");
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
  if(!hasAdmin) {
    document.getElementById("addInvBtn").className = "hidden";
  }
  if(hasAdmin) {
    document.getElementById("addInvBtn").className = "btn btn-primary btn-lg";
  }

}

//    Performs behaviors depending on site mode.
//    Site modes determine the context of the webapp, determining what is rendered and how.
//      MODES:
//        pending       -   Default mode, where verification takes place, and the app decides what mode to set itself in.
//        loading       -   Temporary mode, where authorization is confirmed and the app beings loading userData.
//        login         -   When authorization/verification fails this mode allows for login/registration.
//        orders        -   Admin only mode. This lists all open orders. IDEA: Add orders menu.
//        cart          -   Allows users to see items currently in their cart and initiate checkout.
//        browse        -   Allows users to browse the catalogue, view items, and filter what is displayed.
//        options       -   Allows users to configure their individual settings. This is what they see on their fist login.
function modeManager(){
  console.log("SITEMODE: "+siteMode);
  if(siteMode == "browse") {
  }
  else if(siteMode == "pending") {
    checkToken();
  }
  else if(siteMode == "login") {
    loginModalLoader();
  }
  else if(siteMode == "loading") {
    getUserInfo();
    doesHaveAdmin();
    getInv();
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
  //TODO:30 Verify Token on login. Clear token if invalid.
  console.log("TOKEN-VER: Checking Token");
  if(token==='' || token === NULL){
    console.log("TOKEN-VER: No Token Found in client memory");
    if (document.cookie.indexOf('token') > -1) {
      var b = document.cookie.match('(^|;)\\s*' + 'token' + '\\s*=\\s*([^;]+)');
      token = b ? b.pop() : '';
      console.log("TOKEN-VER: Token Found in cookies");
    } else {
      console.log("TOKEN-VER: Initiating Login");
      siteMode = "login";
      modeManager();
    }
  }
  if (siteMode=="pending") {
    //DONE:0 Migrate away from UID, identify users using Token alone.
    console.log("TOKEN-VER: Verifying TOKEN");
    callAPI('api/auth/tokenVer', 'POST', "token="+token, function(){
      if (this.readyState!==4) return;
      if (this.status!==200) return;
      var test = this.responseText;
      if( test !== "false") {
        uid = test;
        console.log("TOKEN-VER: uid "+uid+" received");
        siteMode = "loading";
        modeManager();
      }
      else {
        document.getElementById("navUsername").innerHTML = "";
        document.cookie = "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
        siteMode = "login";
        modeManager();
      }
    });
  }
}
function doesHaveAdmin(){
  callAPI('api/auth/adminchk', 'POST', "token="+token, function(){
    if (this.readyState!==4) return;
    if (this.status!==200) return;
    var test = this.responseText;
    console.log("ADMIN-CHK: Verifying Admin");
    if (test == "true") {
      hasAdmin = true;
      console.log("ADMIN-CHK: "+hasAdmin);
    } else {
      hasAdmin = false;
      console.log("ADMIN-CHK: "+hasAdmin);
    }
    renderStratus();
  });
}
function logout(){
  document.cookie = "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
  window.location.href = "/";
}

// Universal functions.

// Get userdata
function getUserInfo() {
  console.log("USER-INFO: getting userInfo for "+token);
  callAPI('api/info/username', 'GET', "token="+token, function(){
    if (this.readyState!==4) return;
    if (this.status!==200) return;
    var test = this.responseText;
    if (test.length > 0){
      console.log("USER-INFO: data received: ");
      console.log("USER-INFO: "+test);
      userJson = JSON.parse(test);
      renderStratus();
    }
  });

}

// Get Inventory using filter.
function getInv() {
  console.log("INV: requesting inventory");
  callAPI('api/inv', 'GET', '', function(){
    if (this.readyState !== 4) return;
    if (this.status !== 200) return;
    var inv = this.responseText;
    console.log("INV: "+inv);
    if(inv.length>0){
      invJson = JSON.parse(inv).item;
      renderStratus();
      gridRenderInv();
    }
  });
}

// Grid Rendering functions
// Should serve no purpose other than rendering.
// Any required data should be pulled from a public variable or input specifically into its parameters.
// These functions should NEVER call any external functions.

// Renders Grid According to mode.

// Renders Inventory
function gridRenderInv() {
  clearGrid();
  for (x=0; x < Object.keys(invJson).length; x++){
    contentGrid.innerHTML += "<div class=\"col-sm-2\"><div class=\"panel panel-default\"><div class=\"panel-heading\"><h3 class=\"panel-title\" id=\"item-"+invJson[x].itemCode+"\">"+invJson[x].name+"</h3></div><div class=\"panel-body\" id=\"description\">"+invJson[x].description+"</div></div></div>";
  }
}

function gridRenderInvTEST() {
  clearGrid();
  for (x=0; x < 100; x++){
    contentGrid.innerHTML += "<div class=\"col-sm-3\"><div class=\"panel panel-default\"><div class=\"panel-heading\"><h3 class=\"panel-title\" id=\"item-"+invJson[0].itemCode+"\">"+invJson[0].name+"</h3></div><div class=\"panel-body\" id=\"description\">"+invJson[0].description+"</div></div></div>";
  }
}

// Renders Error Message In grid-space
function gridRenderMessage(message) {
  clearGrid();
  contentGrid.innerHTML ="<div class=\"col-sm-8 col-sm-offset-2\"><div class=\"alert alert-danger\" role=\"alert\">"+message+"</div></div>";
}


// Clears Content Grid
function clearGrid() {
  contentGrid.innerHTML = "";
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
function addInv() {
  console.log("ADD-INV: Form submitted");
  var name = document.getElementById("addInvName").value;
  var desc = document.getElementById("addInvDesc").value;
  var stock = document.getElementById("addInvStock").value;
  var sale = document.getElementById("addInvSale").value;
  console.log("ADD-INV: "+name+" "+desc+" "+stock+" "+sale);
  document.getElementById("addInvName").value = "";
  document.getElementById("addInvDesc").value = "";
  document.getElementById("addInvStock").value = "";
  document.getElementById("addInvSale").value = "";
  var input = "name="+name+"&description="+desc+"&stock="+stock+"&sale="+sale+"&token="+token;
  console.log(input);

  callAPI('api/inv/add', 'POST', input, function(){
    if (this.readyState !== 4) return;
    if (this.status !== 200) return;
    var inv = this.responseText;
    console.log(inv);
  });


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
  console.log(input);
  if(input !== null ) {
    httpReq.send(input);
  } else {
    httpReq.send();
  }
}
