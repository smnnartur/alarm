document.onclick = function (event) {
    // console.log( event.target.tagName );
    event = event || window.event;
    if (event.target.tagName == 'IMG') {
        event.target.classList.add( 'bordered' );
    }
};