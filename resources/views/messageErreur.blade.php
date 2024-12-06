{{-- Affichage des messages d'erreurs --}}

@if (isset($messagesErreur))
    @if (count($messagesErreur) > 0)
        <div class="alert alert-danger mb-3 text-start" role="alert">
            <b>Erreur :</b>
            <ul class="mb-0">
            @foreach ($messagesErreur as $erreur)
                <li>{{ $erreur }}</li>
            @endforeach
            </ul>
        </div>
    @endif
@endif