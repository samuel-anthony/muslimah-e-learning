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
                                <label for="judul" class="col-2 inputRequired">Judul*</label>
                                <div class="col-1">:</div>
                                <input type="text" class="form-control col-7"  placeholder="Enter Judul" name="title" required>
                            </div>
                            <div class="form-group row">
                                <label for="judul" class="col-2 inputRequired">Minggu*</label>
                                <div class="col-1">:</div>
                                <input type="number" class="form-control col-7" placeholder="Enter Minggu keberapa materi ini di post" name="week" required>
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
                                        <button type="submit" class="btn btn-outline-success btn-sm btn-pill btnSubmit py-2 px-3" data-toggle="modal" data-target="#editMateri">Edit</button>
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

    <div class="modal fade" id="editMateri" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Judul_Materi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <form action="" method="POST" class="submitForm" enctype="multipart/form-data">
                            <div class="preview">
                                <p>No files currently selected for upload</p>
                            </div>
                            <div class="form-group row">
                                <label for="file_upload" class="col-4">Choose file to upload (TXT, PNG, 3GP)</label>
                                <label class="col-1 col-form-label">:</label>
                                <input class="col-6" type="file" id="file_upload" name="file_upload" accept=".txt, .png, .3gp">
                            </div>
                            <div class="form-group row">
                                <label for="paragraph" class="col-4">Paragraph</label>
                                <label class="col-1 col-form-label">:</label>
                                <textarea class="form-control col-5" id="paragraph" rows="5"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button id="btnSubmit" type="button" class="btn btn-success">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection