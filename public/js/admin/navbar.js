const menuItems  = document.querySelectorAll('.nav-link');
menuItems.forEach(item => {
    item.addEventListener('click', function(event) {
        event.preventDefault();
        if(!item.classList.contains('active')){
            menuItems.forEach(item => item.classList.remove('active'));
            item.classList.add('active');
        }
    });
});