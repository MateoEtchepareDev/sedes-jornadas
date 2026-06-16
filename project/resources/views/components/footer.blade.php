<footer class="footer">

    <div class="container custom-container">

        <div class="footer-top">

            <div class="footer-col footer-brand">

                <img
                    src="{{ asset('images/SedesCompleto.png') }}"
                    alt="logo"
                    class="footer-logo">

            </div>

            <div class="footer-col">

                <h3 class="footer-title">Contacto</h3>

                <p class="footer-text">
                    jornadas@sedessapientiae.edu.ar
                </p>

            </div>

            <div class="footer-col">

                <h3 class="footer-title">Seguinos</h3>

                <div class="footer-icons">

                    <a href="https://www.facebook.com/JornadasSedes/" class="icon">
                        <img src="{{ asset('images/facebook.png') }}" alt="facebook">
                    </a>

                    <a href="https://www.youtube.com/channel/UCZI9SsMtS-WsdHHqkqdBxQg" class="icon">
                        <img src="{{ asset('images/youtube.png') }}" alt="youtube">
                    </a>

                </div>

            </div>

        </div>

    </div>

    <div class="footer-bottom">

        <p>
            © 2026 Sedes Sapientiae | Todos los derechos reservados
        </p>

        <a href="{{ route('login') }}" class="admin-access">
            Acceso administradores
        </a>

    </div>

</footer>