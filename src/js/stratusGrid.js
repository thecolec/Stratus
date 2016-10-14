// Grid Rendering functions
// Should serve no purpose other than rendering.
// Any required data should be pulled from a public variable or input specifically into its parameters.
// These functions should NEVER call any external functions.

// Renders Grid According to mode.

// Renders Inventory
function gridRenderInv() {
  console.log("GRID: Rendering INV");
  clearGrid();
  for (x=0; x < Object.keys(invJson).length; x++){
    contentGrid.innerHTML += `<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                                <div class="panel panel-default" id="itemPanel-${invJson[x].itemCode}" onclick="viewItemCard(${x});">
                                  <div class="panel-heading">
                                    <h3 class="panel-title" >
                                      ${invJson[x].name}
                                    </h3>
                                  </div>
                                  <img class="img-responsive center-block" src="img/${invJson[x].itemCode}.png" onerror="this.src=\'img/juice.png\'"/>
                                  <div class="panel-body" id="description">
                                    Content Goes Here
                                  </div>
                                </div>
                              </div>`;
  }
}

function gridRenderInvTEST() {
  clearGrid();
  for (x=0; x < 100; x++){
    contentGrid.innerHTML += `<div class="col-*-2">
                                <div class="panel panel-default" id="itemPanel-${invJson[0].itemCode}" onclick="alert('You Clicked on ${invJson[0].name}');">
                                  <div class="panel-heading">
                                    <h3 class="panel-title" >
                                      ${invJson[0].name}
                                    </h3>
                                  </div>
                                  <img class="img-responsive center-block" src="img/juice.png" />
                                  <div class="panel-body" id="description">
                                    Content Goes Here
                                  </div>
                                </div>
                              </div>`;
  }
}

// Renders Filter Selection
function gridRenderFilters() {
  clearGrid();
  contentGrid.innerHTML += `<div class="col-sm-8 col-sm-offset-2">
                              <div class="jumbotron" id="gridJumbotron">
                              </div>
                            </div>`;
  for (x=0; x < Object.keys(responseJson).length; x++) {
    document.getElementById("gridJumbotron").innerHTML += `${responseJson[x].name}<br>`;
  }

}

// Renders inventory-add panel
function gridRenderInvAdd() {
  clearGrid();
  callAPI("invadd.php", "GET", "", function() {
    if (this.readyState !== 4) return;
    if (this.status !== 200) return;
    contentGrid.innerHTML = this.responseText;
  });
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
