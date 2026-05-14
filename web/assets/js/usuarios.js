document.addEventListener("DOMContentLoaded", () => {
  const tabla = document.getElementById("tabla-usuarios");
  const buscador = document.getElementById("buscador");

  let usuarios = [];
  let userLevel = 0;
  let roles = [];

  async function cargarDesplegables() {
    try {
      const resRoles = await fetch("index.php?ctl=api_roles");
      roles = (await resRoles.json()).data;
    } catch (error) {
      alert("Error al cargar desplegables");
    }
  }

  async function cargarUsuarios() {
    const response = await fetch("index.php?ctl=api_usuarios");

    const result = await response.json();

    usuarios = result.data;
    userLevel = result.userLevel;

    renderizarBotonNuevo();
    renderizarTabla(usuarios);
  }

  function renderizarBotonNuevo() {
    const contenedor = document.getElementById("contenedor-boton-nuevo");

    if (userLevel == 4) {
      contenedor.innerHTML = `
      <button class="btn btn-primary mb-3" id="btnNuevoUsuario">
        Nuevo usuario
      </button>
    `;

      document
        .getElementById("btnNuevoUsuario")
        .addEventListener("click", abrirModalNuevo);
    }
  }

  function renderizarTabla(data) {
    tabla.innerHTML = "";

    data.forEach((usuario) => {
      const botonEditar =
        userLevel == 4
          ? `<a href="#"
                          class="btn btn-warning btn-sm btn-editar"
                          data-id="${usuario.id_usuario}">
                          <i class="fas fa-edit"></i>
                       </a>`
          : "";

      tabla.innerHTML += `
                <tr>
                    <td>${usuario.id_usuario}</td>
                    <td>${usuario.nombre}</td>
                    <td>${usuario.email}</td>
                    <td>${usuario.rol_nombre}</td>
                    <td>${usuario.id_estado == 1 ? "Activo" : "Inactivo"}</td>
                    <td>${botonEditar}</td>
                </tr>
            `;
    });
  }

  buscador.addEventListener("keyup", () => {
    const texto = buscador.value.toLowerCase();

    const filtrados = usuarios.filter(
      (u) =>
        u.nombre.toLowerCase().includes(texto) ||
        u.email.toLowerCase().includes(texto),
    );

    renderizarTabla(filtrados);
  });

  function abrirModalEditar(id) {
    const usuario = usuarios.find((u) => u.id_usuario == id);

    if (!usuario) return;

    document.getElementById("edit_id_usuario").value = usuario.id_usuario;
    document.getElementById("edit_nombre").value = usuario.nombre;
    document.getElementById("edit_email").value = usuario.email;
    document.getElementById("edit_rol").value = usuario.id_rol;
    document.getElementById("edit_id_estado").value = usuario.id_estado;

    const selectRol = document.getElementById("edit_rol");
    selectRol.innerHTML = "";

    roles.forEach((rol) => {
      const option = document.createElement("option");
      option.value = rol.id_rol;
      option.textContent = rol.rol;
      selectRol.appendChild(option);
    });

    $("#modalUsuarioEditar").modal("show");
  }

  // ABRIR MODAL NUEVO USUARIO

  function abrirModalNuevo() {
    document.getElementById("nuevo_nombre").value = "";
    document.getElementById("nuevo_email").value = "";
    document.getElementById("nuevo_password").value = "";

    // ROL
    const selectRol = document.getElementById("nuevo_rol");
    selectRol.innerHTML = "";

    roles.forEach((rol) => {
      const option = document.createElement("option");

      option.value = rol.id_rol;
      option.textContent = rol.rol;

      selectRol.appendChild(option);
    });

    // ESTADO
    document.getElementById("nuevo_estado").value = 1;

    $("#modalUsuarioNuevo").modal("show");
  }

  // VALIDACIONES

  // validaciones para nuevo usuarios
  const formNuevoUsuario = document.getElementById("formNuevoUsuario");

  formNuevoUsuario.addEventListener("submit", (e) => {
    limpiarErrores(formNuevoUsuario);

    let valido = true;

    valido =
      validarTexto(document.getElementById("nuevo_nombre"), 3, 50) && valido;
    valido = validarEmail(document.getElementById("nuevo_email")) && valido;
    valido =
      validarTexto(document.getElementById("nuevo_password"), 6, 100) && valido;
    valido = validarSelect(document.getElementById("nuevo_rol")) && valido;
    valido = validarSelect(document.getElementById("nuevo_estado")) && valido;

    if (!valido) {
      e.preventDefault();
    }
  });

  // validaciones para editar usuarios

  const formEditarUsuario = document.getElementById("formEditarUsuario");

  formEditarUsuario.addEventListener("submit", (e) => {
    limpiarErrores(formEditarUsuario);

    let valido = true;

    valido =
      validarTexto(document.getElementById("edit_nombre"), 3, 50) && valido;
    valido = validarEmail(document.getElementById("edit_email")) && valido;
    valido = validarSelect(document.getElementById("edit_rol")) && valido;
    valido = validarSelect(document.getElementById("edit_id_estado")) && valido;

    if (!valido) {
      e.preventDefault();
    }
  });

  $("#modalUsuarioNuevo").on("hidden.bs.modal", function () {
    resetearFormulario("formNuevoUsuario");
  });

  $("#modalUsuarioEditar").on("hidden.bs.modal", function () {
    resetearFormulario("formEditarUsuario");
  });

  // Escuchador para botones de editar

  document.addEventListener("click", (event) => {
    const btn = event.target.closest(".btn-editar");

    if (!btn) return;

    event.preventDefault();

    abrirModalEditar(btn.dataset.id);
  });

  async function init() {
    await cargarDesplegables();
    await cargarUsuarios();
  }

  init();
});
