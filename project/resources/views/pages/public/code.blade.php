@extends('layouts.app', [
    'code' => true
])

@section('input-code')

<section class="code-page py-5">

    <div class="container page-container">

        <div class="code-card">

            <div class="code-card-header text-center text-md-start">
                <h1>10° Jornada</h1>

                <p>
                    El aula en tiempo de algoritmos,
                    pantalla e inmediatez
                </p>
            </div>

            <div class="code-card-body">

                <div class="code-form-card">

                    <p class="code-card-info">
                        Ingresar el código enviado al
                        email con el que se inscribió a
                        la jornada
                    </p>

                    <form method="POST" action="{{ route('code.validate') }}">
                        @csrf

                        <div class="mb-3">
                            <label
                                for="code-input"
                                class="form-label code-label">
                                CODIGO
                            </label>

                            <input
                                type="text"
                                id="code-input"
                                class="form-control code-input">
                        </div>

                        <div class="text-center">
                            <button
                                type="submit"
                                class="btn code-button">
                                Ingresar
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection