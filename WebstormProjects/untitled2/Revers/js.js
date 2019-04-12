function f() {
        var a=document.getElementById('txt').value;
        var result = a.split("").reverse().join("");
        document.getElementById('result').innerHTML="--->"+result;
    };


