function checkToken() {
  //DONE:0 Verify Token on login. Clear token if invalid.
  console.log("TOKEN-VER: Checking Token");
  if(token==='' || token === NULL){
    console.log("TOKEN-VER: No Token Found in client memory");
    if (document.cookie.indexOf('token') > -1) {
      var b = document.cookie.match('(^|;)\\s*' + 'token' + '\\s*=\\s*([^;]+)');
      token = b ? b.pop() : '';
      console.log("TOKEN-VER: Token Found in cookies");
    } else {
      console.log("TOKEN-VER: Initiating Login");
      siteMode = "login";
      modeManager();
    }
  }
  if (siteMode=="pending") {
    //DONE:10 Migrate away from UID, identify users using Token alone.
    console.log("TOKEN-VER: Verifying TOKEN");
    callAPI('api/auth/tokenVer', 'POST', "token="+token, function(){
      if (this.readyState!==4) return;
      if (this.status!==200) return;
      var test = this.responseText;
      if( test !== "false") {
        uid = test;
        console.log("TOKEN-VER: uid "+uid+" received");
        siteMode = "loading";
        modeManager();
      }
      else {
        document.getElementById("navUsername").innerHTML = "";
        document.cookie = "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
        siteMode = "login";
        modeManager();
      }
    });
  }
}
function doesHaveAdmin(){
  callAPI('api/auth/adminchk', 'POST', "token="+token, function(){
    if (this.readyState!==4) return;
    if (this.status!==200) return;
    var test = this.responseText;
    console.log("ADMIN-CHK: Verifying Admin");
    if (test == "true") {
      hasAdmin = true;
      console.log("ADMIN-CHK: "+hasAdmin);
    } else {
      hasAdmin = false;
      console.log("ADMIN-CHK: "+hasAdmin);
    }
    renderStratus();
  });
}
function logout(){
  document.cookie = "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
  window.location.href = "/";
}
