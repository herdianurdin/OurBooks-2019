const bookInner = document.querySelectorAll('.book-inner')

bookInner.forEach(b => {
    b.addEventListener('click', () => {
        b.classList.toggle('flip')
    })
})