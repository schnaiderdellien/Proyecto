document.addEventListener("DOMContentLoaded", () => {
  const tabla = document.getElementById("tabla-pedidos");

  const buscador = document.getElementById("buscador");

  const filtroEstado = document.getElementById("filtroEstado");

  const buscadorComercial = document.getElementById("buscadorComercial");

  let pedidos = [];

  let pedidosFiltrados = [];

  let userLevel = 0;

  let comerciales = [];

  let estadosPedido = [];

  let ordenActual = {
    campo: null,
    asc: true,
  };

  let paginaActual = 1;

  const porPagina = 10;

  // CARGAR DESPLEGABLES

  async function cargarDesplegables() {
    try {
      // COMERCIALES

      const resCom = await fetch("index.php?ctl=api_comerciales");

      comerciales = (await resCom.json()).data;

      // ESTADOS PEDIDO

      const resEstado = await fetch("index.php?ctl=api_estados_pedido");

      estadosPedido = (await resEstado.json()).data;

      renderizarFiltros();
    } catch (error) {
      alert("Error al cargar filtros");
    }
  }

  // RENDERIZAR FILTROS

  function renderizarFiltros() {
    // COMERCIALES

    buscadorComercial.innerHTML = `
      <option value="">
        Todos los comerciales
      </option>
    `;

    comerciales.forEach((comercial) => {
      buscadorComercial.innerHTML += `
        <option value="${comercial.nombre}">
          ${comercial.nombre}
        </option>
      `;
    });

    // ESTADOS

    filtroEstado.innerHTML = `
      <option value="">
        Todos los estados
      </option>
    `;

    estadosPedido.forEach((estado) => {
      filtroEstado.innerHTML += `
        <option value="${estado.id_estado_pedido}">
          ${estado.estado}
        </option>
      `;
    });
  }

  // CARGAR PEDIDOS

  async function cargarPedidos() {
    try {
      const response = await fetch("index.php?ctl=api_pedidos");

      const result = await response.json();

      pedidos = result.data;

      pedidosFiltrados = pedidos;

      userLevel = result.userLevel;

      renderizarBotonNuevo();

      paginar(pedidosFiltrados);
    } catch (error) {
      alert("Error al cargar pedidos");
    }
  }

  // RENDERIZAR TABLA

  function renderizarTabla(data) {
    tabla.innerHTML = "";

    data.forEach((pedido) => {
      const botonEditar =
        userLevel == 3 || userLevel == 4
          ? `
                      <a href="index.php?ctl=editarPedido&id=${pedido.id_pedido}"
                        class="btn btn-warning btn-sm">

                          <i class="fas fa-edit"></i>

                      </a>
                  `
          : "";

      tabla.innerHTML += `
              <tr>

                  <td>${pedido.numero_pedido}</td>

                  <td>${pedido.nombreCliente}</td>

                  <td>${pedido.comercial}</td>

                  <td>${pedido.estado}</td>

                  <td>${pedido.fecha_pedido}</td>

                  <td>${pedido.total} €</td>

                  <td class="text-nowrap">

                      <a href="index.php?ctl=verPedido&id=${pedido.id_pedido}"
                        class="btn btn-info btn-sm">

                          <i class="fas fa-eye"></i>

                      </a>

                      ${botonEditar}

                  </td>

              </tr>
          `;
    });
  }

  // BOTÓN NUEVO PEDIDO

  function renderizarBotonNuevo() {
    const contenedor = document.getElementById("contenedor-boton-nuevo");

    if (userLevel == 3 || userLevel == 4) {
      contenedor.innerHTML = `
        <button class="btn btn-primary mb-3"
                id="btnNuevoPedido">

          Nuevo pedido

        </button>
      `;

      document
        .getElementById("btnNuevoPedido")
        .addEventListener("click", () => {
          window.location.href = "index.php?ctl=nuevoPedido";
        });
    }
  }

  // PAGINACIÓN

  function paginar(data) {
    const totalPaginas = Math.ceil(data.length / porPagina);

    const inicio = (paginaActual - 1) * porPagina;

    const fin = inicio + porPagina;

    renderizarTabla(data.slice(inicio, fin));

    renderizarPaginador(totalPaginas, data);
  }

  // RENDERIZAR PAGINADOR

  function renderizarPaginador(totalPaginas, data) {
    const paginador = document.getElementById("paginador");

    paginador.innerHTML = "";

    // ANTERIOR

    paginador.innerHTML += `
      <li class="page-item ${paginaActual === 1 ? "disabled" : ""}">

        <a class="page-link"
           href="#"
           data-pagina="${paginaActual - 1}">

          <i class="fas fa-chevron-left"></i>

        </a>

      </li>
    `;

    // PÁGINAS

    for (let i = 1; i <= totalPaginas; i++) {
      paginador.innerHTML += `
        <li class="page-item ${i === paginaActual ? "active" : ""}">

          <a class="page-link"
             href="#"
             data-pagina="${i}">

            ${i}

          </a>

        </li>
      `;
    }

    // SIGUIENTE

    paginador.innerHTML += `
      <li class="page-item ${
        paginaActual === totalPaginas || totalPaginas === 0 ? "disabled" : ""
      }">

        <a class="page-link"
           href="#"
           data-pagina="${paginaActual + 1}">

          <i class="fas fa-chevron-right"></i>

        </a>

      </li>
    `;

    // EVENTOS PAGINADOR

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

  // FILTROS

  function aplicarFiltros() {
    const texto = buscador.value.toLowerCase();

    const estado = filtroEstado.value;

    const comercial = buscadorComercial.value;

    pedidosFiltrados = pedidos.filter((p) => {
      const coincideTexto =
        p.numero_pedido.toLowerCase().includes(texto) ||
        p.nombreCliente.toLowerCase().includes(texto);

      const coincideEstado =
        estado === "" ? true : String(p.id_estado_pedido) === estado;

      const coincideComercial =
        comercial === "" ? true : p.comercial === comercial;

      return coincideTexto && coincideEstado && coincideComercial;
    });

    // ORDENACIÓN

    if (ordenActual.campo) {
      pedidosFiltrados.sort((a, b) => {
        const valA = String(a[ordenActual.campo] ?? "").toLowerCase();

        const valB = String(b[ordenActual.campo] ?? "").toLowerCase();

        if (valA < valB) return ordenActual.asc ? -1 : 1;

        if (valA > valB) return ordenActual.asc ? 1 : -1;

        return 0;
      });
    }

    paginaActual = 1;

    paginar(pedidosFiltrados);
  }

  // EVENTOS FILTROS

  buscador.addEventListener("keyup", aplicarFiltros);

  filtroEstado.addEventListener("change", aplicarFiltros);

  buscadorComercial.addEventListener("change", aplicarFiltros);

  // ORDENACIÓN

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

      // LIMPIAR ICONOS

      document.querySelectorAll("thead th[data-campo]").forEach((el) => {
        el.innerHTML = el.innerHTML.replace(/ <i.*<\/i>/, "");
      });

      // ICONO

      const icono = ordenActual.asc
        ? `<i class="fas fa-sort-up"></i>`
        : `<i class="fas fa-sort-down"></i>`;

      th.innerHTML += ` ${icono}`;

      aplicarFiltros();
    });
  });

  // MODAL VER

  function abrirModalVer(id) {
    const pedido = pedidos.find((p) => p.id_pedido == id);

    if (!pedido) return;

    document.getElementById("ver_numero").textContent = pedido.numero_pedido;

    document.getElementById("ver_cliente").textContent = pedido.nombreCliente;

    document.getElementById("ver_fecha").textContent = pedido.fecha_pedido;

    document.getElementById("ver_estado").textContent = pedido.estado;

    document.getElementById("ver_total").textContent = pedido.total + " €";

    document.getElementById("ver_comercial").textContent = pedido.comercial;

    $("#modalVerPedido").modal("show");
  }

  // EVENTO BOTÓN VER

  document.addEventListener("click", (event) => {
    const btn = event.target.closest(".btn-ver");

    if (!btn) return;

    event.preventDefault();

    abrirModalVer(btn.dataset.id);
  });

  // INIT

  async function init() {
    await cargarDesplegables();

    await cargarPedidos();
  }

  init();
});
