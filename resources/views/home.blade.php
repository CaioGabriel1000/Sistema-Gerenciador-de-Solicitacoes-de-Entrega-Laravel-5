@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-4 p-2">
                <div class="card">
                    <img src="//placehold.it/500" class="card-img-top h-100 w-50 mx-auto d-block" alt="Nome produto">
                    <div class="card-body">
                        <h5 class="card-title">Produto</h5>
                        <p class="card-text"><b>R$ XX,XX</b></p>
                        <p class="card-text">descrição</p>
                        <div class="row">
                            <div class="col">
                                <input type="number" value="1" min="1" max="100" step="1"/>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary">
                                    <i class="fas fa-cart-plus"></i>
                                    <small>Adicionar ao carrinho</small>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- fim col -->
        </div> <!-- fim row -->
    </div> <!-- fim container -->

    <script src="{{ asset('js/bootstrap-input-spinner.js') }}"></script>
    <script>
        $("input[type='number']").inputSpinner()
    </script>

@endsection
