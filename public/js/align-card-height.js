function alignCardHeights(selector) {
    const elements = document.querySelectorAll(selector);
    if (elements.length === 0) {
        console.warn(`[Align Script] Nenhum elemento encontrado com o seletor: "${selector}"`);
        return;
    }

    let maxHeight = 0;

    // Reseta a altura para 'auto' para obter a altura natural dos elementos
    elements.forEach(el => {
        el.style.height = 'auto';
    });

    // Encontra a maior altura
    elements.forEach(el => {
        if (el.offsetHeight > maxHeight) {
            maxHeight = el.offsetHeight;
        }
    });
    
    console.log(`[Align Script] Altura máxima detectada: ${maxHeight}px. Aplicando a ${elements.length} cards.`);

    // Aplica a maior altura a todos os elementos
    elements.forEach(el => {
        el.style.height = `${maxHeight}px`;
    });
}

// ****** A MUDANÇA PRINCIPAL ESTÁ AQUI ******
// Trocamos 'DOMContentLoaded' por 'load' para esperar as imagens carregarem.
window.addEventListener('load', () => {
    alignCardHeights('.product-grid .card');
});

// O listener de 'resize' continua o mesmo, é uma boa prática mantê-lo.
let resizeTimeout;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
        alignCardHeights('.product-grid .card');
    }, 200);
});