function verificarCPF() {
  const input = document.getElementById('cpf');
  const cpf = input.value;

  if (!validarCPF(cpf)) {
    alert('CPF inválido!');
  } else {
    liberarFormulario(); // Habilita os campos
  }
}

function validarCPF(cpf) {
  cpf = cpf.replace(/[^\d]+/g, ''); // Remove tudo que não for número

  if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;

  let soma = 0;
  for (let i = 0; i < 9; i++) {
    soma += parseInt(cpf.charAt(i)) * (10 - i);
  }
  let resto = (soma * 10) % 11;
  if (resto === 10 || resto === 11) resto = 0;
  if (resto !== parseInt(cpf.charAt(9))) return false;

  soma = 0;
  for (let i = 0; i < 10; i++) {
    soma += parseInt(cpf.charAt(i)) * (11 - i);
  }
  resto = (soma * 10) % 11;
  if (resto === 10 || resto === 11) resto = 0;

  return resto === parseInt(cpf.charAt(10));
}

function liberarFormulario() {
  const formElements = document.querySelectorAll('form input, form select, form button');
  formElements.forEach(el => {
    if (el.id !== 'cpf') {
      el.removeAttribute('disabled');
    }
  });
}
