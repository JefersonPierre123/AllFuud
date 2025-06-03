document.addEventListener("DOMContentLoaded", function () {
    const select = document.getElementById('user_type');
    const clientForm = document.getElementById('client-form');
    const establishmentForm = document.getElementById('establishment-form');

    select?.addEventListener('change', function () {
        const value = this.value;

        clientForm.style.display = 'none';
        establishmentForm.style.display = 'none';

        if (value === 'client') {
            clientForm.style.display = 'block';
        } else if (value === 'establishment') {
            establishmentForm.style.display = 'block';
        }
    });
});