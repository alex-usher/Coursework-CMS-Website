function editUser(){
    var id = document.getElementById('UserID').innerHTML;
    var name = document.getElementById('NameInput').value;
    var username = document.getElementById('UsernameInput').value;
    var email = document.getElementById('EmailInput').value;
    var accessDropDown = document.getElementById('AccessEntry');
    var access = accessDropDown.options[accessDropDown.selectedIndex].value;
    var send = true;

    var validateArray = [name, username, email];
    for(var i=0;i<validateArray.length;i++){
      if(validateArray[i].length>0){
        validateArray[i] = validate(validateArray[i]);
      } else {
        send = false;
      }
    }

    if(send){
      window.location.href = "editUserDB.php?NameInput=" + validateArray[0] + "&UsernameInput=" + validateArray[1] + "&EmailInput=" + validateArray[2] + "&AccessEntry=" + access + "&userid=" + id;
    } else {
      alert("Please complete the form.");
    }
}

function editAccount(){
    var id = document.getElementById('UserID').innerHTML;
    var name = document.getElementById('NameInput').value;
    var username = document.getElementById('UsernameInput').value;
    var email = document.getElementById('EmailInput').value;
    var access = document.getElementById('UserAccess').innerHTML;

    var validateArray = [name, username, email];
    for(var i=0;i<validateArray.length;i++){
      validateArray[i] = validate(validateArray[i]);
    }

    window.location.href = "editAccountDB.php?NameInput=" + validateArray[0] + "&UsernameInput=" + validateArray[1] + "&EmailInput=" + validateArray[2] + "&AccessEntry=" + access + "&userid=" + id;
}

function editPage(){
    var id = validate(document.getElementById('pageID').innerHTML);
    var name = validate(document.getElementById('pageName').value);
    var nameNav = validate(document.getElementById('nameNav').value);
    var metaTitle = validate(document.getElementById('metaTitle').value);
    var metaDescription = validate(document.getElementById('metaDescription').value);
    var metaKeywords = validate(document.getElementById('metaKeywords').value);
    var navMenu = document.getElementById('navMenu').value;
    var footerMenu1 = document.getElementById('footerMenu1').value;
    var footerMenu2 = document.getElementById('footerMenu2').value;
    var displayBlog = document.getElementById('displayBlog').checked;
    var index = document.getElementById('index').checked;
    var send = true;
    var vars = [id, name, nameNav, metaTitle, metaDescription, metaKeywords];

    for(var i=0; i<vars.length; i++){
      if(!(vars[i].length>0)){
        send = false;
      }
    }

    if(send){
      window.location.href = "editPageBasicsDB.php?id=" + vars[0] + "&pageName=" + vars[1] + "&nameNav=" + vars[2] + "&metaTitle=" + vars[3] + "&metaDescription=" +
        vars[4] + "&metaKeywords=" + vars[5] +"&nm="+navMenu+"&fm1="+footerMenu1+"&fm2="+footerMenu2+"&dblog="+displayBlog+"&index="+index;
    } else {
      alert("Please complete the form");
    }
}

function editPageContent(id){
    var content = tinyMCE.get("textarea").getContent();

    var splitContent = content.split("");

    var finalContent = "";

    for(var i=0; i<splitContent.length; i++){
        if(splitContent[i] === "#"){
            splitContent[i] = "%23";
        } else if(splitContent[i] === " "){
            splitContent[i] = "%20";
        } else if(splitContent[i] === "<"){
            splitContent[i] = "%3C";
        } else if(splitContent[i] === ">"){
            splitContent[i] = "%3E";
        }

        finalContent += splitContent[i];
    }

    window.location.href = "pageContentManageDB.php?id="+id+"&content="+finalContent;
}

function addPage(){
    var pageName = document.getElementById('pageName').value;
    var nameNav = document.getElementById('nameNav').value;
    var metaTitle = document.getElementById('metaTitle').value;
    var metaDescription = document.getElementById('metaDescription').value;
    var metaKeywords = document.getElementById('metaKeywords').value;
    var navMenu = document.getElementById('navMenu').value;
    var footerMenu1 = document.getElementById('footerMenu1').value;
    var footerMenu2 = document.getElementById('footerMenu2').value;
    var displayBlog = document.getElementById('displayBlog').checked;
    var index = document.getElementById('index').checked;
    var send = true;

    var validateArray = [pageName, nameNav, metaTitle, metaDescription, metaKeywords, navMenu, footerMenu1, footerMenu2];
    for(var i=0;i<validateArray.length;i++){
      validateArray[i] = validate(validateArray[i]);
    }

    window.location.href = "addPageDB.php?pageName="+validateArray[0]+"&nameNav="+validateArray[1]+"&metaTitle="+validateArray[2]+"&metaDescription="+validateArray[3]
    +"&metaKeywords="+validateArray[4]+"&nm="+validateArray[5]+"&fm1="+validateArray[6]+"&fm2="+validateArray[7]+"&dblog="+displayBlog+"&index="+index;
}


