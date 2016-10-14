function invAdd() {
  console.log("ADD-INV: Form submitted");
  var name = document.getElementById("invAddName").value;
  var desc = document.getElementById("invAddDesc").value;
  var avail = document.getElementById("invAddAvail").value;
  var list = document.getElementById("invAddForSale").value;
  var stock = document.getElementById("invAddCount").value;
  var price = document.getElementById("invAddPrice").value;
  var tags = document.getElementById("invAddTags").value;
  document.getElementById("invAddName").value = "";
  document.getElementById("invAddDesc").value = "";
  document.getElementById("invAddAvail").value = "";
  document.getElementById("invAddForSale").value = "";
  document.getElementById("invAddCount").value = "";
  document.getElementById("invAddPrice").value = "";
  document.getElementById("invAddTags").value = "";
  var input = "name="+name;
  input += "&description="+desc;
  input += "&avail="+avail;
  input += "&sale="+list;
  input += "&stock="+stock;
  input += "&price="+price;
  input += "&tags=massinv, "+tags;
  input += "&token="+token;


  console.log(input);

  callAPI('api/inv/add', 'POST', input, function(){
    if (this.readyState !== 4) return;
    if (this.status !== 200) return;
    var inv = this.responseText;
    console.log(inv);
  });
}

function renderInvList() {
  for (x=0; x < Object.keys(invJson).length; x++) {
    document.getElementById("invListBody").innerHTML += `<li class="list-group-item" onclick="viewItemCard(${x});">${invJson[x].name}</li>`;
  }
}
