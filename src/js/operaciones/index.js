import { Dropdown } from "bootstrap";
import { validarFormulario, Toast } from "../funciones";
import Datatable from 'datatables.net-bs5';
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { data, post } from "jquery";

const formOperaciones = document.getElementById('formOperaciones');
const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar');
const divTabla = document.getElementById('divTabla');
let tablaOperaciones = new Datatable('#operacionesTabla');

btnModificar.parentElement.style.display = 'none';
btnGuardar.disabled = false;
btnModificar.disabled = true;


const guardaroperaciones = async (evento) => {
    evento.preventDefault();
    let formularioValido = validarFormulario(formOperaciones, ['tipo_id']);

    if (!formularioValido) {
        Toast.fire({
            icon: 'warning',
            title: 'Debe llenar todos los campos'
        })
        return;
    }
    try {
        //Crear el cuerpo de la consulta
        const url = '/sicomar/API/operaciones/guardar'

        const body = new FormData(formOperaciones);
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
                formOperaciones.reset();

                break;
            case 2:
                icon = "warning"
                formOperaciones.reset();

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


        buscaroperaciones()

    } catch (error) {
        console.log(error);
    }
}





const buscaroperaciones = async (evento) => {
    evento && evento.preventDefault();

    try {
        const url = '/sicomar/API/operaciones/buscar'
        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");

        const config = {
            method: 'GET',
            headers
        }

        const respuesta = await fetch(url, config);
        // respuesta.text();

        const data = await respuesta.text();

        console.log(data);


        tablaOperaciones.destroy();
        let contador = 1;
        tablaOperaciones = new Datatable('#operacionesTabla', {
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



const modificaroperaciones = async (evento) => {
    evento.preventDefault();
    let formularioValido = validarFormulario(formOperaciones);
    if (!formularioValido) {
        Toast.fire({
            icon: 'warning',
            title: 'Debe llenar todos los campos'
        })
        return;
    }
    try {
        //Crear el cuerpo de la consulta
        const url = '/sicomar/API/operaciones/modificar'
        const body = new FormData(formOperaciones);
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
                formOperaciones.reset();

                break;
            case 2:
                icon = "warning"
                formOperaciones.reset();

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


        buscaroperaciones()
        btnModificar.parentElement.style.display = 'none';
        btnGuardar.parentElement.style.display = '';
        btnGuardar.disabled = false;
        btnModificar.disabled = true;
        formOperaciones.reset();


        divTabla.style.display = ''

    } catch (error) {
        console.log(error);
    }
}



buscaroperaciones();

window.asignarValores = (id, tipo_desc) => {
    formOperaciones.tipo_id.value = id;
    formOperaciones.tipo_desc.value = tipo_desc;
    btnModificar.parentElement.style.display = '';
    btnGuardar.parentElement.style.display = 'none';
    btnGuardar.disabled = true;
    btnModificar.disabled = false;
    divTabla.style.display = 'none'
}

window.eliminarRegistro = (tipo_id) => {
    Swal.fire({
        title: 'Confirmación',
        icon: 'warning',
        text: '¿Esta seguro que desea eliminar este registro?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar'
    }).then(async (result) => {
        if (result.isConfirmed) {
            const url = '/sicomar/API/operaciones/eliminar'
            const body = new FormData();
            body.append('tipo_id', tipo_id);
            const headers = new Headers();
            headers.append("X-Requested-With", "fetch");

            const config = {
                method: 'POST',
                headers,
                body
            }
            const respuesta = await fetch(url, config);
            const data = await respuesta.text();
            const { resultado } = data;
            if (resultado == 1) {
                Toast.fire({
                    icon: 'success',
                    title: 'Registro eliminado'
                })

                formOperaciones.reset();
                buscaroperaciones();
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Ocurrió un error'
                })
            }
        }
    })
}

formOperaciones.addEventListener('submit', guardaroperaciones);
btnModificar.addEventListener('click', modificaroperaciones);

