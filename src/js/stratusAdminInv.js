function invAdd() {
  console.log("ADD-INV: Form submitted");
  var name = document.getElementById("invAddName").value;
  var desc = document.getElementById("invAddDesc").value;
  var avail = document.getElementById("invAddAvail").value;
  var list = document.getElementById("invAddForSale").value;
  var stock = document.getElementById("invAddCount").value;
  var price = document.getElementById("invAddPrice").value;
  var tags = document.getElementById("invAddTags").value;
  var data = document.getElementById("invAddParentPID").value;
  document.getElementById("invAddName").value = "";
  document.getElementById("invAddDesc").value = "";
  document.getElementById("invAddAvail").value = "";
  document.getElementById("invAddForSale").value = "";
  document.getElementById("invAddCount").value = "";
  document.getElementById("invAddPrice").value = "";
  document.getElementById("invAddTags").value = "";
  document.getElementById("invAddParentPID").value = "";
  var input = "name="+name;
  input += "&description="+desc;
  input += "&avail="+avail;
  input += "&sale="+list;
  input += "&stock="+stock;
  input += "&price="+price;
  input += "&tags=massinv, "+tags;
  input += "&data="+data;
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
    numChildren = 0;
    if(invJson[x].hasOwnProperty('children')) {
      numChildren = invJson[x].children.length;
    }
    document.getElementById("invListBody").innerHTML += `<tr class="clickable" data-toggle="collapse" data-target=".childOf${invJson[x].itemCode}">
                                                            <th scope="row">${invJson[x].itemCode}</th>
                                                            <th>${invJson[x].name}</th>
                                                            <th>${numChildren}</th>
                                                        </tr>`;
    if(numChildren > 0) {
      for (y=0; y < invJson[x].children.length; y++) {
      document.getElementById("invListBody").innerHTML += `<tr class="collapse childOf${invJson[x].itemCode} active">
                                                              <td scope="row">${invJson[x].children[y].itemCode}</td>
                                                              <td>${invJson[x].children[y].name}</td>
                                                              <td></td>
                                                          </tr>`;
      }
    }
  }
}
