function darkmode() {
    var myElements = document.querySelectorAll(".bg-light");

    for (var i = 0; i < myElements.length; i++) {
        myElements[i].setAttribute('style', 'background-color:#000000!important; color:#FFFFFF!important; border-color:#FFFFFF!important;');
    }
}

function lightmode() {
    var myElements = document.querySelectorAll(".bg-light");
    for (var i = 0; i < myElements.length; i++) {
        myElements[i].setAttribute('style', 'background-color:#f5f6fa!important; color:#212529!important; ');
    }
}

function woodbg() {
    myElement = document.querySelector("#outerpage");
    myElement.setAttribute('style', 'background-image: url(pictures/wood.jpg);')
}

function moderndeskbg() {
    myElement = document.querySelector("#outerpage");
    myElement.setAttribute('style', 'background-image: url(pictures/AdobeStock_66265920.jpeg);')
}

function spacebg() {
    myElement = document.querySelector("#outerpage");
    myElement.setAttribute('style', 'background-image: url(pictures/space.jpg);')
}

function woodboardsbg() {
    myElement = document.querySelector("#outerpage");
    myElement.setAttribute('style', 'background-image: url(pictures/woodboardshd.jpg);')
}