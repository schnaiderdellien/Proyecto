document.addEventListener("DOMContentLoaded", () => {
  const formulario = document.querySelector("form");

  formulario.addEventListener("submit", (event) => {
    const passwordNueva = document.getElementById("password_nueva").value;

    const passwordConfirmar =
      document.getElementById("password_confirmar").value;

    if (passwordNueva !== passwordConfirmar) {
      event.preventDefault();

      alert("Las contraseñas no coinciden");
    }
  });
});
