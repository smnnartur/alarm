function userProgress(time) {
    var start = 0;
    var progressElement = document.getElementById('user-progress');
    var time = Math.round(time*1000/100);
    var intreval = setInterval(function () {

        if(progressElement.value >= 100){
            clearInterval(intreval);
            callback()
        }
        progressElement.value = start;
        start++;
    },time);
}
function callback(){
    document.getElementById('hide').style.display='block';
}
userProgress(1);