function buscarEndereco() {
  const cep = document.getElementById('cep')?.value?.replace(/\D/g, '');
  console.log('CEP capturado:', cep);

  if (!cep || cep.length !== 8) {
    alert('CEP inválido. Digite 8 números.');
    return;
  }

  fetch(`https://viacep.com.br/ws/${cep}/json/`)
    .then(response => response.json())
    .then(data => {
      if (data.erro) {
        alert('CEP não encontrado.');
        return;
      }

      // Preenche os campos usando ID (mais confiável)
      document.getElementById('street').value = data.logradouro || '';
      document.getElementById('neighborhood').value = data.bairro || '';
      document.getElementById('city').value = data.localidade || '';
      document.getElementById('state').value = data.uf || '';
    })
    .catch(error => {
      console.error('Erro ao buscar o CEP:', error);
      alert('Erro ao buscar o CEP.');
    });
}
