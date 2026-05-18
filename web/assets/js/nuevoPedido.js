document.addEventListener("DOMContentLoaded", () => {
  // VARIABLES

  const tablaDetalle = document.getElementById("tabla-detalle");

  let clientes = [];

  let comerciales = [];

  let metodosPago = [];

  let impuestos = [];

  let estados = [];

  let productos = [];

  // CARGAR DESPLEGABLES

  async function cargarDesplegables() {
    try {
      // CLIENTES

      const resClientes = await fetch("index.php?ctl=api_clientes");

      clientes = (await resClientes.json()).data;

      // COMERCIALES

      const resComerciales = await fetch("index.php?ctl=api_comerciales");

      comerciales = (await resComerciales.json()).data;

      // MÉTODOS PAGO

      const resMetodos = await fetch("index.php?ctl=api_metodo_pago");

      metodosPago = (await resMetodos.json()).data;

      // IMPUESTOS

      const resImpuestos = await fetch("index.php?ctl=api_impuestos");

      impuestos = (await resImpuestos.json()).data;

      // ESTADOS

      const resEstados = await fetch("index.php?ctl=api_estados_pedido");

      estados = (await resEstados.json()).data;

      // PRODUCTOS

      const resProductos = await fetch("index.php?ctl=api_productos");

      productos = (await resProductos.json()).data;

      renderizarDesplegables();

      renderizarListasProductos();
    } catch (error) {
      console.error(error);

      alert("Error al cargar datos");
    }
  }

  // RENDER DESPLEGABLES

  function renderizarDesplegables() {
    // CLIENTES

    const selectCliente = document.getElementById("id_cliente");

    selectCliente.innerHTML = '<option value="">Seleccione cliente</option>';

    clientes.forEach((cliente) => {
      selectCliente.innerHTML += `

                <option value="${cliente.id_cliente}">
                    ${cliente.nombreCliente}
                </option>

            `;
    });

    // COMERCIALES

    const selectComercial = document.getElementById("id_usuario");

    selectComercial.innerHTML = "";

    comerciales.forEach((comercial) => {
      selectComercial.innerHTML += `

                <option value="${comercial.id_usuario}">
                    ${comercial.nombre}
                </option>

            `;
    });

    // MÉTODOS PAGO

    const selectMetodo = document.getElementById("id_metodo_pago");

    selectMetodo.innerHTML = "";

    metodosPago.forEach((metodo) => {
      selectMetodo.innerHTML += `

                <option value="${metodo.id_metodo_pago}">
                    ${metodo.metodo_pago}
                </option>

            `;
    });

    // IMPUESTOS

    const selectImpuesto = document.getElementById("id_impuesto");

    selectImpuesto.innerHTML = "";

    impuestos.forEach((impuesto) => {
      selectImpuesto.innerHTML += `

                <option value="${impuesto.id_impuesto}">
                    ${impuesto.tipo_de_impuesto}
                </option>

            `;
    });

    // ESTADOS

    const selectEstado = document.getElementById("id_estado_pedido");

    selectEstado.innerHTML = "";

    estados.forEach((estado) => {
      selectEstado.innerHTML += `

                <option
                    value="${estado.id_estado_pedido}"
                    ${estado.id_estado_pedido == 1 ? "selected" : ""}
                >
                    ${estado.estado}
                </option>

            `;
    });
  }

  // RENDER DATALIST PRODUCTOS

  function renderizarListasProductos() {
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
  }

  // DATOS INICIALES NUEVO PEDIDO

  async function cargarDatosIniciales() {
    try {
      const response = await fetch("index.php?ctl=api_nuevo_pedido");

      const data = await response.json();

      // NUMERO PEDIDO

      document.getElementById("titulo_numero_pedido").textContent =
        data.numero_pedido;

      document.getElementById("numero_pedido").value = data.numero_pedido;

      // FECHA

      document.getElementById("fecha_pedido").value = data.fecha_pedido;

      // ESTADO

      document.getElementById("id_estado_pedido").value = data.id_estado_pedido;
    } catch (error) {
      console.error(error);

      alert("Error al generar pedido");
    }
  }

  // AUTOCOMPLETAR CLIENTE

  document.addEventListener("change", (e) => {
    if (e.target.id !== "id_cliente") return;

    const cliente = clientes.find((c) => c.id_cliente == e.target.value);

    if (!cliente) return;

    // COMERCIAL

    document.getElementById("id_usuario").value = cliente.id_usuario;

    // MÉTODO PAGO

    document.getElementById("id_metodo_pago").value = cliente.id_metodo_pago;

    // IMPUESTO

    document.getElementById("id_impuesto").value = cliente.id_impuesto;

    calcularTotales();
  });

  // añadir línea

  document.getElementById("btnAgregarLinea").addEventListener("click", () => {
    const fila = document.createElement("tr");

    fila.dataset.new = "1";

    fila.innerHTML = `

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

            <button class="btn btn-danger btn-sm btn-borrar-linea">

                <i class="fas fa-trash"></i>

            </button>

        </td>

    `;

    tablaDetalle.appendChild(fila);
  });
  // BORRAR LINEA

  document.addEventListener("click", (e) => {
    const btn = e.target.closest(".btn-borrar-linea");

    if (!btn) return;

    const fila = btn.closest("tr");

    fila.remove();

    calcularTotales();
  });

  // AUTOCOMPLETAR POR SKU

  document.addEventListener("change", (e) => {
    if (!e.target.classList.contains("sku")) return;

    const fila = e.target.closest("tr");

    const producto = productos.find((p) => p.sku == e.target.value);

    if (!producto) return;

    fila.dataset.idProducto = producto.id_productos;

    fila.querySelector(".producto").value = producto.nombre;

    fila.querySelector(".precio").value = producto.precio_venta;

    recalcularFila(fila);
  });

  // AUTOCOMPLETAR POR PRODUCTO

  document.addEventListener("change", (e) => {
    if (!e.target.classList.contains("producto")) return;

    const fila = e.target.closest("tr");

    const producto = productos.find((p) => p.nombre == e.target.value);

    if (!producto) return;

    fila.dataset.idProducto = producto.id_productos;

    fila.querySelector(".sku").value = producto.sku;

    fila.querySelector(".precio").value = producto.precio_venta;

    recalcularFila(fila);
  });

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

  // EVENTOS RECALCULAR

  document.addEventListener("input", (e) => {
    const fila = e.target.closest("tr");

    if (!fila) return;

    if (
      e.target.classList.contains("cantidad") ||
      e.target.classList.contains("precio") ||
      e.target.classList.contains("descuento")
    ) {
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

    const porcentajeIVA = parseFloat(
      selectImpuesto.options[selectImpuesto.selectedIndex]?.text || 0,
    );

    const iva = totalSinIVA * (porcentajeIVA / 100);

    const totalFinal = totalSinIVA + iva;

    // PINTAR

    document.getElementById("bruto").textContent = bruto.toFixed(2) + " €";

    document.getElementById("descuento").textContent =
      descuentoTotal.toFixed(2) + " €";

    document.getElementById("iva_impuesto").textContent = iva.toFixed(2) + " €";

    document.getElementById("total").textContent = totalFinal.toFixed(2) + " €";
  }

  // CAMBIO IVA

  document
    .getElementById("id_impuesto")
    .addEventListener("change", calcularTotales);

  // GUARDAR PEDIDO

  document
    .getElementById("btnGuardarPedido")
    .addEventListener("click", async () => {
      const lineas = [];

      document.querySelectorAll("#tabla-detalle tr").forEach((fila) => {
        lineas.push({
          id_productos: fila.dataset.idProducto,

          cantidad: fila.querySelector(".cantidad").value,

          cantidad_servida: fila.querySelector(".cantidad-servida").value,

          precio_unitario: fila.querySelector(".precio").value,

          descuento: fila.querySelector(".descuento").value,
        });
      });

      const data = {
        numero_pedido: document.getElementById("numero_pedido").value,

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
        const response = await fetch("index.php?ctl=crearPedido", {
          method: "POST",

          headers: {
            "Content-Type": "application/json",
          },

          body: JSON.stringify(data),
        });

        const result = await response.json();

        if (result.success) {
          alert("Pedido creado correctamente");

          window.location.href = `index.php?ctl=editarPedido&id=${result.id_pedido}`;
        } else {
          alert(result.error);
        }
      } catch (error) {
        console.error(error);

        alert("Error del servidor");
      }
    });

  // INIT

  async function init() {
    await cargarDesplegables();

    await cargarDatosIniciales();
  }

  init();
});
