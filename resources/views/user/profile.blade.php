@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-8 bg-light rounded py-4 px-5">
                <div class="row justify-content-between">
                    <div class="col-3">
                        <h2>Profil</h2>
                    </div>
                    <div class="col-3">
                        <a href="/user/ubahpassword">
                        <button type="submit" class="btn btn-primary">Ubah Password</button>
                        </a>
                    </div>
                </div>
                
                <div class="row mt-5">
                    <div class="col-8">
                        <form action="/user/profile" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="userId">User ID</label>
                                <input type="text" class="form-control" id="userId" placeholder="Enter User ID" name="id" required disabled value="{{Auth::user()->id}}">
                                <input type="text" class="form-control" id="userId" placeholder="Enter User ID" name="id" style="display:none" value="{{Auth::user()->id}}">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Depan</label>
                                <input type="text" class="form-control" id="nama" placeholder="Enter Nama" name="first_name" required value="{{Auth::user()->first_name}}">
                            </div>
                            
                            <div class="form-group">
                                <label for="nama">Nama Belakang</label>
                                <input type="text" class="form-control" id="nama" placeholder="Enter Nama" name="last_name" required value="{{Auth::user()->last_name}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required value="{{Auth::user()->email}}">
                            </div>
                            <div class="form-group">
                                <label for="nomor">No Hp</label>
                                <input type="number" class="form-control" id="nomor" placeholder="Enter No Hp" name="phone" value="{{Auth::user()->phone}}">
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection