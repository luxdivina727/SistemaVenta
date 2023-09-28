//#region  Login
function frmLogin(e) {
    e.preventDefault();
    const usuario=document.getElementById("inputUsuario");
    const clave=document.getElementById("inputClave");
    if (usuario.value=="") {
        clave.classList.remove("is-invalid");
        usuario.classList.add("is-invalid");
        usuario.focus();
    }else if (clave.value=="") {
        usuario.classList.remove("is-invalid");
        clave.classList.add("is-invalid");
        clave.focus();
    }else{
        const url=base_url+"Usuarios/validar";
        const form=document.getElementById("formLogin");
        const http=new XMLHttpRequest();
        http.open("POST", url,true);
        http.send(new FormData(form));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                 const res = JSON.parse(this.responseText);
                 if(res == "ok"){
                    window.location = base_url + "Usuarios";
                }else{
                    document.getElementById("alerta").classList.remove("d-none");
                    document.getElementById("alerta").innerHTML=res;
                }
            }
        }
    }
}
//#endregion