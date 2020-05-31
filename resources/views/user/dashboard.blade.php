@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-8 bg-light rounded py-4 px-5">
                <h2>{{Auth::user()->first_name}}&nbsp;{{Auth::user()->last_name}} (Lulus {{$totalPassed}} dari {{count($ujians)}} ujian)</h2>
                <div class="row my-4">
                    <div class="col-4">
                        <a href="/user/materi">
                            <div class="mx-3">
                                <img src="/assets/img/materi.png" width="150" height="150" class="d-inline-block align-top my-4" alt="">
                                <h4>Materi</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="/user/ujian">
                            <div class="mx-3">
                                <img src="/assets/img/ujian.png" width="150" height="150" class="d-inline-block align-top my-4" alt="">
                                <h4>Ujian</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="/user/profile">
                            <div class="mx-3">
                                <img src="/assets/img/user.png" width="150" height="150" class="d-inline-block align-top my-4" alt="">
                                <h4>Profil</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection