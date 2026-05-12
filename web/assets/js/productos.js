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

  async function cargarProductos() {
    try {
      const response = await fetch("index.php?ctl=api_productos");
      const result = await response.json();

      productos = result.data;
      productosFiltrados = productos;
      userLevel = result.userLevel;

      paginar(productosFiltrados);
    } catch (error) {
      alert("Error al cargar productos");
    }
  }

  function renderizarTabla(data) {
    tabla.innerHTML = "";

    data.forEach((producto) => {
      const botonEditar =
        userLevel == 1 || userLevel == 2
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

  buscador.addEventListener("keyup", () => {
    const texto = buscador.value.toLowerCase();

    productosFiltrados = productos.filter(
      (p) =>
        p.sku.toLowerCase().includes(texto) ||
        p.nombre.toLowerCase().includes(texto) ||
        p.modelo.toLowerCase().includes(texto)
    );
    paginaActual = 1;
    paginar(productosFiltrados);
  });

  buscadorPrecio.addEventListener("keyup", () => {
    const numero = buscadorPrecio.value;

    productosFiltrados = productos.filter((p) =>
      String(p.precio_venta).includes(numero)
    );
    paginaActual = 1;
    paginar(productosFiltrados);
  });

  filtroEstado.addEventListener("change", () => {
    const estado = filtroEstado.value;

    productosFiltrados = productos.filter((p) =>
      estado === "" ? true : String(p.id_estado) === estado
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

  document.addEventListener("click", (event) => {
    const btn = event.target.closest(".btn-ver");
    if (!btn) return;
    event.preventDefault();
    abrirModalVer(btn.dataset.id);
  });

  cargarProductos();
});
