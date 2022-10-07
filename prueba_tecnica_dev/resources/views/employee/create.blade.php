@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Crear empleado</h2>

            <div class="alert alert-success" role="alert">
                Los campos con asteriscos(*) son obligatorios
            </div>

            <div>
                <form class="needs-validation" action="{{ url('/employee') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    @include('employee.formEmployee', ['mode'=>'Guardar', 'areasAll'=>$areas, 'rolesAll'=>$roles])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection