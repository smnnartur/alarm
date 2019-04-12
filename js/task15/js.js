function f () {
    var arr = [1,2,3,4,5];
    var sum=0;
    arr.forEach(function (item) {
        sum+=item;
    });
    document.getElementById('sum').innerText=sum;

}
f();