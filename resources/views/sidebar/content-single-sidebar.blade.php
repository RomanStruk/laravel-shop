@extends('sidebar.single-sidebar')
@section('content-sidebar')
<ul>
    @foreach($items as $item)
        <li>{{$item}}</li>
    @endforeach
</ul>
@endsection