function editBlog(){
    var blogID = validate(document.getElementById("blogId").innerHTML);
    var blogTitle = validate(document.getElementById("blogTitle").value);
    var blogIntro = validate(document.getElementById("blogIntro").value);
    var blogDescription = validate(document.getElementById("blogDescription").value);
    var metaTitle = validate(document.getElementById("metaTitle").value);
    var metaDescription = validate(document.getElementById('metaDescription').value);
    var metaKeywords = validate(document.getElementById('metaKeywords').value);
    var navMenu = document.getElementById('navMenu').value;
    var footerMenu1 = document.getElementById('footerMenu1').value;
    var footerMenu2 = document.getElementById('footerMenu2').value;
    var showInRecent = document.getElementById('showInRecent').checked;

    var vars = [blogTitle, blogIntro, blogDescription, metaTitle, metaDescription, metaKeywords];
    var send = true;

    for(var i=0; i<vars.length;i++){
      if(!(vars[i].length>0)){
        send = false;
      }
    }

    if(send){
      window.location.href = "editBlogBasicsDB.php?id="+blogID+"&blogTitle="+vars[0]+"&blogIntro="+vars[1] +"&blogDescription="+vars[2]+
      "&metaTitle="+vars[3]+"&metaDescription="+vars[4]+"&metaKeywords="+vars[5]+"&nm="+navMenu+"&fm1="+footerMenu1+"&fm2="+footerMenu2+"&sir="+showInRecent;
    } else {
      alert("Please complete the form");
    }
}

function editBlogContent(id){
    var content = tinyMCE.get("textarea").getContent();

    var splitContent = content.split("");

    var finalContent = "";

    for(i=0; i<splitContent.length; i++){
        if(splitContent[i] === "#"){
            splitContent[i] = "%23";
        }

        finalContent += splitContent[i];
    }

    window.location.href = "blogContentManageDB.php?id="+id+"&content="+finalContent;
}

function addBlog(){
    var blogTitle = validate(document.getElementById("blogTitle").value);
    var blogIntro = validate(document.getElementById("blogIntro").value);
    var blogDescription = validate(document.getElementById("blogDescription").value);
    var metaTitle = validate(document.getElementById("metaTitle").value);
    var metaDescription = validate(document.getElementById('metaDescription').value);
    var metaKeywords = validate(document.getElementById('metaKeywords').value);
    var navMenu = document.getElementById('navMenu').value;
    var footerMenu1 = document.getElementById('footerMenu1').value;
    var footerMenu2 = document.getElementById('footerMenu2').value;
    var showInRecent = document.getElementById('showInRecent').checked;

    var vars = [blogTitle, blogIntro, blogDescription, metaTitle, metaDescription, metaKeywords];

    for(i=0;i<vars.length;i++){
      if(vars[i].length>0){
        vars[i] = validate(vars[i]);
      }
    }

    window.location.href = "addBlogDB.php?blogTitle="+vars[0]+"&blogIntro="+vars[1] +"&blogDescription="+vars[2]+
    "&metaTitle="+vars[3]+"&metaDescription="+vars[4]+"&metaKeywords="+vars[5]+"&nm="+navMenu+"&fm1="+footerMenu1+"&fm2="+footerMenu2+"&sir="+showInRecent;
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

function createUser(){
   var name = document.getElementById("nameEntry").value;
   var email = document.getElementById("emailEntry").value;
   var access = document.getElementById("accessEntry");
   var accessLevel = access.options[access.selectedIndex].value;
   var username = document.getElementById("usernameEntry").value;
   var password = document.getElementById("passwordEntry").value;

   var varArray = [name, email, username, password];
   var send = true;

   for(i=0; i<varArray.length; i++){
     if(varArray[i].length > 0){
       varArray[i] = validate(varArray[i]);
     } else {
      send = false;
     }
   }

   if(send){
      window.location.href = "createUser.php?nameEntry="+varArray[0]+"&emailEntry="+varArray[1]+"&accessEntry="+accessLevel+"&usernameEntry="+varArray[2]
      +"&passwordEntry="+varArray[3];
    } else {
      alert("Please complete the form");
    }
}

function openNav() {
    var toggle = document.getElementById('menuIcon');
    var nav = document.getElementById('nav');

    if(window.innerWidth <= 900){
        if(window.innerWidth <= 900 && window.innerWidth >= 600){
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
    var nav = document.getElementById('nav');

    nav.style.width = '0%';
    toggle.setAttribute('href', 'javascript:void(0)');
    toggle.setAttribute('onClick', 'openNav()')
}
