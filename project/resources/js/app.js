import './bootstrap';
import '../css/app.css';

const menuButton = document.getElementById('menuButton');
const mobileMenu = document.getElementById('mobileMenu');

if (menuButton) {
    menuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
}