function forgot_password() {
    window.location.href = "../forgot_password/forgot_password.html";
}
// email-> [word or .] @ [letter or digit] . [letter]
var email_regex = /^[\w|.]+@[a-zA-Z|\b]+\.[a-zA-Z]{2,4}$/;

// password-> [word or some symbols]
var password_regex = /^[\w||@|#|%|*]{6,}$/;

function validate_credentials(email, password, name="aa") {
    if (name == "") {
        alert("Name cannot be empty");
        return false;
    }
    
    if (email == "") {
        alert("Email cannot be empty");
        return false;
    } else if (!email_regex.test(email)) {
        alert("Invalid email");
        return false;
    }

    if (password == "") {
        alert("Password cannot be empty");
        return false;
    } else if (!password_regex.test(password)) {
        alert("Invalid password");
        return false;
    }

    return true;
}
