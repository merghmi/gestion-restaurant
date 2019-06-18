@include('./layouts/cltviews/navbar')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
                <h1 class="text-center text-success"> map de  la liste des restaurants ,si vous cliquez sur un restaurant la liste des plats et sanduitch vont etre affichees </h1>
            </div>
        </div>
    </div>
</div>

