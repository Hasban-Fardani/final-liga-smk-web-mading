let alert = document.querySelector('.alert');

if (alert) {
    setTimeout(() => {
        alert.remove();
    }, 3000);
}

new DataTable('#dataTable', {
    reponsive: true,
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ],
});
