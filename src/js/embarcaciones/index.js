import { Dropdown } from "bootstrap";
import { validarFormulario, Toast } from "../funciones";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";
import { data, post } from "jquery";
import { ViewContextType } from "fullcalendar";

const formEmbarcaciones = document.getElementById("formEmbarcaciones");
const btnGuardar = document.getElementById("btnGuardar");
const btnModificar = document.getElementById("btnModificar");
const divTabla = document.getElementById("divTabla");
const tablaTipo = document.getElementById("TipoTabla");
let tablaembarcaciones = new Datatable("#embarcacionesTabla");

btnModificar.parentElement.style.display = "none";
btnGuardar.disabled = false;
btnModificar.disabled = true;

const guardarEmbarcaciones = async (evento) => {
  evento.preventDefault();

  let formularioValido = validarFormulario(formEmbarcaciones, ["emb_id"]);

  if (!formularioValido) {
    Toast.fire({
      icon: "warning",
      title: "Debe llenar todos los campos",
    });
    return;
  }

  try {
    //Crear el cuerpo de la consulta
    const url = "/sicomar/API/embaracaciones/guardar";
    const body = new FormData(formEmbarcaciones);
    body.delete("emb_id");
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
        formEmbarcaciones.reset();
        buscarEmbarcaciones();
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

const buscarEmbarcaciones = async (evento) => {
  evento && evento.preventDefault();

  try {
    const url = "/sicomar/API/embarcaciones/buscar";
    const headers = new Headers();
    headers.append("X-Requested-With", "fetch");

    const config = {
      method: "GET",
    };

    const respuesta = await fetch(url, config);
    const data = await respuesta.json();
    // console.log(data);

    tablaembarcaciones.destroy();
    let contador = 1;
    tablaembarcaciones = new Datatable("#embarcacionesTabla", {
      language: lenguaje,
      data: data,
      columns: [
        {
          data: "id",
          render: () => {
            return contador++;
          },
        },
        { data: "emb_nombre" },

        {
          data: "emb_tipo",
          render: () => {
            ///////
            return `<input type='color' value='${data}' disabled />`;
          },
        },

        // { data: "insumo_unidad" },

        {
          data: "emb_id",
          render: (data, type, row, meta) => {
            return `<button class="btn btn-warning" onclick="asignarValores('${row.emb_id}', '${row.emb_nombre}','${row.mb_tipo}')">Modificar</button>`;
          },
        },
        {
          data: "emb_id",
          render: (data, type, row, meta) => {
            return `<button class="btn btn-danger" onclick="eliminarRegistro('${row.id}')">Eliminar</button>`;
          },
        },
      ],
    });
  } catch (error) {
    console.log(error);
  }
};

const modificarEmbarcaciones = async (e) => {
  e && e.preventDefault();
  if (!validarFormulario(formEmbarcaciones)) {
    Toast.fire({
      icon: "info",
      title: "Debe llenar todos los campos",
    });
    return;
  }

  try {
    const url = "/sicomar/API/embarcacines/modificar";
    const body = new FormData(formEmbarcaciones);
    const headers = new Headers();
    headers.append("X-Requested-With", "fetch");

    const config = {
      method: "POST",
      body,
      headers,
    };

    const respuesta = await fetch(url, config);
    const data = await respuesta.json();
    console.log(data);
    const { mensaje, codigo, detalle } = data;
    let icon = "";
    switch (codigo) {
      case 1:
        icon = "success";
        formEmbarcaciones.reset();
        // resetear()
        buscarEmbarcaciones();
        break;
      case 2:
        icon = "warning";
        formEmbarcaciones.reset();

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
    buscarEmbarcaciones();
    btnModificar.parentElement.style.display = "none";
    btnGuardar.parentElement.style.display = "";
    btnGuardar.disabled = false;
    btnModificar.disabled = true;
    formEmbarcaciones.reset();
    divTabla.style.display = "";
  } catch (error) {
    console.log(error);
  }
};

buscarEmbarcaciones();
btnModificar.parentElement.style.display = "none";
btnGuardar.parentElement.style.display = "";
btnGuardar.disabled = false;
btnModificar.disabled = true;
divTabla.style.display = "";

window.asignarValores = (emb_id, emb_nombre, emb_tipo) => {
  console.log(emb_id);
  console.log(emb_nombre);
  console.log(emb_tipo);
  formEmbarcaciones.emb_id.value = emb_id;
  formEmbarcaciones.emb_nombre.value = emb_nombre;
  formEmbarcaciones.emb_tipo.value = emb_tipo;
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

formEmbarcaciones.emb_nombre.addEventListener("keyup", (e) => {
  let out = NumText(e.target.value);
  e.target.value = out;
});

window.eliminarRegistro = (id) => {
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
      const url = "/sicomar/API/embarcaciones/eliminar";
      const body = new FormData();
      body.append("id", id);
      const headers = new Headers();
      headers.append("X-Requested-With", "fetch");

      const config = {
        method: "POST",
        headers,
        body,
      };

      const respuesta = await fetch(url, config);
      const data = await respuesta.json();
      const { resultado } = data;
      // const resultado = data.resultado;

      if (resultado == 1) {
        Toast.fire({
          icon: "success",
          title: "Registro eliminado",
        });

        formEmbarcaciones.reset();
        buscarEmbarcaciones();
      } else {
        Toast.fire({
          icon: "error",
          title: "Ocurrió un error",
        });
      }
    }
  });
};
formEmbarcaciones.addEventListener("submit", guardarEmbarcaciones);
btnModificar.addEventListener("click", modificarEmbarcaciones);
