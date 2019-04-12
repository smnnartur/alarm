<form action="">
    <select name="customers" onchange="f(this.value)">
        <option value="">Select a customer:</option>
        <option value="1">First</option>
        <option value="2">Second</option>
        <option value="3">Third</option>
    </select>
</form>
<p id="demo"></p>
<script>
    function f (value) {
        var xhttp = new XMLHttpRequest ();
        xhttp.onreadystatechange = function () {
            if ( this.readyState === 4 && this.status === 200 ) {
                document.getElementById("demo").innerText=xhttp.responseText;
            }
        };
        console.log("conn.php?value="+value);
        xhttp.open("GET","conn.php?value="+value,true);
        xhttp.send();
    }
</script>