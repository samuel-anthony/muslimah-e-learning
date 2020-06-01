@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-8 bg-light rounded py-4 px-5">
                <h2>Password</h2>
                
                <div class="row mt-5">
                    <div class="col-12">
                        <form action="/user/ubahpassword" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="oldPassword" class="col-3 inputRequired">Old Password*</label>
                                <div class="col-1">:</div>
                                <input type="password" class="form-control col-7 @if(!is_null($errorMessage)) is-invalid @endif" id="oldPassword" placeholder="Enter Old Password" name="oldPassword" minlength="6" maxlength="10" required>
                                @if(!is_null($errorMessage))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errorMessage }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group row">
                                <label for="newPassword" class="col-3 inputRequired">New Password*</label>
                                <div class="col-1">:</div>
                                <input type="password" class="form-control col-7" id="newPassword" placeholder="Enter New Password" name="newPassword" minlength="6" maxlength="10" required>
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-success">Simpan</button>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection