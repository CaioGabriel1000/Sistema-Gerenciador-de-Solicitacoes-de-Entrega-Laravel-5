@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="text-center">
						<div class="d-block mx-auto mb-3">
							<i class="fas fa-user fa-3x"></i>
						</div>
						<h1><small>Minha Conta</small></h1>
					</div>
				</div>
				<div class="card-body">
					<ul class="list-group list-group-flush">
						<li class="list-group-item"><b>Nome: </b>{{ Auth::user()->name }}</li>
						<li class="list-group-item"><b>Email: </b>{{ Auth::user()->email }}</li>
						<li class="list-group-item"><b>Telefone: </b>{{ Auth::user()->telefone }}</li>
						<li class="list-group-item"><b>Data de cadastro: </b>{{ date("d-m-Y H:i", strtotime(Auth::user()->created_at)) }}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
