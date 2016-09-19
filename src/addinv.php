<div class="container">
<div class="modal fade in" tabindex="-1" role="dialog" id="addInvModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Inventory</h4>
      </div>
      <div class="modal-body clearfix">
        <h1 class="text-center"></h1>
        <!-- Login Form -->
        <form id="addInvForm" name="addInvForm" class="form-horizontal">
          <!-- Name -->
          <div id="addInvNameDiv" class="form-group">
            <label class="col-sm-3 control-label" for="addInvName">Name:</label>
            <div class="col-sm-8">
              <input type="text" name="addInvName" class="form-control" id="addInvName" placeholder="Item Name"/>
            </div>
          </div>
          <!-- Description -->
          <div id="addInvDescDiv" class="form-group">
            <label class="col-sm-3 control-label" for="addInvDesc">Description:</label>
            <div class="col-sm-8">
              <input type="text" name="addInvDesc" class="form-control" id="addInvDesc" placeholder="Item Description"/>
            </div>
          </div>
          <!-- Username -->
          <div id="addInvStockDiv" class="form-group">
            <label class="col-sm-3 control-label" for="addInvStock">Stock:</label>
            <div class="col-sm-8">
              <input type="text" name="addInvStock" class="form-control" id="addInvStock" placeholder="Item Stock"/>
            </div>
          </div>
          <!-- Username -->
          <div id="addInvSaleDiv" class="form-group">
            <label class="col-sm-3 control-label" for="addInvSale">Sale Status:</label>
            <div class="col-sm-8">
              <input type="text" name="addInvSale" class="form-control" id="addInvSale" placeholder="Sale Status"/>
            </div>
          </div>
          <!-- Submit -->
          <button id="addInvSubmit" type="button" class="btn btn-primary pull-right" onclick="addInv();">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
