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
  input += "&tags=all, "+tags;
  input += "&token="+token;


  console.log(input);

  callAPI('api/inv/add', 'POST', input, function(){
    if (this.readyState !== 4) return;
    if (this.status !== 200) return;
    var inv = this.responseText;
    console.log(inv);
  });
}
