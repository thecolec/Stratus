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
