@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ url('users/update/'.$user->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="container d-flex">
            <div class="user_show__left">
                <div class="user__avatar">
                    @if(!empty($user->photo))
                        <img src="{{url('upload/'.$user->photo)}}" alt="Avatar"/>
                    @else
                        <img src="https://cdn.icon-icons.com/icons2/1097/PNG/512/1485477097-avatar_78580.png" alt="Avatar"/>
                    @endif
                </div>
            </div>
            <div class="user_show__right">
                <div class="row mb-3">
                    <div class="col-4 col-sm-4">
                        <label for="firstname" class="col-form-label text-md-end">First Name</label>
                    </div>
                    <div class="col-8 col-sm-8">
                        <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $user->firstname }}" required autocomplete="firstname" autofocus>

                        @error('firstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 col-sm-4">
                        <label for="middlename" class="col-form-label text-md-end">Middle Name</label>
                    </div>
                    <div class="col-8 col-sm-8">
                        <input id="middlename" type="text" class="form-control @error('middlename') is-invalid @enderror" name="middlename" value="{{ $user->middlename }}" autocomplete="middlename" autofocus>

                        @error('middlename')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 col-sm-4">
                        <label for="lastname" class="col-form-label text-md-end">Last Name</label>
                    </div>
                    <div class="col-8 col-sm-8">
                        <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $user->lastname }}" required autocomplete="lastname" autofocus>

                        @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 col-sm-4">
                        <label for="suffixname" class="col-form-label text-md-end">Suffix Name</label>
                    </div>
                    <div class="col-8 col-sm-8">
                        <input id="suffixname" type="text" class="form-control @error('suffixname') is-invalid @enderror" name="suffixname" value="{{ $user->suffixname }}" autocomplete="suffixname" autofocus>

                        @error('suffixname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 col-sm-4">
                        <label for="username" class="col-form-label text-md-end">Username</label>
                    </div>
                    <div class="col-8 col-sm-8">
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username" autofocus>

                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 col-sm-4">
                        <label for="email" class="col-form-label text-md-end">E-Mail</label>
                    </div>
                    <div class="col-8 col-sm-8">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 col-sm-4">
                        <label for="photo" class="col-form-label text-md-end">Photo</label>
                    </div>
                    <div class="col-8 col-sm-8">
                        <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" autofocus>

                        @error('photo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 col-sm-4">
                        <label for="type" class="col-form-label text-md-end">Type</label>
                    </div>
                    <div class="col-8 col-sm-8">
                        <select name="type" id="type" class="form-control">
                            <option {{ ($user->type == 'User') ? 'selected' : ''  }} value="User">User</option>
                            <option {{ ($user->type == 'Admin') ? 'selected' : ''  }} value="Admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 col-sm-4">Created</div>
                    <div class="col-8 col-sm-8">{{ $user->created_at  }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 col-sm-4">Updated</div>
                    <div class="col-8 col-sm-8">{{ $user->updated_at  }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 col-sm-4">Deleted</div>
                    <div class="col-8 col-sm-8">{{ $user->deleted_at  }}</div>
                </div>
                <div class="row">
                    <div class="col-4 col-sm-4"><button class="btn btn-warning">Update</button></div>
                    <div class="col-8 col-sm-8"></div>
                </div>
            </div>
        </div>
    </form>
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