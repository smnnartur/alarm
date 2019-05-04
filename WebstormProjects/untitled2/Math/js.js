function f() {
    var a=parseInt(document.getElementById('first').value,);
      var  b=parseInt(document.getElementById('second').value);
       var c=parseInt(document.getElementById('third').value);
    var sum=0;
    for(var i=a+1;i<b;i++){
        if (i%c==0){continue;}
            sum+=i*i;

    }
    document.getElementById('sum').innerHTML="--->"+sum;
}
