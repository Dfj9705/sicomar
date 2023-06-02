import { Dropdown } from "bootstrap";
import { validarFormulario, Toast } from "../funciones";
import Datatable from 'datatables.net-bs5';
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { data, post } from "jquery";

const formMedidas = document.getElementById('formMedidas');
const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar');
const divTabla = document.getElementById('divTabla');
let tablaMedida = new Datatable('#medidasTabla');

btnModificar.parentElement.style.display = 'none';
btnGuardar.disabled = false;
btnModificar.disabled = true;

const guardarmedida = async (evento) => {
    evento.preventDefault();
    let formularioValido = validarFormulario(formMedidas, ['uni_id']);
   
    if (!formularioValido) {
        Toast.fire({
            icon: 'warning',
            title: 'Debe llenar todos los campos'
        })
        return;
    }
    try {
        //Crear el cuerpo de la consulta
        const url = '/sicomar/API/unidadmedida/guardar'
        const body = new FormData(formMedidas);
        body.delete('uni_id');
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
        let icon = "";
        switch (codigo) {
            case 1:
                icon = "success"
                formMedidas.reset();

                break;
            case 2:
                icon = "warning"
                formMedidas.reset();

                break;
            case 3:
                icon = "error"

                break;
            case 4:
                icon = "error"
                console.log(detalle)


                break;

            default:
                icon = 'info'
                break;
        }

        Toast.fire({
            icon: icon,
            title: mensaje,
        })


        buscarreceptores()

    } catch (error) {
        console.log(error);
    }
}
const buscarmedida = async (evento) => {
    evento && evento.preventDefault();

    try {
        const url = '/sicomar/API/unidadmedida/buscar'
        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");

        const config = {
            method : 'GET',
            headers
        }

        const respuesta = await fetch(url, config);
        // console.log(respuesta.text);
        const data = await respuesta.json();

        // console.log(data);

        
        tablaMedida.destroy();
        let contador = 1;
        tablaMedida = new Datatable('#medidasTabla', {
            language : lenguaje,
            data : data,
            columns : [
                { 
                    data : 'id',
                    render : () => {      
                        return contador++;
                    }
                },
                { data : 'uni_desc'},
                // { data : 'situacion'},
                
                { 
                    data : 'id',
                    'render': (data, type, row, meta) => {
                        return `<button class="btn btn-warning" onclick="asignarValores('${row.uni_id}', '${row.uni_desc}')">Modificar</button>`
                    } 
                },
                { 
                    data : 'id',
                    'render': (data, type, row, meta) => {
                        return `<button class="btn btn-danger" onclick="eliminarRegistro('${row.uni_id}')">Eliminar</button>`
                    } 
                },
            ]
        })

    } catch (error) {
        console.log(error);
    }
}
const modificarmedida = async (evento) => {
    evento.preventDefault();

    let formularioValido = validarFormulario(formMedidas);
    if (!formularioValido) {
        Toast.fire({
            icon: 'warning',
            title: 'Debe llenar todos los campos'
        })
        return;
    }

    try {
        //Crear el cuerpo de la consulta
        const url = '/sicomar/API/unidadmedida/modificar'

        const body = new FormData(formMedidas);
        
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
    

        
        let icon = "";
        switch (codigo) {
            case 1:
                icon = "success"
                formMedidas.reset();

                break;
            case 2:
                icon = "warning"
                formMedidas.reset();

                break;
            case 3:
                icon = "error"

                break;
            case 4:
                icon = "error"
                console.log(detalle)

                break;

            default:
                icon = 'info'
                break;
        }

        Toast.fire({
            icon: icon,
            title: mensaje,
        })


        buscarmedida()
        btnModificar.parentElement.style.display = 'none';
        btnGuardar.parentElement.style.display = '';
        btnGuardar.disabled = false;
        btnModificar.disabled = true;
        formMedidas.reset();
        divTabla.style.display = ''

    } catch (error) {
        console.log(error);
    }
}
buscarmedida();

window.asignarValores = (uni_id, uni_desc) => {
    formMedidas.uni_id.value = uni_id;
    formMedidas.uni_desc.value = uni_desc;
    btnModificar.parentElement.style.display = '';
    btnGuardar.parentElement.style.display = 'none';
    btnGuardar.disabled = true;
    btnModificar.disabled = false;
    divTabla.style.display = 'none'
}

window.eliminarRegistro = (uni_id) => {
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
            const url = '/sicomar/API/unidadmedida/eliminar';
            const body = new FormData();
            body.append('uni_id', uni_id);
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
                formMedidas.reset;
                buscarmedida();
                 
                   
                    break;
                case 2:
                    icon = "warning"
                   formMedidas.reset();
           
    
                    break;
                case 3:
                    icon = "error"
                   formMedidas.reset();
                    break;
                case 4:
                    icon = "error"
       
                    console.log(detalle)
                   formMedidas.reset();
                   
    
                    break;
    
                default:
                    break;
            }
         

        }
    })
}


formMedidas.addEventListener('submit', guardarmedida);
btnModificar.addEventListener('click', modificarmedida);
