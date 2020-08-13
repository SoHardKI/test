@extends('layouts.app')

@section('content')
    <h1>{{"Получение кадастровых данных"}}</h1>
    {!! Form::open(['route' => 'get-plots','method'=>'POST', 'class' => 'form-group']) !!}
    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-6">
        <div class="d-flex flex-column">
            <div class="input-group-prepend">
                {!! Form::label('label', 'Введите данные', ['class' => 'form-control form-control-sm m-0']) !!}
            </div>
            <div class="input-group-append">
                {!! Form::input('plots', 'plots', '', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-12 text-left">
            <button type="submit" class="btn btn-primary">{{ "Получить данные" }}</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
