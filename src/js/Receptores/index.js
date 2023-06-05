// import { Dropdown } from "bootstrap";
// import { validarFormulario, Toast } from "../funciones";
// import Datatable from 'datatables.net-bs5';
// import { lenguaje } from "../lenguaje";
// import Swal from "sweetalert2";

// const formReceptores = document.getElementById('formReceptores');
// const btnGuardar = document.getElementById('btnGuardar');
// const btnModificar = document.getElementById('btnModificar');
// const divTabla = document.getElementById('divTabla');
// let tablaProductos = new Datatable('#ReceptoresTabla');

// btnModificar.parentElement.style.display = 'none';
// btnGuardar.disabled = false;
// btnModificar.disabled = true;





// function guardarReceptores() {
//     const insumo = new ReceptoresController(
//       document.querySelector('#insumo').value.trim().toUpperCase(),
//       document.querySelector('#medida').value.trim(),
//       document.querySelector('#color').value.trim()
//     );
  
//     const controlador = new ReceptoresController();
//     controlador.guardarReceptores(insumo)
//       .then((mensaje) => {
//         alertToast('success', mensaje);
//         document.querySelector('#formulario').reset();
//         removerValidaciones(document.querySelector('#formulario'));
//         buscarReceptores();
//       })
//       .catch((mensaje) => {
//         alertToast('error', mensaje);
//       });
//   }

// // const guardarReceptores = async (evento) => {
// //     evento.preventDefault();

// //     let formularioValido = validarFormulario(formReceptores, ['id']);
// //     if (!formularioValido) {
// //         Toast.fire({
// //             icon: 'warning',
// //             title: 'Debe llenar todos los campos'
// //         })
// //         return;
// //     }



// //     try {
// //         //Crear el cuerpo de la consulta
// //         const url = '/sicomar/API/Receptores/guardar'

// //         const body = new FormData(formReceptores);
// //         body.delete('id');
// //         const headers = new Headers();
// //         headers.append("X-Requested-With", "fetch");

// //         const config = {
// //             method: 'POST',
// //             headers,
// //             body
// //         }

// //         const respuesta = await fetch(url, config);
// //         const data = await respuesta.json();
// //         console.log(data);
// //         const { mensaje, codigo, detalle } = data;
// //         // const resultado = data.resultado;
// //         let icon = "";
// //         switch (codigo) {
// //             case 1:
// //                 icon = "success"
// //                 formReceptores.reset();
               
// //                 break;
// //             case 2:
// //                 icon = "warning"
// //                 formReceptores.reset();

// //                 break;
// //             case 3:
// //                 icon = "error"

// //                 break;
// //             case 4:
// //                 icon = "error"
// //                 console.log(detalle)

// //                 break;

// //             default:
// //                 break;
// //         }

// //         Toast.fire({
// //             icon: icon,
// //             title: mensaje,
// //         })


// //         buscarReceptores()

// //     } catch (error) {
// //         console.log(error);
// //     }
// // }





// const buscarReceptores = async (evento) => {
//     evento && evento.preventDefault();

//     try {
//         const url = '/sicomar/API/Receptores/buscar'
//         const headers = new Headers();
//         headers.append("X-Requested-With", "fetch");

//         const config = {
//             method : 'GET',
//         }

//         const respuesta = await fetch(url, config);
//         const data = await respuesta.json();

//         // console.log(data);

        
//         tablaProductos.destroy();
//         let contador = 1;
//         tablaProductos = new Datatable('#ReceptoresTabla', {
//             language : lenguaje,
//             data : data,
//             columns : [
//                 { 
//                     data : 'id',
//                     render : () => {      
//                         return contador++;
//                     }
//                 },
//                 { data : 'desc'},
                
//                 { 
//                     data : 'id',
//                     'render': (data, type, row, meta) => {
//                         return `<button class="btn btn-warning" onclick="asignarValores('${row.id}', '${row.desc}')">Modificar</button>`
//                     } 
//                 },
//                 { 
//                     data : 'id',
//                     'render': (data, type, row, meta) => {
//                         return `<button class="btn btn-danger" onclick="eliminarRegistro('${row.id}')">Eliminar</button>`
//                     } 
//                 },
//             ]
//         })

