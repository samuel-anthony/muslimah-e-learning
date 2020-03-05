@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-8 bg-light rounded py-4 px-5">
                <h2>Password</h2>
                
                <div class="row mt-5">
                    <div class="col-8">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="oldPassword">Password Lama</label>
                                <input type="text" class="form-control" id="oldPassword" placeholder="Enter Old Password" name="oldPassword" required>
                            </div>
                            <div class="form-group">
                                <label for="newPassword">Password Baru</label>
                                <input type="password" class="form-control" id="newPassword" placeholder="Enter New Password" name="newPassword" required>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection