function verificarCNPJ() {
  const cnpjInput = document.getElementById('cnpj');
  const cnpj = cnpjInput?.value?.replace(/\D/g, '');

  if (cnpj.length !== 14) {
    alert('CNPJ inválido. Digite 14 números.');
    return;
  }

  fetch(`/api/verify-cnpj?cnpj=${cnpj}`)
    .then(res => {
      if (!res.ok) throw new Error('CNPJ inválido');
      return res.json();
    })
    .then(data => {
      if (data.status === 'ERROR' || !data.situacao || !data.status) {
        alert('CNPJ não encontrado ou dados incompletos!');
        return;
      }

      if (data.status === 'OK') {
        liberarFormulario();
      } else {
        alert(`CNPJ inválido! Status: ${data.status}, Situação: ${data.situacao}`);
      }
    })
    .catch(err => {
      console.error(err);
      alert(err.message || 'Erro ao verificar o CNPJ.');
    });
}

function liberarFormulario() {
  const formElements = document.querySelectorAll('form input, form select, form button, form textarea');
  formElements.forEach(el => {
    if (el.id !== 'cnpj') {
      el.removeAttribute('disabled');
    }
  });
}

document.addEventListener('DOMContentLoaded', () => {
  const cnpjInput = document.getElementById('cnpj');
  const cnpjValue = cnpjInput?.value?.replace(/\D/g, '');

  if (cnpjValue && cnpjValue.length === 14) {
    verificarCNPJ();
  }
});