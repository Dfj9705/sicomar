import { Dropdown } from "bootstrap";
import { validarFormulario, Toast } from "../funciones";
import Datatable from 'datatables.net-bs5';
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { data, post } from "jquery";

const formMedio = document.getElementById('formMedio');
const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar');
const divTabla = document.getElementById('divTabla');
let tablaMedios = new Datatable('#medioTabla');

btnModificar.parentElement.style.display = 'none';
btnGuardar.disabled = false;
btnModificar.disabled = true;

const guardarmedio = async (evento) => {
    evento.preventDefault();
    let formularioValido = validarFormulario(formMedio, ['medio_id']);
   
    if (!formularioValido) {
        Toast.fire({
            icon: 'warning',
            title: 'Debe llenar todos los campos'
        })
        return;
    }
    try {
        //Crear el cuerpo de la consulta
        const url = '/sicomar/API/medio/guardar'

        const body = new FormData(formMedio);
        body.delete('medio_id');
        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");

        const config = {
            method: 'POST',
            headers,
            body
        }
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data);
        const { mensaje, codigo, detalle } = data;
        let icon = "";
        switch (codigo) {
            case 1:
                icon = "success"
                formMedio.reset();

                break;
            case 2:
                icon = "warning"
                formMedio.reset();

                break;
            case 3:
                icon = "error"

                break;
            case 4:
                icon = "error"
                // console.log(data)
                console.log(detalle)


                break;

            default:
                break;
        }

        Toast.fire({
            icon: icon,
            title: mensaje,
        })


        buscarmedio()

    } catch (error) {
        console.log(error);
    }
}
const buscarmedio = async (evento) => {
    evento && evento.preventDefault();

    try {
        const url = '/sicomar/API/medio/buscar'
        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");

        const config = {
            method : 'GET',
            headers
        }

        const respuesta = await fetch(url, config);
        console.log(respuesta);
        const data = await respuesta.json();

        // console.log(data);

        
        tablaMedios.destroy();
        let contador = 1;
        tablaMedios = new Datatable('#medioTabla', {
            language : lenguaje,
            data : data,
            columns : [
                { 
                    data : 'medio_id',
                    render : () => {      
                        return contador++;
                    }
                },
                { data : 'medio_desc'},
                // { data : 'medio_situacion'},
                
                { 
                    data : 'id',
                    'render': (data, type, row, meta) => {
                        return `<button class="btn btn-warning" onclick="asignarValores('${row.medio_id}', '${row.medio_desc}')">Modificar</button>`
                    } 
                },
                { 
                    data : 'id',
                    'render': (data, type, row, meta) => {
                        return `<button class="btn btn-danger" onclick="eliminarRegistro('${row.medio_id}')">Eliminar</button>`
                    } 
                },
            ]
        })

    } catch (error) {
        console.log(error);
    }
}
const modificarmedio = async (evento) => {
    evento.preventDefault();

    let formularioValido = validarFormulario(formMedio);
    if (!formularioValido) {
        Toast.fire({
            icon: 'warning',
            title: 'Debe llenar todos los campos'
        })
        return;
    }

    try {
        //Crear el cuerpo de la consulta
        const url = '/sicomar/API/medio/modificar'

        const body = new FormData(formMedio);
        
        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");

        const config = {
            method: 'POST',
            headers,
            body
        }

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data);
        const { mensaje, codigo, detalle } = data;
    

        
        let icon = "";
        switch (codigo) {
            case 1:
                icon = "success"
                formMedio.reset();

                break;
            case 2:
                icon = "warning"
                formMedio.reset();

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


        buscarmedio()
        btnModificar.parentElement.style.display = 'none';
        btnGuardar.parentElement.style.display = '';
        btnGuardar.disabled = false;
        btnModificar.disabled = true;
        formMedio.reset();
        divTabla.style.display = ''

    } catch (error) {
        console.log(error);
    }
}
buscarmedio();

window.asignarValores = (id, medio_desc) => {
    formMedio.medio_id.value = id;
    formMedio.medio_desc.value = medio_desc;
    btnModificar.parentElement.style.display = '';
    btnGuardar.parentElement.style.display = 'none';
    btnGuardar.disabled = true;
    btnModificar.disabled = false;
    divTabla.style.display = ''
}

window.eliminarRegistro = (medio_id) => {
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
            const url = '/sicomar/API/medio/eliminar';
            const body = new FormData();
            body.append('medio_id', medio_id);
            const headers = new Headers();
            headers.append("X-Requested-With", "fetch");
    
            const config = {
                method : 'POST',
                headers,
                body
            }
    
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            const { mensaje, codigo, detalle } = data;

            // const resultado = data.resultado;
            let icon = "";
            switch (codigo) {
                case 1:
                    Toast.fire({
                        icon : 'success',
                        title : 'Registro eliminado'
                    })
                formMedio.reset;
                buscarmedio();
                 
                   
                    break;
                case 2:
                    icon = "warning"
                   formMedio.reset();
           
    
                    break;
                case 3:
                    icon = "error"
                   formMedio.reset();
                    break;
                case 4:
                    icon = "error"
       
                    console.log(detalle)
                   formMedio.reset();
                   
    
                    break;
    
                default:
                    break;
            }
         

        }
    })
}


formMedio.addEventListener('submit', guardarmedio);
btnModificar.addEventListener('click', modificarmedio);
