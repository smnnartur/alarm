document.onmousemove = function (event) {
    console.log( event.target.id );
    document.querySelector( '#offx' ).innerHTML = event.offsetX;
    document.querySelector( '#offy' ).innerHTML = event.offsetY;
    if (event.target.id != 'box') {
        document.querySelector( '#offx' ).innerHTML = 0;
        document.querySelector( '#offy' ).innerHTML = 0;
    }
};