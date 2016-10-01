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
