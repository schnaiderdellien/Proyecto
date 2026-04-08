document.addEventListener("DOMContentLoaded", () => {
  const tabla = document.getElementById("tabla-clientes");
  const buscador = document.getElementById("buscador");

  let clientes = [];
  let userLevel = 0;

  async function cargarClientes() {
    try {
      const response = await fetch("index.php?ctl=api_clientes");
      const result = await response.json();

      clientes = result.data;
      userLevel = result.userLevel;

      renderizarTabla(clientes);
    } catch (error) {
      alert("Error al cargar clientes");
    }
  }

  function renderizarTabla(data) {
    tabla.innerHTML = "";

    data.forEach((cliente) => {
      const botonEditar =
        userLevel == 1 || userLevel == 2
          ? `<a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>`
          : "";

      const fila = `
          <tr>
            <td>${cliente.id_cliente}</td>
            <td>${cliente.nombre}</td>
            <td>${cliente.email}</td>
            <td>${cliente.telefono}</td>
            <td>${cliente.activo == 1 ? "Activo" : "Inactivo"}</td>
            <td 
                class="text-nowrap"> 
                <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a> 
                ${botonEditar}
            </td>
          </tr>
        `;
      tabla.innerHTML += fila;
    });
  }

  buscador.addEventListener("keyup", () => {
    const texto = buscador.value.toLowerCase();

    const filtrados = clientes.filter(
      (c) =>
        c.nombre.toLowerCase().includes(texto) ||
        c.email.toLowerCase().includes(texto)
    );
    renderizarTabla(filtrados);
  });

  cargarClientes();
});
