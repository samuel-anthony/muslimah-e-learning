@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Learning Material</h2>
                
                <div class="row mt-5">
                    <div class="col-12">
                        <form action="/admin/materi" method="post" autocomplete="off" >
                            @csrf
                            <div class="form-group row">
                                <label for="judul" class="col-2 inputRequired">Title*</label>
                                <div class="col-1">:</div>
                                <input type="text" class="form-control col-7"  placeholder="Enter Title of the Material" name="title" required>
                            </div>
                            <div class="form-group row">
                                <label for="judul" class="col-2 inputRequired">Week*</label>
                                <div class="col-1">:</div>
                                <input type="number" class="form-control col-7  @error('week') is-invalid @enderror" placeholder="Enter week when the material will be posted" name="week" required>
                                @error('week')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-success">Add Material</button>
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
                                    <th scope="col" width="50%">Title</th>
                                    <th scope="col" width="30%">Week</th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(is_null($materis ?? null) || count($materis) <= 0)
                                <tr>
                                    <td colspan="5" class="text-center">Data not Found</td>
                                </tr>
                                @else
                                    @php($num=1)
                                    @foreach($materis as $materi)
                                        <tr>
                                            <td scope="row" class="text-center">{{$num++}}</td>
                                            <td>{{$materi->title}}</td>
                                            <td>{{$materi->week}}</td>
                                            <td style="display: flex; justify-content: space-around;">
                                                <form  class="submitForm" action="/admin/editMateri/{{$materi->id}}" method="GET">
                                                    <button type="submit" class="btn btn-outline-success btn-sm btn-pill btnSubmit py-2 px-3">Edit</button>
                                                </form>
                                                <form class="submitForm" action="/admin/deleteMateri" method="POST">@csrf<input name="id" value="{{$materi->id}}" style="display:none">
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-pill btnSubmit py-2 px-3">Delete</button>
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