<nav class="navbar navbar-expand-lg navbar-custom">

    <div class="container custom-container navbar-container">

        <a
            class="navbar-brand d-flex align-items-center gap-3"
            href="#">

            <img
                src="{{ asset('images/SedesCompleto.png') }}"
                class="navbar-logo-sedes"
                alt="Sedes">

            <img
                src="{{ asset('images/LogoJornada.png') }}"
                class="navbar-logo"
                alt="Logo Jornada">

            <div>
                <p class="navbar-text mb-0">
                    Jornada de Innovación
                </p>

                <p class="navbar-practice mb-0">
                    Práctica Docente
                </p>
            </div>

        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarContent">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div
            class="collapse navbar-collapse justify-content-end"
            id="navbarContent">

            <ul class="navbar-nav align-items-lg-center gap-lg-3">

                <li class="nav-item">
                    <a
                        class="nav-link nav-link-custom"
                        href="#sobre">

                        Información

                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link nav-link-custom"
                        href="#anteriores">

                        Jornadas

                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link nav-link-custom"
                        href="#cronograma">

                        Cronograma

                    </a>
                </li>

                <li class="nav-item mt-3 mt-lg-0">

                    <a
                        href="#"
                        class="btn btn-inscribirse">

                        Inscribirse

                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>