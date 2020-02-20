function dbInfo(){
  var dbName = document.getElementById("db").value;
  var dbHost = document.getElementById("dbHost").value;
  var dbUser = document.getElementById("dbUser").value;
  var dbPwd = document.getElementById("dbPwd").value;

  var vars = [dbName, dbHost, dbUser, dbPwd];
  for(i=0;i<vars.length;i++){
    vars[i] = validate(vars[i]);
  }

  window.location.href = "install.php?db="+vars[0]+"&dbHost="+vars[1]+"&dbUser="+vars[2]+"&dbPwd="+vars[3];
}

function validate(toValidate){
  if(toValidate.length > 0){
    var char = toValidate.substring(0,1);
    if(char === "#"){
      return "%23" + validate(toValidate.substring(1));
    } else if(char === "<"){
      return validate(toValidate.substring(1));
    } else if(char === ">"){
      return validate(toValidate.substring(1));
    } else {
      return char + validate(toValidate.substring(1));
    }
  } else {
    return "";
  }
}
