
document.querySelectorAll('input[type="checkbox"]').forEach(c => c.checked = false);
document.querySelector("#maj-dropdown").value = "none";
document.querySelector("#countrycode").value = "";
document.querySelector("#mbasis").value = "";

function scrollDown() {
    document.querySelector('#body').scrollIntoView({
        behavior: 'smooth'
    });
}

function validateEmail(email) {
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return emailPattern.test(email);
}

function validatePhoneNumber(number) {
    var re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;

    return re.test(number);
}

function validator() {
    console.log("VALIDATING")
    let notValid = [],
        ret = false;
    if (!Array.prototype.slice.call(document.querySelectorAll('input[type="checkbox"]')).some(x => x.checked)) {
        notValid.unshift("Select at least one wallet you use");
        document.querySelector("#cw").style.color = "red";
    } else {
        document.querySelector("#cw").style.color = "black";
    }
    if (!validateEmail(document.querySelector("#email").value)) {
        notValid.unshift("Email is not valid");
        document.querySelector("#email").style.borderColor = "red";
    } else {
        document.querySelector("#email").style.borderColor = "#ccc";
    }
    if (!validatePhoneNumber(document.querySelector("#countrycode").value + document.querySelector("#phone").value)) {
        notValid.unshift("Phone number is not valid");
        document.querySelector("#phone").style.borderColor = "red";
        document.querySelector("#countrycode").style.borderColor = "red";
    } else {
        document.querySelector("#phone").style.borderColor = "#ccc";
        document.querySelector("#countrycode").style.borderColor = "#ccc";
    }
    if (document.querySelector("#maj-dropdown").value == "none") {
        notValid.unshift("Select the wallet that has majority of your cryptocurrency?");
        document.querySelector("#maj-dropdown").style.borderColor = "red";
    } else {
        document.querySelector("#maj-dropdown").style.borderColor = "#ccc";
    }
    if (document.querySelector("#mbasis").value.search(/^\$?\d+(,\d{3})*(\.\d*)?$/) >= 0) {
        document.querySelector("#mbasis").style.borderColor = "#ccc";
    } else {
        notValid.unshift("Please write the required");
        document.querySelector("#mbasis").style.borderColor = "red";
    }
    if (notValid.length > 0) {
        ret = false;
    } else {
        ret = true;
    }
    return ret;
}
document.querySelector("#another-wallet").checked == "false";
document.querySelector("#another-wallet").addEventListener('change', function (event) {
    let seField = document.querySelector("#se");
    let majOther = document.querySelector("#maj-se");
    if (event.target.checked) {
        se.style.display = "block";
        majOther.style.display = "block";
    } else {
        se.style.display = "none";
        majOther.style.display = "none";
        se.value = "";
        document.querySelector("#se").innerHTML = "Something else"
        if (document.querySelector("#maj-dropdown").value == "se") {
            document.querySelector("#maj-dropdown").value = "none";
        }
    }
});
document.querySelector("#se").onchange = function (event) {
    let majOther = document.querySelector("#maj-se");
    majOther.innerHTML = document.querySelector("#se").value;
};
document.querySelector("#mbasis").onchange = function (event) {
    let m = document.querySelector("#mbasis");
    let w_value = m.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
    m.value = `$${w_value.replace(/[\$\xA2-\xA5\u058F\u060B\u09F2\u09F3\u09FB\u0AF1\u0BF9\u0E3F\u17DB\u20A0-\u20BD\uA838\uFDFC\uFE69\uFF04\uFFE0\uFFE1\uFFE5\uFFE6]/g,"")}`;
};
document.querySelector("#mbasis").onclick = document.querySelector("#mbasis").onchange
document.querySelector("#countrycode").onchange = function (event) {
    let cc = document.querySelector("#countrycode");
    cc.value = `+${cc.value.replace(/\+/g,"")}`;
};
document.querySelector("#countrycode").onclick = document.querySelector("#countrycode").onchange
document.addEventListener('scroll', function (e) {
    let header = document.getElementsByClassName("header-bg")[0],
        bodyRect = document.body.getBoundingClientRect(),
        headerRect = header.getBoundingClientRect();
    headerHeight = Math.abs(headerRect.bottom - headerRect.top);
    headerVisible = headerHeight + headerRect.top;
    header.style.filter = `grayscale(${1-(headerVisible/headerHeight)})`;
    console.log(window.getComputedStyle(header).marginTop);
    header.style.backgroundPosition =
        `center ${((headerHeight-headerVisible)/2)+0.5*parseFloat(window.getComputedStyle(header).marginTop)}px`;
});
