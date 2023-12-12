login_modal.addEventListener("click", (event) => {
    const { left, right, top, bottom } = login_modal.getBoundingClientRect();
    const { clientX, clientY } = event;

    if (
        clientX < left ||
        clientX > right ||
        clientY < top ||
        clientY > bottom
    ) {
        login_modal.close();
    }
});
