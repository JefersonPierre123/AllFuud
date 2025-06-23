const paymentSelect = document.getElementById('forma-pagamento');
const cartaoDetails = document.getElementById('cartao-details');
const cartaoNumero = document.getElementById('numero-cartao');
const cartaoNome = document.getElementById('nome-cartao');
const cvv = document.getElementById('cvv');
const validade = document.getElementById('validade');
const pixDetails = document.getElementById('pix-details');

function updatePaymentDetails() {
    if (paymentSelect.value === 'cartao') {
        cartaoDetails.classList.add('show');
        pixDetails.classList.remove('show');
    } else if (paymentSelect.value === 'pix') {
        pixDetails.classList.add('show');
        cartaoDetails.classList.remove('show');
        cartaoNumero.removeAttribute('required');
        cartaoNome.removeAttribute('required');
        validade.removeAttribute('required');
        cvv.removeAttribute('required');
    }
}

paymentSelect.addEventListener('change', updatePaymentDetails);
updatePaymentDetails();