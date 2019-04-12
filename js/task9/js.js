function f () {
    var kv = document.getElementById( 'kv' ).value;
    if (kv >= 1 && kv <= 20) {
        alert( 'первый этаж' );
    } else if (kv > 20 && kv <= 40) {
        alert( 'второй этаж' );
    } else if (kv > 40 && kv <= 60) {
        alert( 'третий этаж' );
    }
}