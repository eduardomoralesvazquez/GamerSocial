let carousel = document.querySelector(".img-container");
let scrolled = -1;
pageScroll();
function pageScroll() {
    if(scrolled < carousel.scrollTop){
        scrolled = carousel.scrollTop;
        carousel.scrollBy(0,1);
        scrolldelay = setTimeout(pageScroll,50);
    }
}