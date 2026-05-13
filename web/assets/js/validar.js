function mostrarError(input, mensaje) {
  input.classList.add("is-invalid");

  let error = input.nextElementSibling;

  if (!error || !error.classList.contains("error-validacion")) {
    error = document.createElement("small");

    error.classList.add("text-danger", "error-validacion");

    input.parentNode.appendChild(error);
  }

  error.textContent = mensaje;
}

function limpiarErrores(formulario) {
  formulario
    .querySelectorAll(".is-invalid")
    .forEach((el) => el.classList.remove("is-invalid"));

  formulario.querySelectorAll(".error-validacion").forEach((el) => el.remove());
}

function validarTexto(input, min = 1, max = 50) {
  const valor = input.value.trim();

  if (valor.length < min || valor.length > max) {
    mostrarError(input, `Debe tener entre ${min} y ${max} caracteres`);
    return false;
  }

  return true;
}

function validarNumero(input) {
  const valor = input.value.trim();

  if (valor === "" || isNaN(valor) || Number(valor) < 0) {
    mostrarError(input, "Debe ser un número válido");
    return false;
  }

  return true;
}

function validarDecimal(input) {
  const valor = input.value.trim();

  if (valor === "" || isNaN(valor) || Number(valor) < 0) {
    mostrarError(input, "Debe ser un decimal válido");
    return false;
  }

  return true;
}

function validarSelect(select) {
  if (!select.value) {
    mostrarError(select, "Seleccione una opción");
    return false;
  }

  return true;
}

// VALIDAR EMAIL

function validarEmail(input) {
  const valor = input.value.trim();

  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!regex.test(valor)) {
    mostrarError(input, "Email no válido");
    return false;
  }

  return true;
}

// VALIDAR TELÉFONO

function validarTelefono(input) {
  const valor = input.value.trim();

  const regex = /^[0-9]{9}$/;

  if (!regex.test(valor)) {
    mostrarError(input, "El teléfono debe tener 9 números");
    return false;
  }

  return true;
}

// VALIDAR PASSWORD

function validarPassword(input) {
  const valor = input.value;

  // mínimo 6 caracteres
  if (valor.length < 6) {
    mostrarError(input, "La contraseña debe tener mínimo 6 caracteres");

    return false;
  }

  return true;
}

// VALIDAR FECHA

function validarFecha(input) {
  const valor = input.value.trim();

  if (valor === "") {
    mostrarError(input, "Seleccione una fecha");

    return false;
  }

  const fecha = new Date(valor);

  if (isNaN(fecha.getTime())) {
    mostrarError(input, "Fecha no válida");

    return false;
  }

  return true;
}

// VALIDAR DNI / NIE SIMPLE

function validarDNI(input) {
  const valor = input.value.trim().toUpperCase();

  const regex = /^[XYZ]?\d{5,8}[A-Z]$/;

  if (!regex.test(valor)) {
    mostrarError(input, "Documento no válido");

    return false;
  }

  return true;
}
// RESETEAR FORMULARIO

function resetearFormulario(formularioId) {
  const formulario = document.getElementById(formularioId);

  if (!formulario) return;

  // LIMPIAR FORMULARIO
  formulario.reset();

  // LIMPIAR ERRORES
  limpiarErrores(formulario);
}
