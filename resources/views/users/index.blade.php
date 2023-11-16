@extends('layouts.app')

@section('content')
<div class="container">
    <h3>All Users</h3>
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Middle</th>
            <th scope="col">Last</th>
            <th scope="col">Username</th>
            <th scope="col">E-Mail</th>
            <th scope="col">Type</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th scope="col">Deleted</th>
        </tr>
        </thead>
        <tbody>
        @if($users->count() > 0)
            @foreach($users as $user)
            <tr>
                <th scope="row d-flex">
                    <a href="{{url('users/show/'.$user->id)}}" class="btn btn-primary mr-3"><i class="bi bi-eye"></i></a>
                    <a href="{{url('users/edit/'.$user->id)}}" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                    <form action="{{url('users/destroy/'.$user->id)}}" method="post" type="button">
                        @csrf
                        <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                    <form action="{{url('users/delete/'.$user->id)}}" method="post" type="button">
                        @csrf
                        <button class="btn btn-dark"><i class="bi bi-stop-circle"></i></button>
                    </form>

                </th>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->firstname}}</td>
                <td>{{$user->middlename}}</td>
                <td>{{$user->lastname}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->type}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->updated_at}}</td>
                <td>{{$user->deleted_at}}</td>
            </tr>
            @endforeach
        @else
            <tr>
                <td>User not found</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
@endsection