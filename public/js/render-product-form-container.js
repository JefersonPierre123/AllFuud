document.addEventListener("DOMContentLoaded", function () {
    let currentEditingProductId = null;
    let isNewProductFormOpen = false; // <-- Nova variável de estado
    const productGrid = document.querySelector('.product-grid');
    const baseUrl = window.productFormBaseUrl;

    /**
     * Carrega o formulário para CRIAR um novo produto.
     */
    window.loadNewProductForm = async function (establishmentId) {
        const container = document.getElementById("new-product-form-container");
        if (!container) {
            console.error("Container #new-product-form-container não encontrado.");
            return;
        }

        // 1. Fecha qualquer formulário de EDIÇÃO que esteja aberto.
        if (currentEditingProductId) {
            closeProductForm();
        }

        try {
            // 2. Monta a URL para buscar o formulário de criação, passando o ID do estabelecimento.
            const response = await fetch(`${baseUrl}/create?establishment_id=${establishmentId}`);
            if (!response.ok) throw new Error("Erro ao carregar formulário de novo produto.");
            
            const html = await response.text();
            
            // 3. Injeta o formulário no container e atualiza o estado.
            container.innerHTML = html;
            isNewProductFormOpen = true;

        } catch (error) {
            console.error("Erro ao carregar formulário de novo produto:", error);
            container.innerHTML = `<div class="alert alert-danger">Não foi possível carregar o formulário. Tente novamente.</div>`;
        }
    };

    /**
     * Carrega o formulário para EDITAR um produto existente.
     */
    window.loadProductForm = async function (productId) {
        // Fecha o formulário de NOVO produto se ele estiver aberto.
        if (isNewProductFormOpen) {
            closeNewProductForm();
        }
        
        const cardElement = document.getElementById(`card-product-${productId}`);
        const formContainer = document.getElementById(`product-form-container-${productId}`);
        if (!cardElement || !formContainer) return;

        if (currentEditingProductId && currentEditingProductId !== productId) {
            closeProductForm();
        }

        try {
            const response = await fetch(`${baseUrl}/${productId}`);
            if (!response.ok) throw new Error("Erro ao carregar formulário de edição.");
            
            formContainer.innerHTML = await response.text();
            cardElement.classList.add("d-none");
            formContainer.classList.remove("d-none");
            if (productGrid) productGrid.classList.add('is-editing');
            currentEditingProductId = productId;
        } catch (error) {
            console.error("Erro ao carregar formulário de edição:", error);
        }
    };

    /**
     * Fecha o formulário de EDIÇÃO de produto.
     */
    window.closeProductForm = function () {
        if (currentEditingProductId) {
            const cardElement = document.getElementById(`card-product-${currentEditingProductId}`);
            const formContainer = document.getElementById(`product-form-container-${currentEditingProductId}`);
            if (cardElement && formContainer) {
                cardElement.classList.remove("d-none");
                formContainer.classList.add("d-none");
                formContainer.innerHTML = "";
                if (productGrid) productGrid.classList.remove('is-editing');
            }
            currentEditingProductId = null;
        }
    };

    /**
     * Fecha o formulário de CRIAÇÃO de produto.
     */
    window.closeNewProductForm = function () {
        const container = document.getElementById("new-product-form-container");
        if (container) {
            container.innerHTML = "";
        }
        isNewProductFormOpen = false;
    };
});