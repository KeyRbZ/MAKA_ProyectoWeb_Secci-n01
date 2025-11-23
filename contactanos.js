const items = document.querySelectorAll('.item');

items.forEach(item => {
    item.querySelector('.pregunta').addEventListener('click', () => {
        item.classList.toggle('activo');
    });
});