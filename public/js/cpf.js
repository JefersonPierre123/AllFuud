function verificarCPF() {
  const cpfInput = document.getElementById('cpf');
  const cpf = cpfInput?.value?.replace(/\D/g, '');

  if (cpf.length !== 11) {
    alert('CPF inválido. Digite 11 números.');
    return;
  }

  fetch(`/api/verify-cpf?cpf=${cpf}`)
    .then(res => {
      if (!res.ok) throw new Error('CPF não encontrado!');
      return res.json();
    })
    .then(data => {
      // Se a API retornou algo, consideramos válido
      liberarFormularioCPF();
    })
    .catch(err => {
      alert(err.message || 'Erro ao verificar o CPF.');
      console.error(err);
    });
}

function liberarFormularioCPF() {
  const formElements = document.querySelectorAll('form input, form select, form button');
  formElements.forEach(el => {
    if (el.id !== 'cpf') {
      el.removeAttribute('disabled');
    }
  });
}

document.addEventListener('DOMContentLoaded', function () {
  const formElements = document.querySelectorAll('form input, form select, form button');
  formElements.forEach(el => {
    if (el.id !== 'cpf') {
      el.setAttribute('disabled', 'true');
    }
  });
});
