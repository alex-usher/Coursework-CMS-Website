function openNav() {
    var toggle = document.getElementById('menuIcon');
    var nav = document.getElementById('navContainer');

    if(window.innerWidth <= 800){
        if(window.innerWidth <= 800 && window.innerWidth >= 600){
            nav.style.width = '30%';
        } else if(window.innerWidth < 600 && window.innerWidth >= 500){
            nav.style.width = '40%';
        } else if(window.innerWidth < 500 && window.innerWidth >= 400){
            nav.style.width = '50%';
        } else {
            nav.style.width = '100%';
        }
    }

    toggle.setAttribute('href', 'javascript:void(0)');
    toggle.setAttribute('onClick', 'closeNav()');
}

function closeNav() {
    var toggle = document.getElementById('menuIcon');
    var nav = document.getElementById('navContainer');

    nav.style.width = '0%';
    toggle.setAttribute('href', 'javascript:void(0)');
    toggle.setAttribute('onClick', 'openNav()')
}

function logIn(){
  var username = document.getElementById("userEntry").value;
  var pwd = document.getElementById("pwdEntry").value;
  var userArray = username.split("");
  var pwdArray = pwd.split("");

  var validatedUser = "";
  for(var i=0; i<userArray.length;i++){
    if(userArray[i] === "<"){
      userArray[i] = "%60";
    } else if(userArray[i] === ">"){
      userArray[i] = "%62";
    } else if(userArray[i] === "#"){
        userArray[i] = "%23";
    }

    validatedUser = validatedUser + userArray[i];
  }

  var validatedPwd = "";
  for(var i=0; i<pwdArray.length;i++){
    if(pwdArray[i] === "<"){
      pwdArray[i] = "%60";
    } else if(pwdArray[i] === ">"){
      pwdArray[i] = "%62";
    } else if(pwdArray[i] === "#"){
        pwdArray[i] = "%23";
    }

    validatedPwd = validatedPwd + pwdArray[i];
  }

  window.location.href = "a/logIn.php?usernameEntry="+validatedUser+"&passwordEntry="+validatedPwd;
}
