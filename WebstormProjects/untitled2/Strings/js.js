function f() {
    var firstWord = document.getElementById('firstWord').value;
    var secondWord = document.getElementById('secondWord').value;
    if(firstWord===secondWord){
        document.getElementById('res').innerHTML='--->TRUE';
    }else {
        document.getElementById('res').innerHTML='--->FALSE';
    }
}