//     } catch (error) {
//         console.log(error);
//     }
// }



// const modificarReceptores = async (evento) => {
//     evento.preventDefault();

//     let formularioValido = validarFormulario(formReceptores);
//     if (!formularioValido) {
//         Toast.fire({
//             icon: 'warning',
//             title: 'Debe llenar todos los campos'
//         })
//         return;
//     }



//     try {
//         //Crear el cuerpo de la consulta
//         const url = '/sicomar/API/Receptores/modificar'

//         const body = new FormData(formReceptores);
        
//         const headers = new Headers();
//         headers.append("X-Requested-With", "fetch");

//         const config = {
//             method: 'POST',
//             headers,
//             body
//         }

//         const respuesta = await fetch(url, config);
//         const data = await respuesta.json();
//         console.log(data);
//         const { mensaje, codigo, detalle } = data;
//         // const resultado = data.resultado;
//         let icon = "";
//         switch (codigo) {
//             case 1:
//                 icon = "success"
//                 formReceptores.reset();
               
//                 break;
//             case 2:
//                 icon = "warning"
//                 formReceptores.reset();

//                 break;
//             case 3:
//                 icon = "error"

//                 break;
//             case 4:
//                 icon = "error"
//                 console.log(detalle)

//                 break;

//             default:
//                 break;
//         }

//         Toast.fire({
//             icon: icon,
//             title: mensaje,
//         })


//         buscarReceptores()
//         formReceptores.reset();
//             btnModificar.parentElement.style.display = 'none';
//             btnGuardar.parentElement.style.display = '';
//             btnGuardar.disabled = false;
//             btnModificar.disabled = true;
        
//             divTabla.style.display = ''

//     } catch (error) {
//         console.log(error);
//     }
// }



// buscarReceptores();

// window.asignarValores = (id, desc) => {
//     formReceptores.id.value = id;
//     formReceptores.desc.value = desc;
//     btnModificar.parentElement.style.display = '';
//     btnGuardar.parentElement.style.display = 'none';
//     btnGuardar.disabled = true;
//     btnModificar.disabled = false;

//     divTabla.style.display = 'none'
// }

// window.eliminarRegistro = (id) => {
//     Swal.fire({
//         title : 'Confirmación',
//         icon : 'warning',
//         text : '¿Esta seguro que desea eliminar este registro?',
//         showCancelButton : true,
//         confirmButtonColor : '#3085d6',
//         cancelButtonColor : '#d33',
//         confirmButtonText: 'Si, eliminar'
//     }).then( async (result) => {
//         if(result.isConfirmed){
//             const url = '/sicomar/API/Receptores/eliminar'
//             const body = new FormData();
//             body.append('id', id);
//             const headers = new Headers();
//             headers.append("X-Requested-With", "fetch");
    
//             const config = {
//                 method : 'POST',
//                 headers,
//                 body
//             }
    
//             const respuesta = await fetch(url, config);
//             const data = await respuesta.json();
//             const {resultado} = data;
//             // const resultado = data.resultado;
    
//             if(resultado == 1){
//                 Toast.fire({
//                     icon : 'success',
//                     title : 'Registro eliminado'
//                 })
    
//                 formReceptores.reset();
//                 buscarReceptores();
//             }else{
//                 Toast.fire({
//                     icon : 'error',
//                     title : 'Ocurrió un error'
//                 })
//             }
//         }
//     })
// }


// function NumText(string){//solo letras y numeros
//     var out = '';
//     //Se añaden las letras validas
//     var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ ';//Caracteres validos
  
//     for (var i=0; i<string.length; i++)
//        if (filtro.indexOf(string.charAt(i)) != -1) 
//        out += string.charAt(i);
//     return out;
//   }

//   formReceptores.desc.addEventListener('keyup', e=>{
//     let out = NumText(e.target.value)
//     e.target.value = out 


// })


// formReceptores.addEventListener('submit', guardarReceptores )
// btnModificar.addEventListener('click', modificarReceptores);