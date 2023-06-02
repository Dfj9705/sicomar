import { Dropdown } from "bootstrap";
import { validarFormulario, Toast } from "../funciones";
import Datatable from 'datatables.net-bs5';
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { data, post } from "jquery";

const formTipo = document.getElementById('formTipo');
const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar');
const divTabla = document.getElementById('divTabla');
let tablaTipo = new Datatable('#tipoTabla');

btnModificar.parentElement.style.display = 'none';
btnGuardar.disabled = false;
btnModificar.disabled = true;



const guardartipo = async (evento) => {
    evento.preventDefault();
    let formularioValido = validarFormulario(formTipo, ['tipo_id']);
   
    if (!formularioValido) {
        Toast.fire({
            icon: 'warning',
            title: 'Debe llenar todos los campos'
        })
        return;
    }
    try {
        //Crear el cuerpo de la consulta
        const url = '/sicomar/API/tipo/guardar'

        const body = new FormData(formTipo);
        body.delete('tipo_id');
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
                formTipo.reset();

                break;
            case 2:
                icon = "warning"
                formTipo.reset();

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


        buscartipo()

    } catch (error) {
        console.log(error);
    }
}





const buscartipo = async (evento) => {
    evento && evento.preventDefault();

    try {
        const url = '/sicomar/API/tipo/buscar'
        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");

        const config = {
            method: 'GET',
            headers
        }

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        // console.log(data);


        tablaTipo.destroy();
        let contador = 1;
        tablaTipo = new Datatable('#tipoTabla', {
            language: lenguaje,
            data: data,
            columns: [
                {
                    data: 'id',
                    render: () => {
                        return contador++;
                    }
                },
                { data: 'tipo_desc' },
                // { data : 'situacion'},

                {
                    data: 'id',
                    'render': (data, type, row, meta) => {
                        return `<button class="btn btn-warning" onclick="asignarValores('${row.tipo_id}', '${row.tipo_desc}')">Modificar</button>`
                    }
                },
                {
                    data: 'id',
                    'render': (data, type, row, meta) => {
                        return `<button class="btn btn-danger" onclick="eliminarRegistro('${row.tipo_id}')">Eliminar</button>`
                    }
                },
            ]
        })

    } catch (error) {
        console.log(error);
    }
}



const modificartipo = async (evento) => {
    evento.preventDefault();
    let formularioValido = validarFormulario(formTipo);
    if (!formularioValido) {
        Toast.fire({
            icon: 'warning',
            title: 'Debe llenar todos los campos'
        })
        return;
    }
    try {
        //Crear el cuerpo de la consulta
        const url = '/sicomar/API/tipo/modificar'
        const body = new FormData(formTipo);
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

        console.log(data);
        // const resultado = data.resultado;


        let icon = "";
        switch (codigo) {
            case 1:
                icon = "success"
                formTipo.reset();

                break;
            case 2:
                icon = "warning"
                formTipo.reset();

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


        buscartipo()
        btnModificar.parentElement.style.display = 'none';
        btnGuardar.parentElement.style.display = '';
        btnGuardar.disabled = false;
        btnModificar.disabled = true;
        formTipo.reset();


        divTabla.style.display = ''

    } catch (error) {
        console.log(error);
    }
}



buscartipo();
window.asignarValores = (tipo_id, tipo_desc) => {
    formTipo.tipo_id.value = tipo_id;
    formTipo.tipo_desc.value = tipo_desc;
    btnModificar.parentElement.style.display = '';
    btnGuardar.parentElement.style.display = 'none';
    btnGuardar.disabled = true;
    btnModificar.disabled = false;
    divTabla.style.display = 'none'
}

window.eliminarRegistro = (tipo_id) => {
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
            const url = '/sicomar/API/tipo/eliminar';
            const body = new FormData();
            body.append('tipo_id', tipo_id);
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
            console.log(data);

            // const resultado = data.resultado;
            let icon = "";
            switch (codigo) {
                case 1:
                    Toast.fire({
                        icon : 'success',
                        title : 'Registro eliminado'
                    })
                formTipo.reset;
                buscartipo();
                 
                   
                    break;
                case 2:
                    icon = "warning"
                   formTipo.reset();
           
    
                    break;
                case 3:
                    icon = "error"
                   formTipo.reset();
                    break;
                case 4:
                    icon = "error"
       
                    console.log(detalle)
                   formTipo.reset();
                   
    
                    break;
    
                default:
                    break;
            }
         

        }
    })
}


formTipo.addEventListener('submit', guardartipo);
btnModificar.addEventListener('click', modificartipo);
