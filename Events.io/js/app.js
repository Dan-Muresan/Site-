$(document).foundation()
function check_login() {
    const email = document.loginForm.email.value;
    const password = document.loginForm.password.value;

    const dotpos = email.lastIndexOf(".");
    const atpos = email.lastIndexOf("@");
    const strlen = email.length;

    if (atpos < 1 || dotpos - atpos < 2 || strlen - dotpos < 3) {
        alert('Invalid email address format');
        return false;
    }

    if(password == ""){
        alert('Password empty');
        return false;
    }

    return true;
}

function check_signin() {
    const username = document.signinForm.username.value;
    const email = document.signinForm.email.value;
    const password = document.signinForm.password.value;
   
    if(username == ""){
        alert('Username empty');
        return false;
    }

    const dotpos = email.lastIndexOf(".");
    const atpos = email.lastIndexOf("@");
    const strlen = email.length;

    if (atpos < 1 || dotpos - atpos < 2 || strlen - dotpos < 3) {
        alert('Invalid email address format');
        return false;
    }



    if(password == ""){
        alert('Password empty');
        return false;
    }

    
    return true;
}

