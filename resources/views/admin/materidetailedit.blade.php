@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>{{$materi->materi->title}}</h2>
                <br><br>
                <h4>Materi original</h4>
                @if($materi->type == "paragraph")        
                    <p>{{$materi->value}}</p>
                @elseif($materi->type == "image/png")
                    <img src="data:image/png;base64,{{$materi->value}}" data-toggle="modal" data-target="#previewMedia" width="400px"  alt="">
                @endif
                
                <h4>Materi edit</h4>
                <div class="row mt-5">
                    <div class="col-12">
                        <form action="/admin/editMateriDetail" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="file_upload" class="col-3">Pilih jenis materi baru</label>
                                <label class="col-1 col-form-label">:</label>
                                <select class="form-control col-7" id="materi_type" name="materi_type" required>
                                    <option value="file_upload" @if($materi->type !="paragraph") selected @endif>unggah file</option>
                                    <option value="biasa" @if($materi->type =="paragraph") selected @endif>manual</option>
                                </select>
                            </div>
                            <input style="display:none" name="id" value="{{$materi->id}}">
                            <script src="/assets/js/jquery-3.4.1.slim.min.js"></script>
                            <script>                                
                                $("#materi_type").change(function (){
                                    if($(this).val()=="file_upload"){
                                        $("#file_upload").show();
                                        $("#submit_form").hide();
                                    }
                                    else{
                                        $("#file_upload").hide();
                                        $("#submit_form").show();
                                    }
                                });
                            </script>

                            <div class="form-group row" id="file_upload" @if($materi->type =="paragraph") style="display:none" @endif>
                                <label for="file_upload" class="col-3">Pilih file (TXT, PNG, 3GP)</label>
                                <label class="col-1 col-form-label">:</label>
                                <input class="col-7" type="file" name="file" accept=".txt, .png, .3gp">
                            </div>
                            <div class="form-group row" id="submit_form" @if($materi->type !="paragraph") style="display:none" @endif>
                                <label for="paragraph" class="col-3">Paragrap</label>
                                <label class="col-1 col-form-label">:</label>
                                <textarea class="form-control col-7" name="paragraph" rows="5"name="txt">@if($materi->type =="paragraph"){{$materi->value}}@endif</textarea>
                            </div>
                            
                            <div class="row justify-content-center">
                                <button id="btnSubmit" type="submit" class="btn btn-success">Kirim</button>
							</div>
                        </form>
                    </div>
                </div>
                
    </div>
@endsection