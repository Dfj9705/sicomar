// import { Dropdown } from "bootstrap";
// import { validarFormulario, Toast } from "../funciones";
// import Datatable from 'datatables.net-bs5';
// import { lenguaje } from "../lenguaje";
// import Swal from "sweetalert2";

// const formMedios = document.getElementById('formMedios');
// const btnGuardar = document.getElementById('btnGuardar');
// const btnModificar = document.getElementById('btnModificar');
// const divTabla = document.getElementById('divTabla');
// let tablaProductos = new Datatable('#MediosTabla');

// btnModificar.parentElement.style.display = 'none';
// btnGuardar.disabled = false;
// btnModificar.disabled = true;





// function guardarMedios() {
//     const insumo = new MediosController(
//       document.querySelector('#insumo').value.trim().toUpperCase(),
//       document.querySelector('#medida').value.trim(),
//       document.querySelector('#color').value.trim()
//     );
  
//     const controlador = new MediosController();
//     controlador.guardarMedios(insumo)
//       .then((mensaje) => {
//         alertToast('success', mensaje);
//         document.querySelector('#formulario').reset();
//         removerValidaciones(document.querySelector('#formulario'));
//         buscarMedios();
//       })
//       .catch((mensaje) => {
//         alertToast('error', mensaje);
//       });
//   }

// // const guardarMedios = async (evento) => {
// //     evento.preventDefault();

// //     let formularioValido = validarFormulario(formMedios, ['id']);
// //     if (!formularioValido) {
// //         Toast.fire({
// //             icon: 'warning',
// //             title: 'Debe llenar todos los campos'
// //         })
// //         return;
// //     }



// //     try {
// //         //Crear el cuerpo de la consulta
// //         const url = '/sicomar/API/Medios/guardar'

// //         const body = new FormData(formMedios);
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
// //                 formMedios.reset();
               
// //                 break;
// //             case 2:
// //                 icon = "warning"
// //                 formMedios.reset();

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


// //         buscarMedios()

// //     } catch (error) {
// //         console.log(error);
// //     }
// // }





// const buscarMedios = async (evento) => {
//     evento && evento.preventDefault();

//     try {
//         const url = '/sicomar/API/Medios/buscar'
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
//         tablaProductos = new Datatable('#MediosTabla', {
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



// const modificarMedios = async (evento) => {
//     evento.preventDefault();

//     let formularioValido = validarFormulario(formMedios);
//     if (!formularioValido) {
//         Toast.fire({
//             icon: 'warning',
//             title: 'Debe llenar todos los campos'
//         })
//         return;
//     }



//     try {
//         //Crear el cuerpo de la consulta
//         const url = '/sicomar/API/Medios/modificar'

//         const body = new FormData(formMedios);
        
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
//                 formMedios.reset();
               
//                 break;
//             case 2:
//                 icon = "warning"
//                 formMedios.reset();

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


//         buscarMedios()
//         formMedios.reset();
//             btnModificar.parentElement.style.display = 'none';
//             btnGuardar.parentElement.style.display = '';
//             btnGuardar.disabled = false;
//             btnModificar.disabled = true;
        
//             divTabla.style.display = ''

//     } catch (error) {
//         console.log(error);
//     }
// }



// buscarMedios();

// window.asignarValores = (id, desc) => {
//     formMedios.id.value = id;
//     formMedios.desc.value = desc;
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
//             const url = '/sicomar/API/Medios/eliminar'
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
    
//                 formMedios.reset();
//                 buscarMedios();
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

//   formMedios.desc.addEventListener('keyup', e=>{
//     let out = NumText(e.target.value)
//     e.target.value = out 


// })


// formMedios.addEventListener('submit', guardarMedios )
// btnModificar.addEventListener('click', modificarMedios);