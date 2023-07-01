@extends('admin.layouts.app')

@section('title', "Detalhes da Dúvida {$support->subject}")

@section('header')
    <h1 class="text-lg text-black-500">Dúvida {{ $support->subject }}</h1> 
@endsection

@section('content')
    <ul>
        <li>Assunto: {{ $support->subject }}</li>
        <li>Status: {{ $support->status }}</li>
        <li>Descrição: {{ $support->body }}</li>
    </ul>

    <form action="{{ route('supports.destroy', $support->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Deletar</button>
    </form>
@endsection