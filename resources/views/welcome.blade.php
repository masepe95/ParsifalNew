@extends('layouts.app')
@section('content')

    <div class="jumbotron p-5 mb-4 bg-light rounded-3">
        <div class="container py-5">

            <h1 class="display-5 fw-bold">
                Benvenuto!
            </h1>

            <br/>
            <p>
                Parsifal e' un sistema di supporto ai Centri di Formazione Professionale.<br/>
@auth()
                Ogni Centro iscritto:
            <ul>
                <li>
                    Riceve segnalazioni da Aziende iscritte a Camelot che vogliono attivare dei tirocini/stage,
                    <br/>
                    Le Aziende iscritte a Camelot ricevono le disponibilità ai tirocini/stage direttamente dai Centri
                </li>
                <br/>
                <li>
                    Riceve da Candidati iscritti a Camelot potenziali richieste di formazione presso i Centri
                    iscritti.
                    <br/>
                    I Candidati iscritti a Camelot ricevono le disponibilità ai corsi direttamente dai Centri
                </li>
                <br/>
                <li>
                    Propone ai propri Studenti potenziali possibilità di
                    lavoro una volta iscritti a Camelot.
                </li>
                <br/>
                <br/>
            </ul>
            </p>

            <p>
                Puoi visionare i termini e le condizioni del servizio qui <a target="_blank" href="/storage/downloads/condizioni_fornitura_parsifal.pdf">t&c.doc</a>
            </p>
            <p>
                Tutti i dettagli sulla privacy li trovi <a target="_blank" href="https://www.privacylab.it/informativa.php?21504472514">qui</a>
            </p>
@else
            <p>
                Per iscriverti in Parsifal, contatta il nostro supporto commerciale qui <a target="_blank" href="mailto:info@parsifal-italia.com">info@parsifal-italia.com</a>
            </p>
@endauth

        </div>
    </div>

@endsection
