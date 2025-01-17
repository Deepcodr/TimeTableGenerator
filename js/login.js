const emailReg= /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g
const textReg = /^[A-Za-z]+(?: [A-Za-z]+)*$/
const phoneReg = /^\d{10}$/g


function validateRegistration(){
    var fullname= document.getElementById("user-name").value;
    var phone = document.getElementById("user-phone").value;
    var email = document.getElementById("user-email").value;
    var yearselection= document.getElementById("user-year");
    var year = yearselection.options[yearselection.selectedIndex].value;
    var divisionselection = document.getElementById("user-division");
    var division = divisionselection.options[divisionselection.selectedIndex].text;
    var pass = document.getElementById("user-pass").value;
    var rpass = document.getElementById("user-repeatpass").value;

    console.log(phone);
    console.log(email);
    if(!textReg.exec(fullname))
    {
        alert("Enter a Valid Full Name");
        return false;
    }
    if(!phoneReg.exec(phone))
    {
        alert("Enter Valid Phone Number");
        return false;
    }
    if(!emailReg.exec(email))
    {
        alert("Enter A Valid Email Address");
        return false;
    }
    if(year>4 || year<=0)
    {
        alert("Year Not Valid");
        return false;
    }
    if(!(pass===rpass))
    {
        alert("Passwords does not match");
        return false;
    }
    return true;
}

function validateLogin(){
    var email = document.getElementById("inputEmail").value;
    
    if(!emailReg.exec(email))
    {
        alert("Enter Valid Username");
        return false;
    }
    else
    {
        return true;
    }
}

function hidetoast(){
    $('#successtoast').css('display','none');
    $('#dangertoast').css('display','none');
}