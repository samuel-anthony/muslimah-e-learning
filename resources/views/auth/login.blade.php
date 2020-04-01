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
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" placeholder="Masukkan Email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <input type="password" class="form-control" id="password" placeholder="Masukkan Kata Sandi" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-success px-5">Masuk</button>
                </form>
                <p class="text-right">Tidak Terdaftar? <a href="contactus">Hubungi Kami</a></p>
            </div>
        </div>
    </div>
@endsection