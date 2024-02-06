@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('new-partner') }}"> {{-- route('register') --}}
                        @csrf

                        <div class="mb-4 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="mb-4 row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                        <p class="mt-4">
                            Registrarti in Parsifal è:
                        </p>
                        <p>
                            -	<b>Facile:</b> Inserisci la tua mail e la password.<br>
                            Riceverai una mail per confermare la tua registrazione una volta verificati i tuoi requisiti;<br>
                            -	<b>Veloce:</b> la tua registrazione, una volta confermata, ti permetterà di accedere alla tua area riservata in cui potrai completare il profilo della tua attività e quello delle sedi operative e iniziare subito a fruire di tutti i vantaggi dell'iscrizione;<br>
                            -	<b>Sicuro:</b> i tuoi dati e quelli delle categorie di contatti da te gestite in questo portale saranno private e soggette a strette condizioni di privacy: tu decidi quali dati conferire e come verranno gestiti<br>
                        </p>
                        <p>
                            Puoi visionare informazioni piu’ dettagliate qui <a target="_blank" href="https://www.privacylab.it/informativa.php?21504472514">Soggetti Interessati: fruitori del portale Webapp.Parsifal-Italia.com.</a>
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
