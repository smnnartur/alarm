<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>

    </title>
    <!-- IE Edge Meta Tag -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optional Theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- Optional IE8 Support -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        table,th,td {
            border : 1px solid black;
            border-collapse: collapse;
        }
        th,td {
            padding: 5px;
        }
    </style>
</head>
<body>
<button type="button" onclick="f()">Request data</button>

<table id="demo"></table>

<script>
    // первый пример
    function loadDoc() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                myFunction(this);
            }
        };
        xhttp.open("GET", "xml.xml", true);
        xhttp.send();
    }
    function myFunction(xml) {
        var x;
        var xmlDoc = xml.responseXML;
        var table="<tr><th>Artist</th><th>Title</th></tr>";
        x = xmlDoc.getElementsByTagName("artists");
        // var len = x[0].getElementsByTagName("ARTIST")[0].childNodes[0].nodeValue;
        for (var i = 0; i < x[0].childNodes.length; i++) {
            table += "<tr><td>" +
                x[i].getElementsByTagName("ARTIST")[0].childNodes[0].nodeValue +
                "</td><td>" +
                x[i].getElementsByTagName("AGE")[0].childNodes[0].nodeValue +
                "</td></tr>";
        }
        document.getElementById("demo").innerHTML = table;
    }
</script>


<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<!-- Minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>