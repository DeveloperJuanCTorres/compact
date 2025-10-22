@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Importar Productos desde Excel</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Archivo Excel</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <button class="btn btn-primary">Importar</button>
    </form>
</div>
@endsection
