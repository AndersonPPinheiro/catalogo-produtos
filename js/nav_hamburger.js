document.getElementById('hamburger-menu').onclick = function() {
    document.getElementById('nav-links').classList.toggle('active');
    this.classList.toggle('open');
};