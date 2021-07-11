function hamburger() {
    document.getElementById("closebtn").addEventListener("click", function () {
        document.getElementById("mySidenav").style.width = "0";
    });

    document.getElementById("humburger").addEventListener("click", function () {
        document.getElementById("mySidenav").style.width = "250px";
    });

}