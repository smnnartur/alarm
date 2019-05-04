function startTime() {
    var weekday = new Array("sunday", "monday", "tuesday", "wednesday",
        "thursday", "friday", "saturday");
    var date = new Date();
    var yaer=date.getFullYear();
    var month=date.getMonth()+1;
    var day=date.getDate();
    var week=weekday[date.getDay()];
    var h=date.getHours();
    var m=date.getMinutes();
    var s=date.getSeconds();

    // Time
    m=checkTime(m);
    s=checkTime(s);
    month=checkDate(month);
    day=checkDate(day);

    document.getElementById('hour').innerHTML=h;
    document.getElementById('min').innerHTML=m;
    document.getElementById('sec').innerHTML=s;
    t=setTimeout('startTime()',500);

    function checkTime(i) {
        if(i<10){
            i="0"+i;
        }
        return i;
    }

    function checkDate(j){
        if(j<10){
            j="0"+j;
        }
        return j;
    }
    // Date
    document.getElementById('yaer').innerHTML=yaer;
    document.getElementById('month').innerHTML=month;
    document.getElementById('day').innerHTML=day+" -";
    document.getElementById('week').innerHTML=week;
}