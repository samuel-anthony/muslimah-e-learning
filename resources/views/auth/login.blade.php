@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row py-5">
            <h1 class="col-12 text-center text-white">MT Ummahat</h1>
        </div>
        <div class="row mt-3 justify-content-center">
            <div class="col-6 bg-light rounded py-4 px-5">
                <form action="/login" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="userId">User ID</label>
                        <input type="text" class="form-control" id="userId" placeholder="Enter User ID" name="userid" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-success px-5">Login</button>
                </form>
                <p class="text-right">Tidak Terdaftar? <a href="contactus">Hubungi Kami</a></p>
            </div>
        </div>
    </div>
@endsection