@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-8 bg-light rounded py-4 px-5">
                <div class="row justify-content-between">
                    <div class="col-3">
                        <h2>Profile</h2>
                    </div>
                    <div class="col-3">
                        <a href="/user/ubahpassword">
                        <button type="submit" class="btn btn-primary">Edit Password</button>
                        </a>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <form action="/user/profile" method="post" autocomplete="off" >
                            @csrf
                            <div class="form-group row">
                                <label for="userId" class="col-3">User ID</label>
                                <div class="col-1">:</div>
                                <input type="text" class="form-control col-7" id="userId" placeholder="Enter User Id" name="id" required disabled value="{{Auth::user()->id}}">
                                <input type="text" class="form-control col-7" id="userId" placeholder="Enter User Id" name="id" style="display:none" value="{{Auth::user()->id}}">
                            </div>
                            <div class="form-group row">
                                <label for="userId" class="col-3">Group</label>
                                <div class="col-1">:</div>
                                <input type="text" class="form-control col-7" id="userId" name="id" required disabled value="{{Auth::user()->group->group_name}}">
                            </div>
                            <div class="form-group row">
                                <label for="userId" class="col-3">Gender</label>
                                <div class="col-1">:</div>
                                <input type="text" class="form-control col-7" id="userId" disabled value="Female">
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-3">First Name</label>
                                <div class="col-1">:</div>
                                <input type="text" class="form-control col-7" id="nama" placeholder="Enter First Name" name="first_name" required  @if(old('first_name'))value="{{old('first_name')}}" @else value="{{Auth::user()->first_name}}" @endif>
                            </div>

                            <div class="form-group row">
                                <label for="nama" class="col-3">Last Name</label>
                                <div class="col-1">:</div>
                                <input type="text" class="form-control col-7" id="nama" placeholder="Enter Last Name" name="last_name" required  @if(old('last_name'))value="{{old('last_name')}}" @else value="{{Auth::user()->last_name}}" @endif>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-3">Email</label>
                                <div class="col-1">:</div>
                                <input type="email" class="form-control col-7 @error('email') is-invalid @enderror" id="email" placeholder="Enter Email" name="email" required @if(old('email'))value="{{old('email')}}" @else value="{{Auth::user()->email}}" @endif>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="nomor" class="col-3">Phone Number</label>
                                <div class="col-1">:</div>
                                <input type="number" class="form-control col-7 @error('phone') is-invalid @enderror" id="nomor" placeholder="Enter Phone Number" name="phone"  @if(old('phone'))value="{{old('phone')}}" @else value="{{Auth::user()->phone}}" @endif>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-success">Save</button>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
