document.addEventListener("DOMContentLoaded", function () {
    let currentEditingProductId = null;
    const productGrid = document.querySelector('.product-grid'); // Encontra a grade de produtos

    // ... (seu código loadNewProductForm se tiver) ...

    window.loadProductForm = async function (productId) {
        const cardElement = document.getElementById(`card-product-${productId}`);
        const formContainer = document.getElementById(`product-form-container-${productId}`);

        if (!cardElement || !formContainer) {
            console.error("Elementos do card ou do formulário do produto não encontrados.");
            return;
        }

        // Fecha outro formulário de edição que esteja aberto
        if (currentEditingProductId && currentEditingProductId !== productId) {
            closeProductForm();
        }

        try {
            const baseUrl = window.productFormBaseUrl;
            const response = await fetch(`${baseUrl}/${productId}`);
            if (!response.ok) throw new Error("Erro ao carregar formulário de edição do produto.");
            
            const html = await response.text();
            formContainer.innerHTML = html;

            cardElement.classList.add("d-none");
            formContainer.classList.remove("d-none");

            // ADICIONA a classe que desativa o 'stretch'
            if (productGrid) productGrid.classList.add('is-editing');

            currentEditingProductId = productId;

        } catch (error) {
            console.error("Erro ao carregar formulário de edição:", error);
            formContainer.innerHTML = `<div class="alert alert-danger">Erro ao carregar o formulário.</div>`;
        }
    };

    window.closeProductForm = function () {
        if (currentEditingProductId) {
            const cardElement = document.getElementById(`card-product-${currentEditingProductId}`);
            const formContainer = document.getElementById(`product-form-container-${currentEditingProductId}`);

            if (cardElement && formContainer) {
                cardElement.classList.remove("d-none");
                formContainer.classList.add("d-none");
                formContainer.innerHTML = "";

                // REMOVE a classe que desativa o 'stretch', restaurando o alinhamento
                if (productGrid) productGrid.classList.remove('is-editing');
            }
            currentEditingProductId = null;
        }
    };
});