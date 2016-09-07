/**   Stratus Custom JS
*       Cole Cassidy
*    github.com/thecolec
*/

//Runs onload. Begins Stratus Client services.
function renderStratus(){
  callAPI('api/inv');
}

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
