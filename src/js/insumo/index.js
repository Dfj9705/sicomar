import { Dropdown } from "bootstrap";
import { validarFormulario, Toast } from "../funciones";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import Swal from "sweetalert2";

const forminsumos = document.getElementById("forminsumos");
const btnGuardar = document.getElementById("btnGuardar");
const btnModificar = document.getElementById("btnModificar");
const divTabla = document.getElementById("divTabla");
let tablaProductos = new Datatable("#insumosTabla");

btnModificar.parentElement.style.display = "none";
btnGuardar.disabled = false;
btnModificar.disabled = "true";

const guardarinsumos = async (evento) => {
  evento.preventDefault();

  let formularioValido = validarFormulario(forminsumos, ["id"]);
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

    const body = new FormData(forminsumos);
    body.delete("id");
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
        forminsumos.reset();

        break;
      case 2:
        icon = "warning";
        forminsumos.reset();

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

    buscarinsumos();
  } catch (error) {
    console.log(error);
  }

  ///7

  const buscarinsumos = async (evento) => {
    evento && evento.preventDefault();

    try {
      const url = "/sicomar/API/insumo/buscar";
      const headers = new Headers();
      headers.append("X-Requested-With", "fetch");

      const config = {
        method: "GET",
        headers,
      };

      const respuesta = await fetch(url, config);
      const data = await respuesta.json();

      // console.log(data);

      tablaProductos.destroy();
      let contador = 1;
      tablaProductos = new Datatable("#insumosTabla", {
        language: lenguaje,
        data: data,
        columns: [
          {
            data: "id",
            render: () => {
              return contador++;
            },
          },
          { data: "desc" },
          // { data: 'situacion'},
        ],
      });
    } catch (error) {
      console.log(error);
    }
  };

  buscarinsumos();

  window.asignarValores = (id, desc) => {
    forminsumos.id.value = id;
    forminsumos.desc.value = desc;
    btnModificar.parentElement.style.display = "";
    btnGuardar.parentElement.style.display = "none";
    btnGuardar.disabled = true;
    btnModificar.disabled = false;
    divTabla.style.display = "none";
  };

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
        const url = "/sicomar/API/insumo/eliminar";
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

          forminsumos.reset();
          buscarinsumos();
        } else {
          Toast.fire({
            icon: "error",
            title: "Ocurrió un error",
          });
        }
      }
      btnCancelar.parentElement.style.display = "";
      btnCancelar.disabled = true;
    });
  };
};

forminsumos.addEventListener("submit", guardarinsumos);
btnModificar.addEventListener("click", modificarinsumos);
