function verificarCNPJ() {
    const cnpj = document.getElementById('cnpj')?.value?.replace(/\D/g, '');
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
        if (data.status === 'ERROR') {
          alert('CNPJ não encontrado!');
          return;
        }
        alert(`Nome: ${data.nome}, Situação: ${data.situacao}`);
      })
      .catch(err => {
        console.error(err);
        alert(err.message || 'Erro ao verificar o CNPJ.');
      });
  }
  
