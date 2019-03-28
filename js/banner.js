let bannerStatus = 1;
let bannerTimer = 6000;
const img1 = document.getElementById("imgban1");
const img2 = document.getElementById("imgban2");
const img3 = document.getElementById("imgban3");
const mainBanner = document.getElementById("main-banner");

window.onload = function () {   /* when the page loads start the banner loop */
    bannerLoop();
}

let startBannerLoop = setInterval(function () { /* set the time of the banner loop */
    bannerLoop();
}, bannerTimer);

mainBanner.onmouseenter = function () { /* when entering the banner stop looping */
    clearInterval(startBannerLoop);
}
mainBanner.onmouseleave = function () { /* when leaving the banner start the bannerTimer */
    startBannerLoop = setInterval(function () {
        bannerLoop();
    }, bannerTimer);
}
function bannerLoop() {
    if (bannerStatus === 1) {
        img2.style.opacity = "0";   /* first executed*/
        setTimeout(function () {    /* second executed after 0.5 seconds*/
            img1.style.zIndex = "-500";
            img2.style.zIndex = "500";
            img3.style.zIndex = "-1000";
        }, 500);
        setTimeout(function () {    /* third executed after 1.0 seconds*/
            img2.style.opacity = "1";
        }, 1000);
        bannerStatus = 2;
    }
    else if (bannerStatus === 2) {
        img3.style.opacity = "0";
        setTimeout(function () {
            img2.style.zIndex = "-500";
            img3.style.zIndex = "500";
            img1.style.zIndex = "-1000";
        }, 500);
        setTimeout(function () {
            img3.style.opacity = "1";
        }, 1000);
        bannerStatus = 3;
    }
    else if (bannerStatus === 3) {
        img1.style.opacity = "0";
        setTimeout(function () {
            img3.style.zIndex = "-500";
            img1.style.zIndex = "500";
            img2.style.zIndex = "-1000";
        }, 500);
        setTimeout(function () {
            img1.style.opacity = "1";
        }, 1000);
        bannerStatus = 1;
    }
}