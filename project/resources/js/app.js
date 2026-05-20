import './bootstrap';
import '../css/app.css';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const menuButton = document.getElementById('menuButton');
const mobileMenu = document.getElementById('mobileMenu');

if (menuButton) {
    menuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
}
