document.addEventListener("DOMContentLoaded", function () {
  let currentEditingId = null;
  let isNewAddressFormOpen = false;

  // Base URL global para os forms
  const baseUrl = window.addressFormBaseUrl;

  // Função para carregar endereço existente para edição
  window.loadAddressForm = async function (addressId) {
    const cardElement = document.getElementById(`card-address-${addressId}`);
    const formContainer = document.getElementById(`address-form-container-${addressId}`);

    if (!cardElement || !formContainer) {
      console.error("Elementos do endereço não encontrados.");
      return;
    }

    // Fecha formulário de novo endereço, se estiver aberto
    if (isNewAddressFormOpen) {
      const newFormContainer = document.getElementById("new-address-form-container");
      if (newFormContainer) newFormContainer.innerHTML = "";
      isNewAddressFormOpen = false;
    }

    // Fecha formulário de edição anterior, se for outro endereço
    if (currentEditingId && currentEditingId !== addressId) {
      const previousCard = document.getElementById(`card-address-${currentEditingId}`);
      const previousForm = document.getElementById(`address-form-container-${currentEditingId}`);

      if (previousCard && previousForm) {
        previousCard.classList.remove("d-none");
        previousForm.classList.add("d-none");
        previousForm.innerHTML = "";
      }
    }

    try {
      const response = await fetch(`${baseUrl}/${addressId}`);
      if (!response.ok) throw new Error("Erro ao carregar formulário de edição.");

      const html = await response.text();
      formContainer.innerHTML = html;

      cardElement.classList.add("d-none");
      formContainer.classList.remove("d-none");

      currentEditingId = addressId;
      isNewAddressFormOpen = false;

      autoBuscarCep();
    } catch (error) {
      console.error("Erro ao carregar formulário de edição:", error);
      formContainer.innerHTML = `<div class="alert alert-danger">Erro ao carregar formulário.</div>`;
    }
  };

  // Função para adicionar novo endereço
  window.loadNewAddressForm = async function () {
    const container = document.getElementById("new-address-form-container");
    if (!container) {
      console.error("Container de novo endereço não encontrado.");
      return;
    }

    // Fecha formulário de edição se algum estiver aberto
    if (currentEditingId) {
      const previousCard = document.getElementById(`card-address-${currentEditingId}`);
      const previousForm = document.getElementById(`address-form-container-${currentEditingId}`);

      if (previousCard && previousForm) {
        previousCard.classList.remove("d-none");
        previousForm.classList.add("d-none");
        previousForm.innerHTML = "";
      }
      currentEditingId = null;
    }

    try {
      const response = await fetch(`${baseUrl}/create`);
      if (!response.ok) throw new Error("Erro ao carregar formulário de novo endereço.");

      const html = await response.text();
      container.innerHTML = html;
      isNewAddressFormOpen = true;

      autoBuscarCep();
    } catch (error) {
      console.error("Erro ao carregar formulário de novo endereço:", error);
      container.innerHTML = `<div class="alert alert-danger">Erro ao carregar formulário de novo endereço.</div>`;
    }
  };

  // Função para fechar o formulário aberto (seja edição ou novo)
  window.closeAddressForm = function () {
    if (isNewAddressFormOpen) {
      const newFormContainer = document.getElementById("new-address-form-container");
      if (newFormContainer) {
        newFormContainer.innerHTML = "";
      }
      isNewAddressFormOpen = false;
    }

    if (currentEditingId) {
      const cardElement = document.getElementById(`card-address-${currentEditingId}`);
      const formContainer = document.getElementById(`address-form-container-${currentEditingId}`);

      if (cardElement && formContainer) {
        cardElement.classList.remove("d-none");
        formContainer.classList.add("d-none");
        formContainer.innerHTML = "";
      }
      currentEditingId = null;
    }
  };

  function autoBuscarCep() {
    setTimeout(() => {
      const cepInput = document.getElementById("cep");
      if (cepInput && cepInput.value.replace(/\D/g, "").length === 8) {
        buscarEndereco(); // Certifique-se de que essa função está globalmente disponível
      }
    }, 100);
  }
});