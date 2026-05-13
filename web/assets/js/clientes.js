document.addEventListener("DOMContentLoaded", () => {
  const tabla = document.getElementById("tabla-clientes");
  const buscador = document.getElementById("buscador");
  const buscadorTel = document.getElementById("buscadorTel");
  const filtroEstado = document.getElementById("filtroEstado");

  let clientes = [];
  let userLevel = 0;
  let ordenActual = { campo: null, asc: true };
  let paginaActual = 1;
  const porPagina = 10;
  let comerciales = [];
  let metodosPago = [];
  let impuestos = [];

  // Función para cargar datos de comerciales, métodos de pago e impuestos para los desplegables del modal de edición

  async function cargarDesplegables() {
    try {
      const resCom = await fetch("index.php?ctl=api_comerciales");
      comerciales = (await resCom.json()).data;

      const resMet = await fetch("index.php?ctl=api_metodo_pago");
      metodosPago = (await resMet.json()).data;

      const resImp = await fetch("index.php?ctl=api_impuestos");
      impuestos = (await resImp.json()).data;
    } catch (error) {
      alert("Error al cargar desplegables");
    }
  }

  // Función para cargar clientes desde la API

  async function cargarClientes() {
    try {
      const response = await fetch("index.php?ctl=api_clientes");
      const result = await response.json();

      clientes = result.data;
      userLevel = result.userLevel;
      renderizarBotonNuevo();

      paginar(clientes);
    } catch (error) {
      alert("Error al cargar clientes");
    }
  }

  // Función para renderizar la tabla de clientes
  function renderizarTabla(data) {
    tabla.innerHTML = "";

    data.forEach((cliente) => {
      const botonEditar =
        userLevel == 3 || userLevel == 4
          ? `<a href="#" class="btn btn-warning btn-sm btn-editar" data-id="${cliente.id_cliente}"><i class="fas fa-edit"></i></a>`
          : "";

      const fila = `
          <tr>
            <td>${cliente.documento}</td>
            <td>${cliente.nombreCliente}</td>
            <td>${cliente.emailCliente}</td>
            <td>${cliente.telefono}</td>
            <td>${cliente.id_estado == 1 ? "Activo" : "Inactivo"}</td>
            <td 
                class="text-nowrap"> 
                <a href="#" class="btn btn-info btn-sm btn-ver" data-id="${
                  cliente.id_cliente
                }"><i class="fas fa-eye"></i></a> 
                ${botonEditar}
            </td>
          </tr>
        `;
      tabla.innerHTML += fila;
    });
  }
  // Función para renderizar el botón de "Nuevo cliente" según el nivel de usuario

  function renderizarBotonNuevo() {
    const contenedor = document.getElementById("contenedor-boton-nuevo");

    if (userLevel == 3 || userLevel == 4) {
      contenedor.innerHTML = `
            <button class="btn btn-primary mb-3" id="btnNuevoCliente">
                Nuevo cliente
            </button>
        `;

      document
        .getElementById("btnNuevoCliente")
        .addEventListener("click", abrirModalNuevo);
    }
  }

  // Función para paginar los datos

  function paginar(data) {
    const totalPaginas = Math.ceil(data.length / porPagina);
    const inicio = (paginaActual - 1) * porPagina;
    const fin = inicio + porPagina;

    renderizarTabla(data.slice(inicio, fin));
    renderizarPaginador(totalPaginas, data);
  }

  // Función para renderizar el paginador

  function renderizarPaginador(totalPaginas, data) {
    const paginador = document.getElementById("paginador");
    paginador.innerHTML = "";

    const anterior = `
      <li class="page-item ${paginaActual === 1 ? "disabled" : ""}">
        <a class="page-link" href="#" data-pagina="${paginaActual - 1}">
          <i class="fas fa-chevron-left"></i>
        </a>
      </li>
    `;
    paginador.innerHTML += anterior;

    for (let i = 1; i <= totalPaginas; i++) {
      const pagina = `
        <li class="page-item ${i === paginaActual ? "active" : ""}">
          <a class="page-link" href="#" data-pagina="${i}">${i}</a>
        </li>
      `;
      paginador.innerHTML += pagina;
    }

    const siguiente = `
      <li class="page-item ${
        paginaActual === totalPaginas || totalPaginas === 0 ? "disabled" : ""
      }">
        <a class="page-link" href="#" data-pagina="${paginaActual + 1}">
          <i class="fas fa-chevron-right"></i>
        </a>
      </li>
    `;
    paginador.innerHTML += siguiente;

    paginador.querySelectorAll(".page-link").forEach((btn) => {
      btn.addEventListener("click", (e) => {
        e.preventDefault();
        const nuevaPagina = parseInt(btn.dataset.pagina);
        if (nuevaPagina < 1 || nuevaPagina > totalPaginas) return;
        paginaActual = nuevaPagina;
        paginar(data);
      });
    });
  }

  // Funciones para los filtros y ordenación

  buscador.addEventListener("keyup", () => {
    const texto = buscador.value.toLowerCase();

    const filtrados = clientes.filter(
      (c) =>
        c.nombreCliente.toLowerCase().includes(texto) ||
        c.emailCliente.toLowerCase().includes(texto) ||
        c.documento.toLowerCase().includes(texto),
    );
    paginaActual = 1;
    paginar(filtrados);
  });

  buscadorTel.addEventListener("keyup", () => {
    const numero = buscadorTel.value.toLowerCase();

    const filtrados = clientes.filter((c) =>
      c.telefono.toLowerCase().includes(numero),
    );
    paginaActual = 1;
    paginar(filtrados);
  });

  filtroEstado.addEventListener("change", () => {
    const estado = filtroEstado.value;

    const filtrados = clientes.filter((c) =>
      estado === "" ? true : String(c.id_estado) === estado,
    );
    paginaActual = 1;
    paginar(filtrados);
  });

  document.querySelectorAll("thead th[data-campo]").forEach((th) => {
    th.style.cursor = "pointer";

    th.addEventListener("click", () => {
      const campo = th.dataset.campo;

      if (ordenActual.campo === campo) {
        ordenActual.asc = !ordenActual.asc;
      } else {
        ordenActual.campo = campo;
        ordenActual.asc = true;
      }

      document.querySelectorAll("thead th[data-campo]").forEach((el) => {
        el.innerHTML = el.innerHTML.replace(/ <i.*<\/i>/, "");
      });

      const icono = ordenActual.asc
        ? `<i class="fas fa-sort-up"></i>`
        : `<i class="fas fa-sort-down"></i>`;
      th.innerHTML += ` ${icono}`;

      const ordenados = [...clientes].sort((a, b) => {
        const valA = String(a[campo] ?? "").toLowerCase();
        const valB = String(b[campo] ?? "").toLowerCase();

        if (valA < valB) return ordenActual.asc ? -1 : 1;
        if (valA > valB) return ordenActual.asc ? 1 : -1;
        return 0;
      });

      paginaActual = 1;
      paginar(ordenados);
    });
  });

  // Funciones para abrir modal de ver

  function abrirModalVer(id) {
    const cliente = clientes.find((c) => c.id_cliente == id);
    if (!cliente) return;

    document.getElementById("ver_id").textContent = cliente.id_cliente;
    document.getElementById("ver_nombre").textContent = cliente.nombreCliente;
    document.getElementById("ver_apellido1").textContent = cliente.apellido1;
    document.getElementById("ver_apellido2").textContent =
      cliente.apellido2 ?? "-";
    document.getElementById("ver_email").textContent = cliente.emailCliente;
    document.getElementById("ver_documento").textContent = cliente.documento;
    document.getElementById("ver_telefono").textContent = cliente.telefono;
    document.getElementById("ver_direccion").textContent =
      cliente.direccion ?? "-";
    document.getElementById("ver_cp").textContent = cliente.cp ?? "-";
    document.getElementById("ver_ciudad").textContent = cliente.ciudad ?? "-";
    document.getElementById("ver_pais").textContent = cliente.pais ?? "-";
    document.getElementById("ver_fecha_nacimiento").textContent =
      cliente.fecha_de_nacimiento ?? "-";
    document.getElementById("ver_metodo_pago").textContent =
      cliente.nombre_metodo_pago ?? "-";
    document.getElementById("ver_impuesto").textContent =
      cliente.nombre_impuesto ?? "-";
    document.getElementById("ver_credito").textContent = cliente.credito ?? "-";
    document.getElementById("ver_estado").textContent =
      cliente.id_estado == 1 ? "Activo" : "Inactivo";
    document.getElementById("ver_fecha_alta").textContent =
      cliente.fecha_de_alta ?? "-";
    document.getElementById("ver_fecha_baja").textContent =
      cliente.fecha_de_baja ?? "-";
    document.getElementById("ver_usuario").textContent =
      cliente.nombre_comercial ?? "-";

    $("#modalClienteVer").modal("show");
  }

  document.addEventListener("click", (event) => {
    const btn = event.target.closest(".btn-ver");
    if (!btn) return;
    event.preventDefault();
    abrirModalVer(btn.dataset.id);
  });

  // Función para abrir modal de edición
  function abrirModalEditar(id) {
    const cliente = clientes.find((c) => c.id_cliente == id);
    if (!cliente) return;

    document.getElementById("edit_id").textContent = cliente.id_cliente;
    document.getElementById("edit_id_hidden").value = cliente.id_cliente;
    document.getElementById("edit_nombre").value = cliente.nombreCliente;
    document.getElementById("edit_apellido1").value = cliente.apellido1;
    document.getElementById("edit_apellido2").value = cliente.apellido2 ?? "-";
    document.getElementById("edit_email").value = cliente.emailCliente;
    document.getElementById("edit_documento").value = cliente.documento;
    document.getElementById("edit_telefono").value = cliente.telefono;
    document.getElementById("edit_direccion").value = cliente.direccion ?? "-";
    document.getElementById("edit_cp").value = cliente.cp ?? "-";
    document.getElementById("edit_ciudad").value = cliente.ciudad ?? "-";
    document.getElementById("edit_pais").value = cliente.pais ?? "-";
    document.getElementById("edit_fecha_nacimiento").value =
      cliente.fecha_de_nacimiento ?? "-";
    document.getElementById("edit_credito").value = cliente.credito ?? "-";
    document.getElementById("edit_fecha_alta").value =
      cliente.fecha_de_alta ?? "-";
    document.getElementById("edit_fecha_baja").value =
      cliente.fecha_de_baja ?? "-";

    // Desplegable comercial
    const selectComercial = document.getElementById("edit_usuario");
    selectComercial.innerHTML = "";
    comerciales.forEach((c) => {
      const option = document.createElement("option");
      option.value = c.id_usuario;
      option.textContent = c.nombre;
      option.selected = c.id_usuario == cliente.id_usuario;
      selectComercial.appendChild(option);
    });

    // Desplegable método de pago
    const selectMetodo = document.getElementById("edit_metodo_pago");
    selectMetodo.innerHTML = "";
    metodosPago.forEach((m) => {
      const option = document.createElement("option");
      option.value = m.id_metodo_pago;
      option.textContent = m.metodo_pago;
      option.selected = m.id_metodo_pago == cliente.id_metodo_pago;
      selectMetodo.appendChild(option);
    });

    // Desplegable impuesto
    const selectImpuesto = document.getElementById("edit_impuesto");
    selectImpuesto.innerHTML = "";
    impuestos.forEach((i) => {
      const option = document.createElement("option");
      option.value = i.id_impuesto;
      option.textContent = i.tipo_de_impuesto;
      option.selected = i.id_impuesto == cliente.id_impuesto;
      selectImpuesto.appendChild(option);
    });

    // Desplegable estado
    const selectEstado = document.getElementById("edit_estado");
    selectEstado.value = cliente.id_estado;

    $("#modalClienteEditar").modal("show");
  }

  function abrirModalNuevo() {
    // LIMPIAR INPUTS
    document.getElementById("nuevo_documento").value = "";
    document.getElementById("nuevo_nombre").value = "";
    document.getElementById("nuevo_apellido1").value = "";
    document.getElementById("nuevo_apellido2").value = "";
    document.getElementById("nuevo_email").value = "";
    document.getElementById("nuevo_telefono").value = "";
    document.getElementById("nuevo_fecha_nacimiento").value = "";
    document.getElementById("nuevo_direccion").value = "";
    document.getElementById("nuevo_cp").value = "";
    document.getElementById("nuevo_ciudad").value = "";
    document.getElementById("nuevo_pais").value = "";
    document.getElementById("nuevo_credito").value = "";
    document.getElementById("nuevo_fecha_alta").value = new Date()
      .toISOString()
      .split("T")[0];
    document.getElementById("nuevo_fecha_baja").textContent = "-";

    // COMERCIALES
    const selectComercial = document.getElementById("nuevo_usuario");
    selectComercial.innerHTML = "";

    comerciales.forEach((c) => {
      const option = document.createElement("option");
      option.value = c.id_usuario;
      option.textContent = c.nombre;
      selectComercial.appendChild(option);
    });

    // MÉTODOS PAGO
    const selectMetodo = document.getElementById("nuevo_metodo_pago");
    selectMetodo.innerHTML = "";

    metodosPago.forEach((m) => {
      const option = document.createElement("option");
      option.value = m.id_metodo_pago;
      option.textContent = m.metodo_pago;
      selectMetodo.appendChild(option);
    });

    // IMPUESTOS
    const selectImpuesto = document.getElementById("nuevo_impuesto");
    selectImpuesto.innerHTML = "";

    impuestos.forEach((i) => {
      const option = document.createElement("option");
      option.value = i.id_impuesto;
      option.textContent = i.tipo_de_impuesto;
      selectImpuesto.appendChild(option);
    });

    $("#modalClienteNuevo").modal("show");
  }

  // Escuchador para botones de editar

  document.addEventListener("click", (event) => {
    const btn = event.target.closest(".btn-editar");
    if (!btn) return;
    event.preventDefault();
    abrirModalEditar(btn.dataset.id);
  });

  async function init() {
    await cargarDesplegables();
    await cargarClientes();
  }
  init();
});
