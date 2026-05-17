document.addEventListener("DOMContentLoaded", async () => {
  const params = new URLSearchParams(window.location.search);

  const idPedido = params.get("id");

  const response = await fetch(`index.php?ctl=api_pedido_by_id&id=${idPedido}`);

  const result = await response.json();

  const pedido = result.pedido;

  const detalle = result.detalle;

  // CABECERA

  document.getElementById("titulo_numero_pedido").textContent =
    pedido.numero_pedido;

  document.getElementById("numero_pedido").textContent = pedido.numero_pedido;

  document.getElementById("estado_pedido").textContent = pedido.estado;

  document.getElementById("fecha_pedido").textContent = pedido.fecha_pedido;

  document.getElementById("comercial").textContent = pedido.comercial;

  document.getElementById("cliente").textContent = pedido.nombreCliente;

  document.getElementById("metodo_pago").textContent = pedido.metodo_pago;

  document.getElementById("impuesto").textContent =
    pedido.tipo_de_impuesto + " %";

  document.getElementById("notas").textContent = pedido.notas ?? "-";

  // TOTALES

  document.getElementById("bruto").textContent = pedido.bruto + " €";

  document.getElementById("descuento").textContent = pedido.descuento + " €";

  document.getElementById("total").textContent = pedido.total + " €";

  // IVA

  const iva =
    parseFloat(pedido.total) -
    (parseFloat(pedido.bruto) - parseFloat(pedido.descuento));

  document.getElementById("iva_impuesto").textContent = iva.toFixed(2) + " €";

  // DETALLE

  const tabla = document.getElementById("tabla-detalle");

  tabla.innerHTML = "";

  detalle.forEach((linea) => {
    tabla.innerHTML += `

            <tr>

                <td>${linea.sku_producto}</td>

                <td>${linea.nombre_producto}</td>

                <td>${linea.cantidad}</td>

                <td>${linea.cantidad_servida}</td>

                <td>${linea.precio_unitario} €</td>

                <td>${linea.descuento} €</td>

                <td>${linea.total} €</td>

            </tr>
        `;
  });
});
