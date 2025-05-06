function verificarCPF() {
    const cpf = document.getElementById('cpf')?.value?.replace(/\D/g, '');
    if (cpf.length !== 11) {
      alert('CPF inválido. Digite 11 números.');
      return;
    }
  
    fetch(`/api/verify-cpf?cpf=${cpf}`)
      .then(res => {
        if (!res.ok) throw new Error('CPF inválido');
        return res.json();
      })
      .then(data => {
        if (data.status === 'ERROR') {
          alert('CPF não encontrado!');
          return;
        }
      })
      .catch(err => {
        alert(err.message || 'Erro ao verificar o CPF.');
        console.error(err);
      });
  }  