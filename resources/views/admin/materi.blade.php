@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Materi</h2>
                
                <div class="row mt-5">
                    <div class="col-12">
                        <form action="" method="post">
                            <div class="form-group row">
                                <label for="judul" class="col-3 inputRequired">Judul*</label>
                                <div class="col-1">:</div>
                                <input type="text" class="form-control col-7" id="judul" placeholder="Enter Judul" name="judul" required>
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-success">New Post</button>
							</div>
                        </form>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col" width="5%">No</th>
                                    <th scope="col" width="50%">Judul</th>
                                    <th scope="col" width="30%">Tanggal</th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(is_null($judul ?? null) || count($judul) <= 0)
                                <tr>
                                    <td colspan="5" class="text-center">Records Not Found</td>
                                </tr>
                                @else
                                <tr>
                                    <td scope="row" class="text-center">1</td>
                                    <td>Judul_Name</td>
                                    <td>Tanggal_date</td>
                                    <td style="display: flex; justify-content: space-around;">
                                        <form id="button-yes-judul{{$judul->judul_id}}" class="submitForm" action="/admin/approve/judul" method="POST">@csrf<input for="judul" name="judul" value="{{$judul->judul_id}}" style="display:none"><input for="adm" name="adm" value="{{$admin->adm_id}}" style="display:none">
                                            <button type="submit" class="btn btn-outline-success btn-sm btn-pill btnSubmit py-2 px-3">Edit</button>
                                        </form>
                                        <form id="button-no-judul{{$judul->judul_id}}" class="submitForm" action="/admin/disapprove/judul" method="POST">@csrf<input for="judul" name="judul" value="{{$judul->judul_id}}" style="display:none"><input for="adm" name="adm" value="{{$admin->adm_id}}" style="display:none">
                                            <button type="submit" class="btn btn-outline-danger btn-sm btn-pill btnSubmit py-2 px-3">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection