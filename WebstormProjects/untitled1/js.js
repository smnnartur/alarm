$(function () {
    // document.getElementById('test').innerHTML=navigator.appName;
var elem=document.createElement('p');
var content=document.createTextNode('HEEY');
var id=document.getElementById('test');
elem.appendChild(content);
id.parentNode.appendChild(elem);
});