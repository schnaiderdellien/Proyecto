document.addEventListener("DOMContentLoaded", () => {
  const formulario = document.getElementById("formCambiarPassword");

  formulario.addEventListener("submit", (e) => {
    limpiarErrores(formulario);

    let valido = true;

    // Validamos la contraseña actual

    valido =
      validarPassword(document.getElementById("password_actual"), 6, 100) &&
      valido;

    // Validamos la nueva contraseña

    valido =
      validarPassword(document.getElementById("password_nueva"), 6, 100) &&
      valido;

    // Confirmar nueva contraseña

    valido =
      validarPassword(document.getElementById("password_confirmar"), 6, 100) &&
      valido;

    // Comprobamos las contraseñas nuevas coinciden

    const passwordNueva = document.getElementById("password_nueva");

    const passwordConfirmar = document.getElementById("password_confirmar");

    if (passwordNueva.value !== passwordConfirmar.value) {
      mostrarError(passwordConfirmar, "Las contraseñas no coinciden");

      valido = false;
    }

    // SI HAY ERRORES

    if (!valido) {
      e.preventDefault();
    }
  });
});
