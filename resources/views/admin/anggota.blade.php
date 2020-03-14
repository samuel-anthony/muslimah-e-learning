@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Anggota</h2>
                
                <div class="row mt-5">
                    <div class="col-8">
                        <form action="tambahanggota" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="userId">Nama Depan</label>
                                <input type="text" class="form-control" placeholder="Masukan Nama Depan" name="first_name" required>
                            </div>
                            <div class="form-group">
                                <label for="userId">Nama Belakang</label>
                                <input type="text" class="form-control" placeholder="Masukan Nama Belakang" name="last_name" required>
                            </div>
                            <div class="form-group">
                                <label for="nomor">No Hp</label>
                                <input type="number" class="form-control" id="nomor" placeholder="Masukan No Hp" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Masukan Email" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-success">Tambah Anggota</button>
                        </form>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">No</th>
                                    <th scope="col" width="30%">Nama Depan</th>
                                    <th scope="col" width="30%">Nama Belakang</th>
                                    <th scope="col" width="15%">Nomor HP</th>
                                    <th scope="col" width="15%">Email</th>
                                    <th scope="col" width="15%">Total Lulus Ujian</th>
                                    <th scope="col" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($users)>0)
                                    @php($num = 1)
                                    @foreach($users as $user)
                                        <tr>
                                            <th scope="row">{{$num}}</th>
                                            <td>{{$user->first_name}}</td>
                                            <td>{{$user->last_name}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>0</td><!--masi belom ada relasi-->
                                            <td style="display: flex; justify-content: space-around;">
                                                <form>
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-pill btnSubmit py-2 px-3">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php($num++)
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">Records Not Found</td>
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