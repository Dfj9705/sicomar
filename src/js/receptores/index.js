import { Dropdown } from "bootstrap";
import { validarFormulario, Toast } from "../funciones";
import Datatable from 'datatables.net-bs5';
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { data } from "jquery";

const formReceptores = document.getElementById('formReceptores');
const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar');
const divTabla = document.getElementById('divTabla');
let tablaReceptores = new Datatable('#receptoresTabla');

btnModificar.parentElement.style.display = 'none';
btnGuardar.disabled = false;
btnModificar.disabled = true;


const guardarreceptores = async (evento) => {
    evento.preventDefault();
    let formularioValido = validarFormulario(formReceptores, ['rec_id']);
   
    if (!formularioValido) {
        Toast.fire({
            icon: 'warning',
            title: 'Debe llenar todos los campos'
        })
        return;
    }
    try {
        //Crear el cuerpo de la consulta
        const url = '/sicomar/API/receptores/guardar'

        const body = new FormData(formReceptores);
        body.delete('rec_id');
        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");

        const config = {
            method: 'POST',
            headers,
            body
        }


        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        const { mensaje, codigo, detalle } = data;
        let icon = "";
        switch (codigo) {
            case 1:
                icon = "success"
                formReceptores.reset();

                break;
            case 2:
                icon = "warning"
                formReceptores.reset();

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


        buscarreceptores()

    } catch (error) {
        console.log(error);
    }
}





const buscarreceptores = async (evento) => {
    evento && evento.preventDefault();

    try {
        const url = '/sicomar/API/receptores/buscar'
        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");

        const config = {
            method: 'GET',
            headers
        }

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        // console.log(data);


        tablaReceptores.destroy();
        let contador = 1;
        tablaReceptores = new Datatable('#receptoresTabla', {
            language: lenguaje,
            data: data,
            columns: [
                {
                    data: 'id',
                    render: () => {
                        return contador++;
                    }
                },
                { data: 'rec_desc' },
                // { data : 'situacion'},

                {
                    data: 'id',
                    'render': (data, type, row, meta) => {
                        return `<button class="btn btn-warning" onclick="asignarValores('${row.rec_id}', '${row.rec_desc}')">Modificar</button>`
                    }
                },
                {
                    data: 'id',
                    'render': (data, type, row, meta) => {
                        return `<button class="btn btn-danger" onclick="eliminarRegistro('${row.rec_id}')">Eliminar</button>`
                    }
                },
            ]
        })

    } catch (error) {
        console.log(error);
    }
}



const modificarreceptores = async (evento) => {
    evento.preventDefault();
    let formularioValido = validarFormulario(formReceptores);
    if (!formularioValido) {
        Toast.fire({
            icon: 'warning',
            title: 'Debe llenar todos los campos'
        })
        return;
    }
    try {
        //Crear el cuerpo de la consulta
        const url = '/sicomar/API/receptores/modificar'
        const body = new FormData(formReceptores);
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

        // const resultado = data.resultado;


        let icon = "";
        switch (codigo) {
            case 1:
                icon = "success"
                formReceptores.reset();

                break;
            case 2:
                icon = "warning"
                formReceptores.reset();

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


        buscarreceptores()
        btnModificar.parentElement.style.display = 'none';
        btnGuardar.parentElement.style.display = '';
        btnGuardar.disabled = false;
        btnModificar.disabled = true;
        formReceptores.reset();
        divTabla.style.display = ''

    } catch (error) {
        console.log(error);
    }
}



buscarreceptores();

window.asignarValores = (id, rec_desc) => {
    formReceptores.rec_id.value = id;
    formReceptores.rec_desc.value = rec_desc;
    btnModificar.parentElement.style.display = '';
    btnGuardar.parentElement.style.display = 'none';
    btnGuardar.disabled = true;
    btnModificar.disabled = false;
    divTabla.style.display = 'none'
}

window.eliminarRegistro = (rec_id) => {
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
            const url = '/sicomar/API/receptores/eliminar';
            const body = new FormData();
            body.append('rec_id', rec_id);
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
                formReceptores.reset;
                buscarreceptores();
                 
                   
                    break;
                case 2:
                    icon = "warning"
                   formReceptores.reset();
           
    
                    break;
                case 3:
                    icon = "error"
                   formReceptores.reset();
                    break;
                case 4:
                    icon = "error"
       
                    console.log(detalle)
                   formReceptores.reset();
                   
    
                    break;
    
                default:
                    break;
            }
         

        }
    })
}

formReceptores.addEventListener('submit', guardarreceptores);
btnModificar.addEventListener('click', modificarreceptores);

