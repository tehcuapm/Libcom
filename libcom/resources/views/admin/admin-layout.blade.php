<head>
    @push('head')
        <link rel="stylesheet" href="{{ 'styles/admin.css' }}">
        <link rel="stylesheet" href="{{ 'styles/admin-layout.css' }}">
    @endpush
</head>
<div id="admin-ajax">
    <div id="info-div">
        <p id="info_1" class="info-admin">Nombre de personne actif : </p>
        <p id="info_2" class="info-admin">Nombre de commande : </p>
        <p id="info_3" class="info-admin">La plus grosse commande : </p>

        <button id="reset-page">
            RESET
        </button>
    </div>
    <form method="GET" action="{{ route('admin.users') }}" id="admin-users">
        @csrf
        <button type="submit">
            USERS
        </button>
    </form>



</div>
