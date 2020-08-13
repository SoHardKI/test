@extends('layouts.app')

@section('content')
   <table class="table table-light table-bordered table-responsive-xs">
       <thead class="thead-light">
       <tr>
           <th> {{ "Кадастровый номер" }}</th>
           <th> {{ "Адрес" }}</th>
           <th> {{ "Стоимость" }}</th>
           <th> {{ "Площадь" }}</th>
       </tr>
       </thead>
       <tbody>
       @foreach($plots as $plot)
           <tr>
               <td>{{ $plot->cadastral_number }}</td>
               <td>{{ $plot->address }}</td>
               <td>{{ $plot->price }}</td>
               <td>{{ $plot->area . ' м' }} <sup><small>2</small></sup></td>
           </tr>
       @endforeach
       </tbody>
   </table>
@endsection
