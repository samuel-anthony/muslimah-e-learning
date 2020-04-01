@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>{{$materi->title}}</h2>

                <div class="row mt-5">
                    <div class="col-12">
                        <form action="" method="post">
                            <div class="form-group row">
                                <label for="file_upload" class="col-3">Pilih file (TXT, PNG, 3GP)</label>
                                <label class="col-1 col-form-label">:</label>
                                <input class="col-7" type="file" id="file_upload" name="file_upload" accept=".txt, .png, .3gp">
                            </div>
                            <div class="form-group row">
                                <label for="paragraph" class="col-3">Paragrap</label>
                                <label class="col-1 col-form-label">:</label>
                                <textarea class="form-control col-7" id="paragraph" rows="5"></textarea>
                            </div>
                            
                            <div class="row justify-content-center">
                                <button id="btnSubmit" type="button" class="btn btn-success">Kirim</button>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Pratinjau</h2>
                <div class="preview">
                    <p>Tidak ada file saat ini dipilih untuk diunggah</p>
                </div>
            </div>
        </div>
    </div>
@endsection