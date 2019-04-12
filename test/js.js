$( "form" ).submit(function( event ) {
    console.log( $( "input[name ='login']").val() );
    event.preventDefault();
});