function fill_tbl_loans() {
  let cols = [
    { data: "id_transaccion" },
    { data: "nombre_alumno" },
    { data: "nombre_usuario" },
    { data: "fecha_prestamo" },
    { data: "fecha_entrega" },
    { 
      data: "estado_prestamo",
      render: function (data, type) {
        if (type === 'display') {
          let template = `
          <td class='text-center'>
            <span class='badge bg-primary'>${data}</span>
          </td>`;

          if (data == "Entregado") {
            template = `
            <td class='text-center'>
              <span class='badge bg-success'>${data}</span>
            </td>`;
          }
          return template;
        }
        return data;
      } 
    },
    {
      data: "id_transaccion",
      render: function (data, type) {
        if (type === 'display') {
          template = `
          <button id='${data}' mod='prestamos' class='btn btn-xs btn-primary btn-edit' data-toggle='modal' data-target='#modal-default' onclick='reset_transaction_data()'>
            <i class='fas fa-eye'></i>
          </button>
          <button id='${data}' mod='prestamos' class='btn btn-xs btn-success btn-receive'>
            <i class='fas fa-check'></i>
          </button>
          <button id='${data}' mod='prestamos' class='btn btn-xs btn-danger btn-delete'>
            <i class='fas fa-trash'></i>
          </button>`;
        }
        return template;
      }
    }];
  return cols;
}

function fill_tbl_books() {
  let cols = [
    { data: "id_libro" },
    { data: "titulo_libro" },
    { data: "nombre_editorial" },
    { data: "nombre_categoria" },
    { data: "unidades_totales" },
    {
      data: "imagen_portada",
      render: function (data, type) {
        if (type === 'display') {
          template = ``;
          if (data != "portada_default.png") {
            template = `
            <button image-name='${data}' class='btn btn-sm btn-warning btn-view' data-toggle='modal' data-target='#modal-image' >
              <i class='fas fa-eye'></i>
            </button>`;
          }
        }
        return template;
      }
    },
    { data: "descripcion" },
    { 
      data: "estado_libro",
      render: function (data, type) {
        if (type === 'display') {
          let template = `
          <td class='text-center'>
            <span class='badge bg-danger'>${data}</span>
          </td>`;

          if (data == "Activo") {
            template = `
            <td class='text-center'>
              <span class='badge bg-success'>${data}</span>
            </td>`;
          }
          return template;
        }
        return data;
      } 
    },
    {
      data: "id_libro",
      render: function (data, type) {
        if (type === 'display') {
          template = `
          <button id='${data}' mod='libros' class='btn btn-xs btn-primary btn-edit'>
            <i class='fas fa-pen'></i>
          </button>
          <button id='${data}' mod='libros' class='btn btn-xs btn-danger btn-delete'>
            <i class='fas fa-trash'></i>
          </button>`;
        }
        return template;
      }
    }];
  return cols;
}

function fill_tbl_students() {
  let cols = [
    { data: "id_alumno" },
    { data: "matricula" },
    { data: "nombre_alumno" },
    { data: "semestre" },
    { 
      data: "estado_alumno",
      render: function (data, type) {
        if (type === 'display') {
          let template = `
          <td class='text-center'>
            <span class='badge bg-danger'>${data}</span>
          </td>`;
 
          if (data == "Activo") {
            template = `
            <td class='text-center'>
              <span class='badge bg-success'>${data}</span>
            </td>`;
          }
          return template;
        }
        return data;
      } 
    },
    {
      data: "id_alumno",
      render: function (data, type) {
        if (type === 'display') {
          template = `
          <button id='${data}' mod='alumnos' class='btn btn-xs btn-primary btn-edit'>
            <i class='fas fa-pen'></i>
          </button>
          <button id='${data}' mod='alumnos' class='btn btn-xs btn-danger btn-delete'>
            <i class='fas fa-trash'></i>
          </button>`;
        }
        return template;
      }
    }];
  return cols;
}

function fill_tbl_users() {
  let cols = [
    { data: "id_usuario" },
    { data: "usuario" },
    { data: "nombre_usuario" },
    { data: "telefono_usuario" },
    { data: "correo_usuario" },
    { data: "creacion_cuenta" },
    { 
      data: "estado_usuario",
      render: function (data, type) {
        if (type === 'display') {
          let template = `
          <td class='text-center'>
            <span class='badge bg-danger'>${data}</span>
          </td>`;
 
          if (data == "Activo") {
            template = `
            <td class='text-center'>
              <span class='badge bg-success'>${data}</span>
            </td>`;
          }
          return template;
        }
        return data;
      } 
    },
    {
      data: "rol_usuario",
      render: function (data, type, row, meta) {
        if (type === 'display') {
          let template = `
          <button id='${row.id_usuario}' mod='usuarios' class='btn btn-xs btn-primary btn-edit' data-toggle='modal' data-target='#modal-default'>
            <i class='fas fa-pen'></i>
          </button>`;
 
        if (data != "Admin") {
          template = `
          <button id='${row.id_usuario}' mod='usuarios' class='btn btn-xs btn-primary btn-edit' data-toggle='modal' data-target='#modal-default'>
            <i class='fas fa-pen'></i>
          </button>
          <button id='${row.id_usuario}' mod='usuarios' class='btn btn-xs btn-danger btn-delete'>
            <i class='fas fa-trash'></i>
          </button>`;
        }
        return template;
      }
      return data;
    }
  }];
  return cols;
}