@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>ANggota</h2>
                
                <div class="row mt-5">
                    <div class="col-8">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="userId">Nama</label>
                                <input type="text" class="form-control" id="userId" placeholder="Enter User ID" name="userid" required>
                            </div>
                            <div class="form-group">
                                <label for="nomor">No Hp</label>
                                <input type="number" class="form-control" id="nomor" placeholder="Enter No Hp" name="nomor" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required>
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
                                    <th scope="col" width="30%">Nama</th>
                                    <th scope="col" width="15%">Nomor HP</th>
                                    <th scope="col" width="15%">Email</th>
                                    <th scope="col" width="15%">Total Lulus Ujian</th>
                                    <th scope="col" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Minatorisato</td>
                                    <td>12347890</td>
                                    <td>admin@email.com</td>
                                    <td>5</td>
                                    <td style="display: flex; justify-content: space-around;">
                                        <form>
                                            <button type="submit" class="btn btn-outline-danger btn-sm btn-pill btnSubmit py-2 px-3">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection