@extends('livewire-layout')

@section('title', 'Usuarios')
@section('content')

    @livewire('users-list')
    @includeWhen($view == 'index', 'users._filters')