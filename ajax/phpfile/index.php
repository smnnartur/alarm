
<input id="text" type="text" onchange="f()">
<p id="demo"></p>
<script>
   function f () {
       var xhttp = new XMLHttpRequest ();
       xhttp.onreadystatechange = function () {
           if ( this.readyState === 4 && this.status === 200 ) {
               document.getElementById("demo").innerText=xhttp.responseText;
           }
       };
       console.log("hint.php?q='"+document.getElementById("text").value+"'");
       xhttp.open("GET","hint.php?q="+document.getElementById("text").value,true);
       xhttp.send();
   }
</script>