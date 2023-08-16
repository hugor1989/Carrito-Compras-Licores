// funcion para mostrar u ocultar el password en index
function verpass(){
    var password = document.querySelector('#password');
    if ( password.type === "text" ) {
        password.type="password"
        $('#iconpassword').removeClass('fas fa-lock');
        $('#iconpassword').toggleClass('fas fa-unlock');
        } else {
        password.type="text" 
        $('#iconpassword').removeClass('fas fa-unlock');
        $('#iconpassword').toggleClass('fas fa-lock');
        }
    }
    