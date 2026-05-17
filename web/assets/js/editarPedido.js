document.addEventListener("DOMContentLoaded", () => {
  const tablaDetalle = document.getElementById("tabla-detalle");

  let pedido = {};
  let detalle = [];

  let clientes = [];
  let comerciales = [];
  let estados = [];
  let metodosPago = [];
  let impuestos = [];
  let productos = [];

  // OBTENER ID PEDIDO

  const params = new URLSearchParams(window.location.search);

  const idPedido = params.get("id");

  // CARGAR DESPLEGABLES

  async function cargarDesplegables() {
    try {
      // CLIENTES

      const resClientes = await fetch("index.php?ctl=api_clientes");

      clientes = (await resClientes.json()).data;

      // COMERCIALES

      const resComerciales = await fetch("index.php?ctl=api_comerciales");

      comerciales = (await resComerciales.json()).data;

      // ESTADOS

      const resEstados = await fetch("index.php?ctl=api_estados_pedido");

      estados = (await resEstados.json()).data;

      // MÉTODOS PAGO

      const resMetodos = await fetch("index.php?ctl=api_metodo_pago");

      metodosPago = (await resMetodos.json()).data;

      // IMPUESTOS

      const resImpuestos = await fetch("index.php?ctl=api_impuestos");

      impuestos = (await resImpuestos.json()).data;

      // PRODUCTOS
      const resProductos = await fetch("index.php?ctl=api_productos");

      productos = (await resProductos.json()).data;

      // RELLENAR LISTAS DE AUTOCOMPLETADO

      const listaSkus = document.getElementById("lista-skus");

      const listaProductos = document.getElementById("lista-productos");

      listaSkus.innerHTML = "";

      listaProductos.innerHTML = "";

      productos.forEach((producto) => {
        listaSkus.innerHTML += `
        <option value="${producto.sku}">
      `;

        listaProductos.innerHTML += `
          <option value="${producto.nombre}">
      `;
      });
    } catch (error) {
      console.error(error);

      alert("Error al cargar desplegables");
    }
  }

  // CARGAR PEDIDO

  async function cargarPedido() {
    try {
      const response = await fetch(
        `index.php?ctl=api_pedido_by_id&id=${idPedido}`,
      );

      const result = await response.json();

      pedido = result.pedido;

      detalle = result.detalle;

      renderizarCabecera();

      renderizarDetalle();
    } catch (error) {
      console.error(error);

      alert("Error al cargar pedido");
    }
  }

  // RENDER CABECERA

  function renderizarCabecera() {
    //Tabla de pedido de la base de datos.

    // TITULO

    document.getElementById("titulo_numero_pedido").textContent =
      pedido.numero_pedido ?? "";

    // NUMERO PEDIDO

    document.getElementById("numero_pedido").value = pedido.numero_pedido ?? "";

    // FECHA

    document.getElementById("fecha_pedido").value = pedido.fecha_pedido ?? "";

    // NOTAS

    document.getElementById("notas").value = pedido.notas ?? "";

    // CLIENTES

    const selectCliente = document.getElementById("id_cliente");

    selectCliente.innerHTML = "";

    clientes.forEach((cliente) => {
      const option = document.createElement("option");

      option.value = cliente.id_cliente;

      option.textContent = cliente.nombreCliente;

      option.selected = cliente.id_cliente == pedido.id_cliente;

      selectCliente.appendChild(option);
    });

    // COMERCIALES

    const selectComercial = document.getElementById("id_usuario");

    selectComercial.innerHTML = "";

    comerciales.forEach((comercial) => {
      const option = document.createElement("option");

      option.value = comercial.id_usuario;

      option.textContent = comercial.nombre;

      option.selected = comercial.id_usuario == pedido.id_usuario;

      selectComercial.appendChild(option);
    });

    // ESTADOS

    const selectEstado = document.getElementById("id_estado_pedido");

    selectEstado.innerHTML = "";

    estados.forEach((estado) => {
      const option = document.createElement("option");

      option.value = estado.id_estado_pedido;

      option.textContent = estado.estado;

      option.selected = estado.id_estado_pedido == pedido.id_estado_pedido;

      selectEstado.appendChild(option);
    });

    // MÉTODOS PAGO

    const selectMetodo = document.getElementById("id_metodo_pago");

    selectMetodo.innerHTML = "";

    metodosPago.forEach((metodo) => {
      const option = document.createElement("option");

      option.value = metodo.id_metodo_pago;

      option.textContent = metodo.metodo_pago;

      option.selected = metodo.id_metodo_pago == pedido.id_metodo_pago;

      selectMetodo.appendChild(option);
    });

    // IMPUESTOS

    const selectImpuesto = document.getElementById("id_impuesto");

    selectImpuesto.innerHTML = "";

    impuestos.forEach((impuesto) => {
      const option = document.createElement("option");

      option.value = impuesto.id_impuesto;

      option.textContent = impuesto.tipo_de_impuesto;

      option.selected = impuesto.id_impuesto == pedido.id_impuesto;

      selectImpuesto.appendChild(option);
    });
    // Mostrar tipo de impuesto seleccionado
    const impuestoSeleccionado = impuestos.find(
      (i) => i.id_impuesto == pedido.id_impuesto,
    );
    document.getElementById("iva_impuesto").textContent = impuestoSeleccionado
      ? impuestoSeleccionado.tipo_de_impuesto + " %"
      : "-";

    // TOTALES

    document.getElementById("bruto").textContent = pedido.bruto + " €";

    document.getElementById("descuento").textContent = pedido.descuento + " €";

    document.getElementById("total").textContent = pedido.total + " €";
  }

  // RENDER DETALLE

  function renderizarDetalle() {
    tablaDetalle.innerHTML = "";

    detalle.forEach((linea) => {
      tablaDetalle.innerHTML += `

            <tr data-id="${linea.id_detalle_pedido}">

                <!-- SKU -->

                <td>

                    <input type="text"
                           class="form-control sku"
                           value="${linea.sku_producto ?? ""}"
                           readonly>

                </td>

                <!-- PRODUCTO -->

                <td>

                    <input type="text"
                           class="form-control producto"
                           value="${linea.nombre_producto ?? ""}"
                           readonly>

                </td>

                <!-- CANTIDAD -->

                <td>

                    <input type="number"
                           class="form-control cantidad"
                           value="${linea.cantidad}">

                </td>

                <!-- SERVIDO -->

                <td>

                    <input type="number"
                           class="form-control cantidad-servida"
                           value="${linea.cantidad_servida}">

                </td>

                <!-- PRECIO -->

                <td>

                    <input type="number"
                           step="0.01"
                           class="form-control precio"
                           value="${linea.precio_unitario}">

                </td>

                <!-- DESCUENTO -->

                <td>

                    <input type="number"
                           step="0.01"
                           class="form-control descuento"
                           value="${linea.descuento}">

                </td>

                <!-- TOTAL -->

                <td>

                    <input type="text"
                           class="form-control total-linea"
                           value="${parseFloat(linea.total).toFixed(2)} €"
                           readonly>

                </td>

                <!-- ACCIONES -->

                <td class="text-nowrap">

                    <!-- GUARDAR -->

                    <button class="btn btn-warning btn-sm btn-guardar-linea">

                        <i class="fas fa-save"></i>

                    </button>

                    <!-- BORRAR -->

                    <button class="btn btn-danger btn-sm btn-borrar-linea">

                        <i class="fas fa-trash"></i>

                    </button>

                </td>

            </tr>
            `;
    });

    calcularTotales();
  }

  // RECALCULAR TOTAL LINEA

  document.addEventListener("input", (e) => {
    const fila = e.target.closest("tr");

    if (!fila) return;

    if (
      e.target.classList.contains("cantidad") ||
      e.target.classList.contains("precio") ||
      e.target.classList.contains("descuento")
    ) {
      const cantidad = parseFloat(fila.querySelector(".cantidad").value) || 0;

      const precio = parseFloat(fila.querySelector(".precio").value) || 0;

      const descuento = parseFloat(fila.querySelector(".descuento").value) || 0;

      const subtotal = cantidad * precio;

      const total = subtotal - descuento;

      fila.querySelector(".total-linea").value = total.toFixed(2) + " €";

      calcularTotales();
    }
  });

  // AUTOCOMPLETAR POR SKU

  document.addEventListener("change", (e) => {
    // SKU

    if (e.target.classList.contains("sku")) {
      const fila = e.target.closest("tr");

      const sku = e.target.value;

      const producto = productos.find((p) => p.sku == sku);

      if (!producto) return;

      // GUARDAR ID PRODUCTO

      fila.dataset.idProducto = producto.id_productos;

      // AUTORELLENAR

      fila.querySelector(".producto").value = producto.nombre;

      fila.querySelector(".precio").value = producto.precio_venta;

      recalcularFila(fila);
    }
  });

  // AUTOCOMPLETAR POR NOMBRE

  document.addEventListener("change", (e) => {
    // PRODUCTO

    if (e.target.classList.contains("producto")) {
      const fila = e.target.closest("tr");

      const nombre = e.target.value;

      const producto = productos.find((p) => p.nombre == nombre);

      if (!producto) return;

      // GUARDAR ID PRODUCTO

      fila.dataset.idProducto = producto.id_productos;

      // AUTORELLENAR

      fila.querySelector(".sku").value = producto.sku;

      fila.querySelector(".precio").value = producto.precio_venta;

      recalcularFila(fila);
    }
  });

  // CALCULAR TOTALES

  function calcularTotales() {
    let bruto = 0;

    let descuentoTotal = 0;

    let totalSinIVA = 0;

    document.querySelectorAll("#tabla-detalle tr").forEach((fila) => {
      const cantidad = parseFloat(fila.querySelector(".cantidad").value) || 0;

      const precio = parseFloat(fila.querySelector(".precio").value) || 0;

      const descuento = parseFloat(fila.querySelector(".descuento").value) || 0;

      const subtotal = cantidad * precio;

      const totalLinea = subtotal - descuento;

      bruto += subtotal;

      descuentoTotal += descuento;

      totalSinIVA += totalLinea;
    });

    // IVA

    const selectImpuesto = document.getElementById("id_impuesto");

    const optionSeleccionada =
      selectImpuesto.options[selectImpuesto.selectedIndex];

    const porcentajeIVA = parseFloat(optionSeleccionada.textContent) || 0;

    const iva = totalSinIVA * (porcentajeIVA / 100);

    const totalFinal = totalSinIVA + iva;

    // PINTAR TOTALES

    document.getElementById("bruto").textContent = bruto.toFixed(2) + " €";

    document.getElementById("descuento").textContent =
      descuentoTotal.toFixed(2) + " €";

    document.getElementById("iva_impuesto").textContent = iva.toFixed(2) + " €";

    document.getElementById("total").textContent = totalFinal.toFixed(2) + " €";

    document
      .getElementById("id_impuesto")
      .addEventListener("change", calcularTotales);
  }

  // RECALCULAR FILA

  function recalcularFila(fila) {
    const cantidad = parseFloat(fila.querySelector(".cantidad").value) || 0;

    const precio = parseFloat(fila.querySelector(".precio").value) || 0;

    const descuento = parseFloat(fila.querySelector(".descuento").value) || 0;

    const subtotal = cantidad * precio;

    const total = subtotal - descuento;

    fila.querySelector(".total-linea").value = total.toFixed(2) + " €";

    calcularTotales();
  }

  // BORRAR LINEA

  document.addEventListener("click", (e) => {
    const btn = e.target.closest(".btn-borrar-linea");

    if (!btn) return;

    const fila = btn.closest("tr");

    fila.dataset.deleted = "1";

    fila.style.display = "none";

    calcularTotales();
  });

  // GUARDAR LINEA

  document.addEventListener("click", async (e) => {
    const btn = e.target.closest(".btn-guardar-linea");

    if (!btn) return;

    const fila = btn.closest("tr");

    const data = {
      id_detalle_pedido: fila.dataset.id,

      cantidad: fila.querySelector(".cantidad").value,

      cantidad_servida: fila.querySelector(".cantidad-servida").value,

      precio_unitario: fila.querySelector(".precio").value,

      descuento: fila.querySelector(".descuento").value,
    };

    try {
      const response = await fetch("index.php?ctl=guardarLineaPedido", {
        method: "POST",

        headers: {
          "Content-Type": "application/json",
        },

        body: JSON.stringify(data),
      });

      const result = await response.json();

      if (result.success) {
        alert("Línea guardada correctamente");
        location.reload();
      } else {
        alert("Error al guardar línea");
      }
    } catch (error) {
      console.error(error);

      alert("Error del servidor");
    }
  });

  // AÑADIR LINEA

  document.getElementById("btnAgregarLinea").addEventListener("click", () => {
    tablaDetalle.innerHTML += `

            <tr data-new="1">

                <td>

                      <input type="text"
                            class="form-control sku"
                            list="lista-skus"
                            placeholder="SKU">

                </td>

                <td>

                      <input type="text"
                            class="form-control producto"
                            list="lista-productos"
                            placeholder="Producto">

                </td>

                <td>

                    <input type="number"
                           class="form-control cantidad"
                           value="1">

                </td>

                <td>

                    <input type="number"
                           class="form-control cantidad-servida"
                           value="0">

                </td>

                <td>

                    <input type="number"
                           step="0.01"
                           class="form-control precio"
                           value="0">

                </td>

                <td>

                    <input type="number"
                           step="0.01"
                           class="form-control descuento"
                           value="0">

                </td>

                <td>

                    <input type="text"
                           class="form-control total-linea"
                           value="0.00 €"
                           readonly>

                </td>

                <td class="text-nowrap">

                    <button class="btn btn-warning btn-sm btn-guardar-linea">

                        <i class="fas fa-save"></i>

                    </button>

                    <button class="btn btn-danger btn-sm btn-borrar-linea">

                        <i class="fas fa-trash"></i>

                    </button>

                </td>

            </tr>
            `;
  });

  //guardar pedido

  document
    .getElementById("btnGuardarPedido")
    .addEventListener("click", async () => {
      const lineas = [];

      document.querySelectorAll("#tabla-detalle tr").forEach((fila) => {
        lineas.push({
          id_detalle_pedido: fila.dataset.id,

          cantidad: fila.querySelector(".cantidad").value,

          cantidad_servida: fila.querySelector(".cantidad-servida").value,

          precio_unitario: fila.querySelector(".precio").value,

          descuento: fila.querySelector(".descuento").value,

          nueva: fila.dataset.new == "1",

          eliminada: fila.dataset.deleted == "1",

          id_productos: fila.dataset.idProducto,
        });
      });

      const data = {
        id_pedido: idPedido,

        id_cliente: document.getElementById("id_cliente").value,

        id_usuario: document.getElementById("id_usuario").value,

        id_estado_pedido: document.getElementById("id_estado_pedido").value,

        id_metodo_pago: document.getElementById("id_metodo_pago").value,

        id_impuesto: document.getElementById("id_impuesto").value,

        fecha_pedido: document.getElementById("fecha_pedido").value,

        notas: document.getElementById("notas").value,

        bruto: document
          .getElementById("bruto")
          .textContent.replace("€", "")
          .trim(),

        descuento: document
          .getElementById("descuento")
          .textContent.replace("€", "")
          .trim(),

        total: document
          .getElementById("total")
          .textContent.replace("€", "")
          .trim(),

        lineas,
      };

      try {
        const response = await fetch("index.php?ctl=guardarPedido", {
          method: "POST",

          headers: {
            "Content-Type": "application/json",
          },

          body: JSON.stringify(data),
        });

        const result = await response.json();

        if (result.success) {
          alert("Pedido guardado correctamente");
        } else {
          alert("Error al guardar pedido");
        }
      } catch (error) {
        console.error(error);

        alert("Error del servidor");
      }
    });

  // INIT

  async function init() {
    await cargarDesplegables();

    await cargarPedido();
  }

  init();
});
