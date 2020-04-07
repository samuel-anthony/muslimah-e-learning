@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Materi</h2>
                

                <div class="row mt-5">
                    <div class="col-12">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col" width="5%">No</th>
                                    <th scope="col" width="50%">Judul</th>
                                    <th scope="col" width="30%">Minggu ke</th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(is_null($materis ?? null) || count($materis) <= 0)
                                <tr>
                                    <td colspan="5" class="text-center">Data Tidak Ditemukan</td>
                                </tr>
                                @else
                                    @php($num=1)
                                    @foreach($materis as $materi)
                                        <tr>
                                            <td scope="row" class="text-center">{{$num++}}</td>
                                            <td>{{$materi->title}}</td>
                                            <td>{{$materi->week}}</td>
                                            <td style="display: flex; justify-content: space-around;">
                                                <form  class="submitForm" action="/user/openMateri/{{$materi->id}}" method="GET">
                                                    <button type="submit" class="btn btn-outline-success btn-sm btn-pill btnSubmit py-2 px-3">Buka</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection