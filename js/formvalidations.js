const emailReg = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
const textReg = /^[A-Za-z]+(?: [A-Za-z]+)*$/;
const phoneReg = /^\d{10}$/;
const prnRegex = /^\d{2}UG(CS|ET|CH|ME|CE)\d{5}$/;
const divRegex = /^[A-Z]$/;
const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,12}$/;
const batchRegex = /^[A-Z][1-9]$/;

function validateStaffRegistration(e) {
    e.preventDefault();

    var fullname = document.getElementById("user-name").value;
    var phone = document.getElementById("user-phone").value;
    var email = document.getElementById("user-email").value;
    var yearselection = document.getElementById("user-year");
    var year = yearselection.options[yearselection.selectedIndex].value;
    var divisionselection = document.getElementById("user-division");
    var division = divisionselection?.options[divisionselection.selectedIndex].text;
    var pass = document.getElementById("user-pass").value;
    var rpass = document.getElementById("user-repeatpass").value;

    if (!textReg.exec(fullname)) {
        alert("Enter a Valid Full Name");
        return false;
    }
    if (!phoneReg.exec(phone)) {
        alert("Enter Valid Phone Number");
        return false;
    }
    if (!emailReg.exec(email)) {
        alert("Enter A Valid Email Address");
        return false;
    }
    if (year > 4 || year <= 0) {
        alert("Year Not Valid");
        return false;
    }

    if (!(pass === rpass)) {
        alert("Passwords does not match");
        return false;
    }

    if (!passwordRegex.exec(pass)) {
        alert("Enter a valid password\npassword must contain following pattern\nshould have 8 to 12 characters\nmust be alphanumeric \nmust contain one uppercase , one lowercase character\nmust contain one digit \nmust contain one special symbol");
        return false;
    }

    e.target.submit();
}

function validateSubjectRegistration(e) {
    e.preventDefault();

    var subcode = document.getElementById("subject-code").value;
    var subname = document.getElementById("sub-name").value;
    var subalias = document.getElementById("sub-alias").value;
    var yearselection = document.getElementById("subject-year");
    var year = yearselection.options[yearselection.selectedIndex].value;

    if (!textReg.exec(subname)) {
        alert("Enter a valid subject name");
        return false;
    }

    if (!(subalias === subalias.toUpperCase())) {
        alert("Subject Alias should be capital");
        return false;
    }

    if (year > 4 || year <= 0) {
        alert("Year Not Valid");
        return false;
    }

    e.target.submit();
}

function validateBatchRegistration(e) {
    e.preventDefault();

    var batchname = document.getElementById("batch-name").value;
    var yearselection = document.getElementById("batch-year");
    var year = yearselection.options[yearselection.selectedIndex].value;
    var divisionselection = document.getElementById("divisionselection");
    var division = divisionselection?.options[divisionselection.selectedIndex].text;

    if (!batchRegex.exec(batchname)) {
        alert("Enter a valid Batch name");
        return false;
    }

    if (year > 4 || year <= 0) {
        alert("Year Not Valid");
        return false;
    }

    if (!divRegex.exec(division)) {
        alert("Enter a valid Division name");
        return false;
    }


    e.target.submit();
}

function validateDivisionRegistration(e) {
    e.preventDefault();

    var yearselection = document.getElementById("division-year");
    var year = yearselection.options[yearselection.selectedIndex].value;
    var division = document.getElementById("division-name").value;

    if (!divRegex.exec(division)) {
        alert("Enter a valid Division name");
        return false;
    }

    if (year > 4 || year <= 0) {
        alert("Year Not Valid");
        return false;
    }


    e.target.submit();
}