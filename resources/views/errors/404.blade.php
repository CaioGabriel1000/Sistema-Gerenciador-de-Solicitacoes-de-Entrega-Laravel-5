@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h6>Erro 404</h6></div>

                <div class="card-body">
					<p>A página que você procurou não existe!</p>
				<p><a href="{{url('/')}}"> clique aqui para retornar para a loja</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
