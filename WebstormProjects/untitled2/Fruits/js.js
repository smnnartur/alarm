function f() {
    var firstWord = document.getElementById('firstWord').value;

    switch (firstWord){
        case "Apple":
            document.getElementById('res').innerHTML="<img src='images/apple.png'>"; break;
        case "Banana":
            document.getElementById('res').innerHTML="<img src='images/banana.jpg'>"; break;
        case "Orange":
            document.getElementById('res').innerHTML="<img src='images/orange.jpg'>"; break;
        case "Pear":
            document.getElementById('res').innerHTML="<img src='images/pear.jpg'>"; break;
        case "Straw":
            document.getElementById('res').innerHTML="<img src='images/straw.jpg'>"; break;

        default: alert("NO SUCH FRUIT");
    }
}