koszykObj = document.querySelector(".koszyk")
if (koszykObj.style.display == "flex") {
    koszykOtwarty = true
}
else {
    koszykOtwarty = false
}

function KoszykClick() {
    koszykObj = document.querySelector(".koszyk")
    if (koszykOtwarty == false) {
        koszykObj.style.display = "flex"
        koszykOtwarty = true
    }
    else {
        koszykObj.style.display = "none"
        koszykOtwarty = false
    }
}