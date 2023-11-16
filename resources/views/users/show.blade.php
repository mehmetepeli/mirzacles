@extends('layouts.app')

@section('content')
    <div class="container d-flex">
        <div class="user_show__left">
            <div class="user__avatar">
                @if(!empty($user->photo))
                    <img src="{{$user->avatar()}}" alt="Avatar"/>
                @else
                    <img src="https://cdn.icon-icons.com/icons2/1097/PNG/512/1485477097-avatar_78580.png" alt="Avatar"/>
                @endif
            </div>
        </div>
        <div class="user_show__right">
            <div class="row mb-3">
                <div class="col-4 col-sm-4">First Name</div>
                <div class="col-8 col-sm-8">{{$user->firstname}}</div>
            </div>
            <div class="row mb-3">
                <div class="col-4 col-sm-4">Middle Name</div>
                <div class="col-8 col-sm-8">{{$user->middlename}}</div>
            </div>
            <div class="row mb-3">
                <div class="col-4 col-sm-4">Last Name</div>
                <div class="col-8 col-sm-8">{{$user->lastname}}</div>
            </div>
            <div class="row mb-3">
                <div class="col-4 col-sm-4">Full Name</div>
                <div class="col-8 col-sm-8">{{$user->getFullnameAttribute()}}</div>
            </div>
            <div class="row mb-3">
                <div class="col-4 col-sm-4">Username</div>
                <div class="col-8 col-sm-8">{{$user->username}}</div>
            </div>
            <div class="row mb-3">
                <div class="col-4 col-sm-4">E-Mail</div>
                <div class="col-8 col-sm-8">{{$user->email}}</div>
            </div>
            <div class="row mb-3">
                <div class="col-4 col-sm-4">Type</div>
                <div class="col-8 col-sm-8">{{$user->type}}</div>
            </div>
            <div class="row mb-3">
                <div class="col-4 col-sm-4">Created</div>
                <div class="col-8 col-sm-8">{{$user->created_at}}</div>
            </div>
            <div class="row mb-3">
                <div class="col-4 col-sm-4">Updated</div>
                <div class="col-8 col-sm-8">{{$user->updated_at}}</div>
            </div>
            <div class="row mb-3">
                <div class="col-4 col-sm-4">Deleted</div>
                <div class="col-8 col-sm-8">{{$user->deleted_at}}</div>
            </div>
            <div class="row">
                <div class="col-4 col-sm-4"><a href="{{url('users/edit/'.$user->id)}}" class="btn btn-warning">Edit User</a></div>
                <div class="col-8 col-sm-8"></div>
            </div>
        </div>
    </div>
@endsection
<style>
    .user_show__left, .user_show__right {
        display: flex;
    }
    .user_show__left {
        width: 20%;
    }
    .user__avatar {
        width: 150px;
        height: 150px;
        display: flex;
        object-fit: contain;
    }
    .user__avatar img {
        width: 100%;
        height: 100%;
    }

    .user_show__right {
        width: 80%;
        padding: 20px;
        flex-direction: column;
    }

    .mb-3 { margin-bottom: 30px; }
</style>