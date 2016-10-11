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
var filterList = "none";
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
    //document.getElementById("addInvBtn").className = "hidden";
    $("#adminOverlay").addClass('hidden');

  }
  if(hasAdmin) {
    //document.getElementById("addInvBtn").className = "btn btn-primary btn-lg pull-right";
    $("#adminOverlay").removeClass('hidden');
  }
  if(filterList == "none") {
    $("clearFilterBtn").addClass('hidden');
  } else {
    $("clearFilterBtn").removeClass('hidden');
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
    getInv(filterList);
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

function setFilter(obj) {
  clearFilter();
  var filter = obj.getAttribute("invTag");
  filterList = filter;
  getInv(filterList);
}
function clearFilter() {
  filterList = "";
}
function addFilter(obj) {

  filterList += "+"+obj.getAttribute("invTag");
  getInv(filterList);
}

function viewItemCard(x){
  $("#itemCard").modal('show');
  document.getElementById("itemCardImg").src = "img/"+invJson[x].itemCode+".png";
  document.getElementById("itemCardName").innerHTML = invJson[x].name;
  document.getElementById("itemCardDescription").innerHTML = invJson[x].description;
  document.getElementById("itemCardPrice").innerHTML = "$"+invJson[x].price;
  document.getElementById("itemCardCode").innerHTML = "PID: "+invJson[x].itemCode;
  var palette = genPalette(document.getElementById("itemCardImg"));
  console.log(invJson[x].itemCode);
}

function genPalette(obj) {
      var vibrant = new Vibrant(obj, 64, 0);
      var swatches = vibrant.swatches();
      for (var swatch in swatches) {
          if (swatches.hasOwnProperty(swatch) && swatches[swatch]) console.log(swatch, swatches[swatch].getHex());
      }
      document.getElementById("itemCardName").style.color = swatches['Vibrant'].getHex();
      document.getElementById("itemCardDescription").style.color = swatches['DarkMuted'].getBodyTextColor();
      document.getElementById("itemCardContent").style.backgroundColor = swatches['DarkMuted'].getHex();
      return swatches;
      /*
       * Results into:
       * Vibrant #7a4426
       * Muted #7b9eae
       * DarkVibrant #348945
       * DarkMuted #141414
       * LightVibrant #f3ccb4
       */

}

// Get Inventory using filter.
function getInv(filterList) {
  console.log("INV: requesting inventory");
  var input = "token="+token+"&filter="+filterList;
  callAPI('api/inv', 'GET', input, function(){
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

// Encodes Strings for URL transmission.
function prepString(input){
  return encodeURIComponent(input);
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
