var op = true;

function toggleNav() {
    if (op) closeNav();
    else openNav();
}
/* Set the width of the side navigation to 250px */
function openNav() {
    document.getElementById("side").style.width = "270px";
    op = true;
    document.getElementById("main").style.marginLeft = "270px";
}
/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("side").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
    op = false;
}

function openPage(pageName, elmnt, color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("sales");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
        tablinks[i].style.color = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;
    elmnt.style.color = 'white';
}