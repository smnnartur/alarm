$( "#submit" ).click( function () {
    $( "form" ).attr( 'action' , 'success.php' )
               .attr( 'method' , 'post' );
} );

$( "form" ).validate( {
    rules : {
        login : {
            required : true ,
            minlength : 6 ,
            maxlength : 32 ,
        } ,
        pass : {
            required : true ,
            minlength : 6 ,
            maxlength : 32 ,
        } ,
    } ,
    messages : {
        login : {
            required : 'Введите логин' ,
            minlength : 'Логин должен быть не менее 6 символов' ,
            maxlength : 'логин должен быть не более 32 символов' ,
        } ,
        pass : {
            required : 'Введите пароль' ,
            minlength : 'Пароль должен быть не менее 6 символов' ,
            maxlength : 'Пароль должен быть не более 32 символов' ,
        } ,
    }
} );
