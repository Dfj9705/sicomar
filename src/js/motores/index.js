import { Dropdown } from "bootstrap";
import { validarFormulario, Toast } from "../funciones";
import Datatable from 'datatables.net-bs5';
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";

const formMotores = document.getElementById('formMotores');
const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar')
const divTabla = document.getElementById('divTabla');
let tablaMotores = new Datatable('#motoresTabla');

btnModificar.parentElement.style.display = 'none';
btnGuardar.disabled = false;
btnModificar.disabled = true;


const guardarmotores = async (evento)=>{
    evento.preventDefault();

    let formularioValido = validarFormulario(formMotores, ['id']);
    
    if (!formularioValido) {
        Toast.fire({
            icon: 'warning',
            title: 'Debe llenar todos los campos'
        })
        return;
    }



    try {
        //Crear el cuerpo de la consulta
        const url = '/sicomar/API/motores/guardar'

        const body = new FormData(formMotores);
        body.delete('id');
        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");

        const config = {
            method: 'POST',
            headers,
            body
        }

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        // console.log(data);
        
        const { mensaje, codigo, detalle } = data;
        // const resultado = data.resultado;
        let icon = "";
        switch (codigo) {
            case 1:
                icon = "success"
                formMotores.reset();
               
                break;
            case 2:
                icon = "warning"
                formMotores.reset();

                break;
            case 3:
                icon = "error"

                break;
            case 4:
                icon = "error"
                console.log(detalle)

                break;

            default:
                break;
        }

        Toast.fire({
            icon: icon,
            title: mensaje,
        })


        buscarmotores()

    } catch (error) {
        console.log(error);
    }
}





const buscarmotores = async (evento) => {
    evento && evento.preventDefault();

    try {
        const url = '/sicomar/API/motores/buscar'
        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");

        const config = {
            method : 'GET',
            headers
        }

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        // console.log(data);

        
        tablaMotores.destroy();
        let contador = 1;
        tablaMotores = new Datatable('#motoresTabla', {
            language : lenguaje,
            data : data,
            columns : [
                { 
                    data : 'mot_id',
                    render : () => {      
                        return contador++;
                    }
                },
                { data : 'mot_serie'},
                
                { 
                    data : 'id',
                    'render': (data, type, row, meta) => {
                        return `<button class="btn btn-warning" onclick="asignarValores('${row.mot_id}', '${row.mot_serie}')">Modificar</button>`
                    } 
                },
                { 
                    data : 'mot_id',
                    'render': (data, type, row, meta) => {
                        return `<button class="btn btn-danger" onclick="eliminarRegistro('${row.mot_id}')">Eliminar</button>`
                    } 
                },
                
            ]
        })

    } catch (error) {
        console.log(error);
    }
}



const modificarmotores = async (evento) => {
    evento.preventDefault();

    // let formularioValido = validarFormulario(formMotores);
    let formularioValido = validarFormulario(formMotores);
    if (!formularioValido) {
        Toast.fire({
            icon: 'warning',
            title: 'Debe llenar todos los campos'
        })
        return;
    }


    try {
        //Crear el cuerpo de la consulta
        const url = '/sicomar/API/motores/modificar'

        const body = new FormData(formMotores);
        
        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");

        const config = {
            method: 'POST',
            headers,
            body
        }

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        // console.log(data);
        const { mensaje, codigo, detalle } = data;
        // const resultado = data.resultado;

        
        let icon = "";
        switch (codigo) {
            case 1:
                icon = "success"
                formMotores.reset();

                break;
            case 2:
                icon = "warning"
                formMotores.reset();

                break;
            case 3:
                icon = "error"

                break;
            case 4:
                icon = "error"
                console.log(detalle)

                break;

            default:
                break;
        }

        Toast.fire({
            icon: icon,
            title: mensaje,
        })


        buscarmotores()
        btnModificar.parentElement.style.display = 'none';
        btnGuardar.parentElement.style.display = '';
        btnGuardar.disabled = false;
        btnModificar.disabled = true;
        formMotores.reset();
        divTabla.style.display = ''

    } catch (error) {
        console.log(error);
    }
}



buscarmotores();

window.asignarValores = (id, mot_serie) => {
    formMotores.id.value = id;
    formMotores.desc.value = mot_serie;
    btnModificar.parentElement.style.display = '';
    btnGuardar.parentElement.style.display = 'none';
    btnGuardar.disabled = true;
    btnModificar.disabled = false;
    divTabla.style.display = 'none'
}

window.eliminarRegistro = (id) => {
    Swal.fire({
        title : 'Confirmación',
        icon : 'warning',
        text : '¿Esta seguro que desea eliminar este registro?',
        showCancelButton : true,
        confirmButtonColor : '#3085d6',
        cancelButtonColor : '#d33',
        confirmButtonText: 'Si, eliminar'
    }).then( async (result) => {
        if(result.isConfirmed){
            const url = '/sicomar/API/motores/eliminar'
            const body = new FormData();
            body.append('mot_id', id);
            const headers = new Headers();
            headers.append("X-Requested-With", "fetch");
    
            const config = {
                method : 'POST',
                headers,
                body
            }
    
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            const {resultado} = data;
            // const resultado = data.resultado;
    
            if(resultado == 1){
                Toast.fire({
                    icon : 'success',
                    title : 'Registro eliminado'
                })
    
                formMotores.reset();
                buscarmotores();
            }else{
                Toast.fire({
                    icon : 'error',
                    title : 'Ocurrió un error'
                })
            }
        }
    })
}



formMotores.addEventListener('submit', guardarmotores);
btnModificar.addEventListener('click', modificarmotores);