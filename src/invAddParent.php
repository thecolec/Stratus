<h1>Inventory Management</h1>
<ul class="nav nav-pills">
  <li role="presentation" class="active" id="addParentBtn"><a onclick="gridRenderInvAdd('invAddParent.php');">Add Parent</a></li>
  <li role="presentation" id="addChildBtn"><a onclick="gridRenderInvAdd('invAddChild.php');">Add Child</a></li>
  <li role="presentation" id="editItemBtn"><a onclick="gridRenderInvAdd('edit');">Edit Item</a></li>
  <li role="presentation" id="groupEditBtn"><a onclick="gridRenderInvAdd('manage');">Manage Groups</a></li>
</ul><br>
<form>
  <!-- is this a unique item? (is this item a parent or one-of-a-kind?) -->
  <div class="form-group hidden">
    <label for="unqTog">Is this item unique?</label>
    <select class="form-control" id="unqTog">
      <option>Yes</option>
      <option>No</option>
    </select>
  </div>
  <!-- name/label field (toggles depending on unique status) -->
  <div class="form-group">
    <label for="invAddName">Item Name</label>
    <div class="input-group">
      <span class="input-group-addon">Name</span>
      <input type="" class="form-control" id="invAddName" placeholder="Name" />
    </div>
  </div>
  <!-- description field (only present for uniques) -->
  <div class="form-group">
    <label for="invAddDesc">Item Description</label>
    <textarea type="" class="form-control" id="invAddDesc" placeholder="Description" rows="3"></textarea>
  </div>
  <!-- availability toggle (sets if item is available for sale) -->
  <div class="form-group">
    <label for="invAddAvail">Is the item available?</label>
    <select class="form-control" id="invAddAvail">
      <option value="1">Yes</option>
      <option value="0">No</option>
    </select>
  </div>
  <!-- list toggle (sets if item appears in listings (this only effects uniques)) -->
  <div class="form-group">
    <label for="invAddForSale">Shall this item appear in the listings?</label>
    <select class="form-control" id="invAddForSale">
      <option value="1">Yes</option>
      <option value="0">No</option>
    </select>
  </div>
  <!-- inventory count field (how many of this item are in stock) -->
  <div class="form-group">
    <label for="invAddCount">Current Stock</label>
    <div class="input-group">
      <span class="input-group-addon">Stock</span>
      <input type="" class="form-control" id="invAddCount" placeholder="0-255" />
    </div>
  </div>
  <!-- price field -->
  <div class="form-group">
    <label for="invAddPrice">Price</label>
    <div class="input-group">
      <span class="input-group-addon">$</span>
      <input type="" class="form-control" id="invAddPrice" placeholder="0.00" />
    </div>
  </div>
  <!-- tags field (tags separated by ", " lower-case) -->
  <div class="form-group">
    <label for="invAddTags">Item Tags</label>
    <div class="input-group">
      <span class="input-group-addon">Tags</span>
      <input type="" class="form-control" id="invAddTags" placeholder="tag1, tag2, etc." />
    </div>
  </div>

  <button type="button" class="btn btn-primary" onclick="invAdd();">Add</button>
</form>
