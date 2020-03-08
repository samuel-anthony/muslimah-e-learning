@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-8 bg-light rounded py-4 px-5">
                <div class="row my-4">
                    <div class="col-4">
                        <a href="/admin/materi">
                            <div class="mx-3">
                                <img src="https://pbs.twimg.com/profile_images/413090483162734592/BTChv6kh_400x400.jpeg" width="150" height="150" class="d-inline-block align-top my-4" alt="">
                                <h4>Materi</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="/admin/ujian">
                            <div class="">
                                <img src="https://pbs.twimg.com/profile_images/413090483162734592/BTChv6kh_400x400.jpeg" width="150" height="150" class="d-inline-block align-top my-4" alt="">
                                <h4>Ujian</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="/admin/anggota">
                            <div class="mx-3">
                                <img src="https://pbs.twimg.com/profile_images/413090483162734592/BTChv6kh_400x400.jpeg" width="150" height="150" class="d-inline-block align-top my-4" alt="">
                                <h4>Anggota</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection