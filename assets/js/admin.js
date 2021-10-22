const btnMenu = document.querySelector('#btn-menu')
const menuItem = document.querySelectorAll('#menu-item ul li a');
const bookInner = document.querySelectorAll('.book-inner')
const showAddBook = document.querySelector('#show-add-book')

btnMenu.addEventListener('click', () => {
    btnMenu.classList.toggle('btn-rotate')
    document.querySelector('#menu-item').classList.toggle('hide')
})

menuItem.forEach(m => {
    m.addEventListener('click', () => {
        btnMenu.classList.toggle('btn-rotate')
        document.querySelector('#menu-item').classList.add('hide')
    })
})

bookInner.forEach(b => {
    b.addEventListener('click', () => {
        b.classList.toggle('flip')
    })
})

showAddBook.addEventListener('click', () => {
    document.querySelector('#add-book').classList.toggle('hide')
    document.querySelector('#list-book').classList.toggle('hide')
})