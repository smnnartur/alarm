(function () {
    var imageUrl='images/win.gif';
    $("#hide").click(function () {
        $('.body').css('background',  'url(' + imageUrl + ')');
    });
    $("#hide").click(function () {
        $("#hide").hide();
    });
})();

function f(){
    left=Math.floor(Math.random() * 90)+"%";
    t=Math.floor(Math.random() * 40)+"%";
    document.getElementById("btn").style.paddingLeft = left;
    document.getElementById("btn").style.paddingTop = t;
}