import { Dropdown } from "bootstrap";
import { validarFormulario, Toast } from "../funciones";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { data, post } from "jquery";
import { ViewContextType } from "fullcalendar";

const formInsumos = document.getElementById("formInsumos");
const btnGuardar = document.getElementById("btnGuardar");
const btnModificar = document.getElementById("btnModificar");
const divTabla = document.getElementById("divTabla");
const tablaColores = document.getElementById("coloresTabla");
let tablainsumos = new Datatable("#insumosTabla");

btnModificar.parentElement.style.display = "none";
btnGuardar.disabled = false;
btnModificar.disabled = true;

const guardarInsumos = async (evento) => {
  evento.preventDefault();

  let formularioValido = validarFormulario(formInsumos, ["insumo_id"]);

  if (!formularioValido) {
    Toast.fire({
      icon: "warning",
      title: "Debe llenar todos los campos",
    });
    return;
  }

  try {
    //Crear el cuerpo de la consulta
    const url = "/sicomar/API/insumos/guardar";
    const body = new FormData(formInsumos);
    body.delete("insumo_id");
    const headers = new Headers();
    headers.append("X-Requested-With", "fetch");

    const config = {
      method: "POST",
      headers,
      body,
    };

    const respuesta = await fetch(url, config);
    const data = await respuesta.json();
    console.log(data);

    const { mensaje, codigo, detalle } = data;
    // const resultado = data.resultado;
    let icon = "";
    switch (codigo) {
      case 1:
        icon = "success";
        formInsumos.reset();
        buscarInsumos();
        break;
      case 2:
        icon = "warning";

        break;
      case 3:
        icon = "error";

        break;
      case 4:
        icon = "error";
        console.log(detalle);

        break;

      default:
        break;
    }

    Toast.fire({
      icon: icon,
      title: mensaje,
    });

    //buscarProducto();
  } catch (error) {
    console.log(error);
  }
};

const buscarInsumos = async (evento) => {
  evento && evento.preventDefault();

  try {
    const url = "/sicomar/API/insumos/buscar";
    const headers = new Headers();
    headers.append("X-Requested-With", "fetch");

    const config = {
      method: "GET",
    };

    const respuesta = await fetch(url, config);
    const data = await respuesta.json();
    // console.log(data);

    tablainsumos.destroy();
    let contador = 1;
    tablainsumos = new Datatable("#insumosTabla", {
      language: lenguaje,
      data: data,
      columns: [
        {
          data: "id",
          render: () => {
            return contador++;
          },
        },
        { data: "insumo_desc" },

        {
          data: "insumo_color",
          render: (data, type, row, meta) => {
            return `<input type='color' value='${data}' disabled />`;
          },
        },

        // { data: "insumo_unidad" },

        {
          data: "id",
          render: (data, type, row, meta) => {
            return `<button class="btn btn-warning" onclick="asignarValores('${row.insumo_id}', '${row.insumo_desc}','${row.insumo_color}')">Modificar</button>`;
          },
        },
        {
          data: "id",
          render: (data, type, row, meta) => {
            return `<button class="btn btn-danger" onclick="eliminarRegistro('${row.insumo_id}')">Eliminar</button>`;
          },
        },
      ],
    });
  } catch (error) {
    console.log(error);
  }
};
const modificarInsumos = async (e) => {
  e && e.preventDefault();
  let formularioValido = validarFormulario(formInsumos);
  if (!formularioValido) {
    Toast.fire({
      icon: "info",
      title: "Debe llenar todos los campos",
    });
    return;
  }

  try {
    const url = "/sicomar/API/insumos/modificar";
    const body = new FormData(formInsumos);
    const headers = new Headers();
    headers.append("X-Requested-With", "fetch");

    const config = {
      method: "POST",
      body,
      headers,
    };

    const respuesta = await fetch(url, config);
    const data = await respuesta.json();
    // console.log(data);
    const { mensaje, codigo, detalle } = data;
    console.log(data["codigo"]);
    let icon = "";
    switch (codigo) {
      case 1:
        icon = "success";
        formInsumos.reset();
        // resetear()
        buscarInsumos();
        break;
      case 2:
        icon = "warning";
        formInsumos.reset();

        break;
      case 3:
        icon = "error";

        break;
      case 4:
        icon = "error";
        console.log(detalle);
        break;

      default:
        icon = "info";
        break;
    }

    Toast.fire({
      icon,
      title: mensaje,
    });
    buscarInsumos();
    btnModificar.parentElement.style.display = "none";
    btnGuardar.parentElement.style.display = "";
    btnGuardar.disabled = false;
    btnModificar.disabled = true;
    formInsumos.reset();
    divTabla.style.display = "";
  } catch (error) {
    console.log(error);
  }
};

buscarInsumos();
btnModificar.parentElement.style.display = "none";
btnGuardar.parentElement.style.display = "";
btnGuardar.disabled = false;
btnModificar.disabled = true;
divTabla.style.display = "";

window.asignarValores = (insumo_id, insumo_desc, insumo_color) => {
  // console.log(insumo_id);
  // console.log(insumo_desc);
  // console.log(insumo_color);
  formInsumos.insumo_id.value = insumo_id;
  formInsumos.insumo_desc.value = insumo_desc;
  formInsumos.insumo_color.value = insumo_color;
  btnModificar.parentElement.style.display = "";
  btnGuardar.parentElement.style.display = "none";
  btnGuardar.disabled = true;
  btnModificar.disabled = false;

  divTabla.style.display = "none";
};
function NumText(string) {
  //solo letras y numeros
  var out = "";
  //Se añaden las letras validas
  var filtro =
    "ÁÉÍÓÚáéíóúabcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ  "; //Caracteres validos

  for (var i = 0; i < string.length; i++)
    if (filtro.indexOf(string.charAt(i)) != -1) out += string.charAt(i);
  return out;
}

formInsumos.insumo_desc.addEventListener("keyup", (e) => {
  let out = NumText(e.target.value);
  e.target.value = out;
});

window.eliminarRegistro = (insumo_id) => {
  Swal.fire({
    title: "Confirmación",
    icon: "warning",
    text: "¿Esta seguro que desea eliminar este registro?",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar",
  }).then(async (result) => {
    if (result.isConfirmed) {
      const url = "/sicomar/API/insumos/eliminar";
      const body = new FormData();
      body.append("insumo_id", insumo_id);
      const headers = new Headers();
      headers.append("X-Requested-With", "fetch");

      const config = {
        method: "POST",
        headers,
        body,
      };

      const respuesta = await fetch(url, config);
      const data = await respuesta.json();
      const { mensaje, codigo, detalle } = data;
      // console.log(data);
      let icon = "";
      switch (codigo) {
        case 1:
          Toast.fire({
            icon: "success",
            title: "registro Eliminado",
          });
          formInsumos.reset();
          buscarInsumos();
          break;
        case 2:
          icon: "warning", formInsumos.reset();
          break;
        case 3:
          icon: "error", formInsumos.reset();
        case 4:
          icon: "error", formInsumos.reset();
          console.log(detalle);
        default:
          break;
      }
    }
  });
};
formInsumos.addEventListener("submit", guardarInsumos);
btnModificar.addEventListener("click", modificarInsumos);
