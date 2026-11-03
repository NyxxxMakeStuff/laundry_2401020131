@extends('layouts.app')

@section('title', 'Tambah Pesanan')

@section('content')
<div class="card">
    <div class="card-header">Tambah Pesanan Laundry</div>
    <div class="card-body">
        <form action="{{ route('pesanan-laundry.store') }}" method="POST">
            @csrf
            @include('pesanan-laundry._form')
        </form>
    </div>
</div>
@endsection