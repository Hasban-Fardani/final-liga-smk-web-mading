let alert = document.querySelector('.alert');

if (alert) {
    setTimeout(() => {
        alert.remove();
    }, 3000);
}