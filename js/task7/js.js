document.getElementById('text').oninput = function f () {

    var offset=3;

    let word = document.getElementById( 'text' );
    word.innerHTML=String.fromCharCode(97);
    let str =this.value;

    let out ='';
    for(let i=0;i<str.length;i++){
        let code=str.charCodeAt(i);
        code = code + offset;
        out +=String.fromCharCode(code);
    }
    document.getElementById('out').innerText=out;
    console.log( str.charCodeAt(0));
};