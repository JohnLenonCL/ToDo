<!-- resources/views/tasks/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                @include('tasks.a_fazer')
            </div>
            <div class="col-md-4">
                @include('tasks.fazendo')
            </div>
            <div class="col-md-4">
                @include('tasks.feito')
            </div>
        </div>
    </div>
@endsection
