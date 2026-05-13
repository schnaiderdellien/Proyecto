document.addEventListener("DOMContentLoaded", () => {
  const tabla = document.getElementById("tabla-productos");
  const buscador = document.getElementById("buscador");
  const buscadorPrecio = document.getElementById("buscadorPrecio");
  const filtroEstado = document.getElementById("filtroEstado");

  let productos = [];
  let productosFiltrados = [];
  let userLevel = 0;
  let ordenActual = { campo: null, asc: true };
  let paginaActual = 1;
  const porPagina = 10;
  // FUNCIONES

  // función para cargar productos desde la API
  async function cargarProductos() {
    try {
      const response = await fetch("index.php?ctl=api_productos");
      const result = await response.json();

      productos = result.data;
      productosFiltrados = productos;
      userLevel = result.userLevel;
      renderizarBotonNuevo();

      paginar(productosFiltrados);
    } catch (error) {
      alert("Error al cargar productos");
    }
  }

  // función para renderizar la tabla de productos
  function renderizarTabla(data) {
    tabla.innerHTML = "";

    data.forEach((producto) => {
      const botonEditar =
        userLevel == 3 || userLevel == 4
          ? `<a href="#" class="btn btn-warning btn-sm btn-editar" data-id="${producto.id_productos}"><i class="fas fa-edit"></i></a>`
          : "";

      const fila = `
          <tr>
            <td>${producto.sku}</td>
            <td>${producto.nombre}</td>
            <td>${producto.modelo}</td>
            <td>${producto.precio_venta}</td>
            <td>${producto.stock}</td>
            <td>${producto.id_estado == 1 ? "Activo" : "Inactivo"}</td>
            <td class="text-nowrap"> 
                <a href="#" class="btn btn-info btn-sm btn-ver" data-id="${
                  producto.id_productos
                }"><i class="fas fa-eye"></i></a> 
                ${botonEditar}
            </td>
          </tr>
        `;
      tabla.innerHTML += fila;
    });
  }

  //para que se ve el botón de nuevo producto solo a los niveles 3 y 4

  function renderizarBotonNuevo() {
    const contenedor = document.getElementById("contenedor-boton-nuevo");

    if (userLevel == 3 || userLevel == 4) {
      contenedor.innerHTML = `
            <button class="btn btn-primary mb-3" id="btnNuevoProducto">
                Nuevo producto
            </button>
        `;

      document
        .getElementById("btnNuevoProducto")
        .addEventListener("click", abrirModalNuevo);
    }
  }

  // paginador
  function paginar(data) {
    const totalPaginas = Math.ceil(data.length / porPagina);
    const inicio = (paginaActual - 1) * porPagina;
    const fin = inicio + porPagina;

    renderizarTabla(data.slice(inicio, fin));
    renderizarPaginador(totalPaginas, data);
  }

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

  // buscadores y filtros
  buscador.addEventListener("keyup", () => {
    const texto = buscador.value.toLowerCase();

    productosFiltrados = productos.filter(
      (p) =>
        p.sku.toLowerCase().includes(texto) ||
        p.nombre.toLowerCase().includes(texto) ||
        p.modelo.toLowerCase().includes(texto),
    );
    paginaActual = 1;
    paginar(productosFiltrados);
  });

  buscadorPrecio.addEventListener("keyup", () => {
    const numero = buscadorPrecio.value;

    productosFiltrados = productos.filter((p) =>
      String(p.precio_venta).includes(numero),
    );
    paginaActual = 1;
    paginar(productosFiltrados);
  });

  filtroEstado.addEventListener("change", () => {
    const estado = filtroEstado.value;

    productosFiltrados = productos.filter((p) =>
      estado === "" ? true : String(p.id_estado) === estado,
    );
    paginaActual = 1;
    paginar(productosFiltrados);
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

      productosFiltrados = [...productosFiltrados].sort((a, b) => {
        const valA = String(a[campo] ?? "").toLowerCase();
        const valB = String(b[campo] ?? "").toLowerCase();

        if (valA < valB) return ordenActual.asc ? -1 : 1;
        if (valA > valB) return ordenActual.asc ? 1 : -1;
        return 0;
      });

      paginaActual = 1;
      paginar(productosFiltrados);
    });
  });

  // función para abrir modal de ver producto
  function abrirModalVer(id) {
    const producto = productos.find((p) => p.id_productos == id);
    if (!producto) return;

    document.getElementById("ver_id").textContent = producto.id_productos;
    document.getElementById("ver_sku").textContent = producto.sku;
    document.getElementById("ver_nombre").textContent = producto.nombre;
    document.getElementById("ver_desc_corta").textContent =
      producto.descripcion_corta ?? "-";
    document.getElementById("ver_desc_larga").textContent =
      producto.descripcion_larga ?? "-";
    document.getElementById("ver_modelo").textContent = producto.modelo ?? "-";
    document.getElementById("ver_precio_coste").textContent =
      producto.precio_coste ?? "-";
    document.getElementById("ver_precio_venta").textContent =
      producto.precio_venta ?? "-";
    document.getElementById("ver_moneda").textContent = producto.moneda ?? "-";
    document.getElementById("ver_stock").textContent = producto.stock ?? "-";
    document.getElementById("ver_stock_min").textContent =
      producto.stock_minimo ?? "-";
    document.getElementById("ver_stock_max").textContent =
      producto.stock_maximo ?? "-";
    document.getElementById("ver_estado").textContent =
      producto.id_estado == 1 ? "Activo" : "Inactivo";
    document.getElementById("ver_fecha_alta").textContent =
      producto.fecha_de_alta ?? "-";
    document.getElementById("ver_fecha_baja").textContent =
      producto.fecha_de_baja ?? "-";

    $("#modalProductoVer").modal("show");
  }

  // función para abrir modal de editar producto

  function abrirModalEditar(id) {
    const producto = productos.find((p) => p.id_productos == id);

    if (!producto) return;

    document.getElementById("edit_id").textContent = producto.id_productos;
    document.getElementById("edit_id_hidden").value = producto.id_productos;
    document.getElementById("edit_sku").value = producto.sku ?? "";
    document.getElementById("edit_nombre").value = producto.nombre ?? "";
    document.getElementById("edit_desc_corta").value =
      producto.descripcion_corta ?? "";
    document.getElementById("edit_desc_larga").value =
      producto.descripcion_larga ?? "";
    document.getElementById("edit_modelo").value = producto.modelo ?? "";
    document.getElementById("edit_precio_coste").value =
      producto.precio_coste ?? "";
    document.getElementById("edit_precio_venta").value =
      producto.precio_venta ?? "";
    document.getElementById("edit_moneda").value = producto.moneda ?? "";
    document.getElementById("edit_stock").value = producto.stock ?? "";
    document.getElementById("edit_stock_min").value =
      producto.stock_minimo ?? "";
    document.getElementById("edit_stock_max").value =
      producto.stock_maximo ?? "";
    document.getElementById("edit_fecha_alta").value =
      producto.fecha_de_alta ?? "";
    document.getElementById("edit_fecha_baja").value =
      producto.fecha_de_baja ?? "-";
    document.getElementById("edit_estado").value = producto.id_estado;

    $("#modalProductoEditar").modal("show");
  }

  // FUNCIÓN PARA ABRIR MODAL NUEVO

  function abrirModalNuevo() {
    document.getElementById("nuevo_sku").value = "";
    document.getElementById("nuevo_nombre").value = "";
    document.getElementById("nuevo_desc_corta").value = "";
    document.getElementById("nuevo_desc_larga").value = "";
    document.getElementById("nuevo_modelo").value = "";
    document.getElementById("nuevo_precio_coste").value = "";
    document.getElementById("nuevo_precio_venta").value = "";
    document.getElementById("nuevo_moneda").value = "EUR";
    document.getElementById("nuevo_stock").value = "";
    document.getElementById("nuevo_stock_min").value = "";
    document.getElementById("nuevo_stock_max").value = "";
    document.getElementById("nuevo_estado").value = 1;
    document.getElementById("nuevo_fecha_alta").value = new Date()
      .toISOString()
      .split("T")[0];

    document.getElementById("nuevo_fecha_baja").textContent = "-";

    $("#modalProductoNuevo").modal("show");
  }

  // validaciones para el formulario de nuevo producto

  const formNuevoProducto = document.querySelector("#modalProductoNuevo form");

  formNuevoProducto.addEventListener("submit", (e) => {
    limpiarErrores(formNuevoProducto);

    let valido = true;

    valido =
      validarTexto(document.getElementById("nuevo_sku"), 2, 30) && valido;

    valido =
      validarTexto(document.getElementById("nuevo_nombre"), 2, 50) && valido;

    valido =
      validarTexto(document.getElementById("nuevo_desc_corta"), 2, 100) &&
      valido;

    valido =
      validarTexto(document.getElementById("nuevo_desc_larga"), 2, 200) &&
      valido;

    valido =
      validarTexto(document.getElementById("nuevo_modelo"), 1, 50) && valido;

    valido =
      validarDecimal(document.getElementById("nuevo_precio_coste")) && valido;

    valido =
      validarDecimal(document.getElementById("nuevo_precio_venta")) && valido;

    valido =
      validarTexto(document.getElementById("nuevo_moneda"), 1, 10) && valido;

    valido = validarNumero(document.getElementById("nuevo_stock")) && valido;

    valido =
      validarNumero(document.getElementById("nuevo_stock_min")) && valido;

    valido =
      validarNumero(document.getElementById("nuevo_stock_max")) && valido;

    valido = validarSelect(document.getElementById("nuevo_estado")) && valido;

    if (!valido) {
      e.preventDefault();
    }
  });

  // validaciones para el formulario de editar producto

  const formEditarProducto = document.querySelector(
    "#modalProductoEditar form",
  );

  formEditarProducto.addEventListener("submit", (e) => {
    limpiarErrores(formEditarProducto);

    let valido = true;

    valido = validarTexto(document.getElementById("edit_sku"), 2, 30) && valido;

    valido =
      validarTexto(document.getElementById("edit_nombre"), 2, 50) && valido;

    valido =
      validarTexto(document.getElementById("edit_desc_corta"), 2, 100) &&
      valido;

    valido =
      validarTexto(document.getElementById("edit_desc_larga"), 2, 200) &&
      valido;

    valido =
      validarTexto(document.getElementById("edit_modelo"), 1, 50) && valido;

    valido =
      validarDecimal(document.getElementById("edit_precio_coste")) && valido;

    valido =
      validarDecimal(document.getElementById("edit_precio_venta")) && valido;

    valido =
      validarTexto(document.getElementById("edit_moneda"), 1, 10) && valido;

    valido = validarNumero(document.getElementById("edit_stock")) && valido;

    valido = validarNumero(document.getElementById("edit_stock_min")) && valido;

    valido = validarNumero(document.getElementById("edit_stock_max")) && valido;

    valido = validarSelect(document.getElementById("edit_estado")) && valido;

    if (!valido) {
      e.preventDefault();
    }
  });

  // Resetear formularios al cerrar modales

  $("#modalProductoNuevo").on("hidden.bs.modal", function () {
    resetearFormulario("formNuevoProducto");
  });

  $("#modalProductoEditar").on("hidden.bs.modal", function () {
    resetearFormulario("formEditarProducto");
  });

  // Escuchadores para botones de editar y ver

  document.addEventListener("click", (event) => {
    const btn = event.target.closest(".btn-editar");

    if (!btn) return;

    event.preventDefault();

    abrirModalEditar(btn.dataset.id);
  });

  document.addEventListener("click", (event) => {
    const btn = event.target.closest(".btn-ver");
    if (!btn) return;
    event.preventDefault();
    abrirModalVer(btn.dataset.id);
  });

  cargarProductos();
});
