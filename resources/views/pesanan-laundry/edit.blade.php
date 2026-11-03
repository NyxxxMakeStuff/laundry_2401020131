@extends('layouts.app')

@section('title', 'Edit Pesanan')


@section('content')
<div class="card">
    <div class="card-header">Edit Pesanan Laundry</div>
    <div class="card-body">
        <form
            action="{{ route('pesanan-laundry.update', $pesanan) }}"
            method="POST"
        >
            @csrf
            @method('PUT')
            @include('pesanan-laundry._form')
        </form>
    </div>
</div>
@endsection