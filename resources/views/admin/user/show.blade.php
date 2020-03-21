@extends('admin.layouts.app')

@section('content')
    <h2>
        Перегляд користувача #{{$user->id}}
        <a href="{{route('admin.user.edit', ['user' => $user->id])}}" title="Редагувати">
            <i class="fa fa-edit" aria-hidden="true"></i>
        </a>
    </h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.user.index')}}">Домашня</a></li>
            <li class="breadcrumb-item active" aria-current="page">Перегляд</li>
        </ol>
    </nav>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    <div class="row bg-info ml-1 mr-1 p-3 rounded-lg">

        <div class="col-3">
            <img src="{{$user->detail->avatar}}" class="rounded-pill">
        </div>
        <div class="col-7">
            <h4 class="text-white font-weight-bold">{{$user->detail->first_name}} {{$user->detail->last_name}}</h4>
            <h6 class="text-black-50">{{$user->email}}</h6>
            <div class="row mt-5">
                <div class="col-6">
                    <div class="text-white font-weight-bold">$ 126,325.25</div>
                    <div class="text-black-50">Всього замовив</div>
                </div>
                <div class="col-6">
                    <div class="text-white font-weight-bold">{{$user->orders->count()}}</div>
                    <div class="text-black-50">Замовлень</div>
                </div>
            </div>
        </div>
        <div class="col-2">
            <a href="{{route('admin.user.edit', ['user' => $user->id])}}" class="btn btn-light">Edit Profile</a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Детальна інформація</h5>
                    <p class="card-text">
                        <span class="text-black-50 font-weight-bold">Full Name</span> : {{$user->detail->first_name}} {{$user->detail->last_name}}
                    </p>
                    <p class="card-text">
                        <span class="text-black-50 font-weight-bold">Mobile</span> : {{ $user->detail->phone }}
                    </p>
                    <p class="card-text">
                        <span class="text-black-50 font-weight-bold">Email</span> : {{$user->email}}
                    </p>
                    <p class="card-text">
                        <span class="text-black-50 font-weight-bold">Country</span> : {{ $user->detail->country }}
                    </p>
                    <p class="card-text">
                        <span class="text-black-50 font-weight-bold">Location</span> : {{ $user->detail->location }}
                    </p>
                    <p class="card-text">
                        <span class="text-black-50 font-weight-bold">Birthday</span> : {{ $user->detail->birthday }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-8">
            @include('admin.user.card_orders')
            @include('admin.user.card_comments')
        </div>
    </div>
@endsection
