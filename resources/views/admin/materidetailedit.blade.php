@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2 class="mb-5">{{$materi->materi->title}}</h2>
                
                <div class="card mb-5">
                    <h5 class="card-header">Original Material</h5>
                    @if($materi->type == "paragraph")        
                        <p class="card-text ml-4">{!! nl2br($materi->value) !!}</p>
                    @elseif($materi->type == "image/png")
                        <div class="row justify-content-center">
                            <img src="data:image/png;base64,{{$materi->value}}" data-toggle="modal" data-target="#previewMedia" width="400px"  alt="">
                        </div>
                    @elseif($materi->type == "application/pdf")
                        <iframe src="data:application/pdf;base64,{{$materi->value}}" height="500" width="100%"></iframe> 
                    @elseif($materi->type == "video/mp4")
                        <video autoplay controls width="100%" height="300">
                            <source src="data:video/mp4;base64,{{$materi->value}}" />
                        </video>
                    @endif
                </div>

                <div class="card">
                    <h5 class="card-header">New Material</h5>
                    <div class="col-12 my-5">
                        <form action="/admin/editMateriDetail" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="file_upload" class="col-3">Select Material Type</label>
                                <label class="col-1 col-form-label">:</label>
                                <select class="form-control col-7" id="materi_type" name="materi_type" required>
                                    <option value="file_upload" @if($materi->type !="paragraph") selected @endif>File Upload</option>
                                    <option value="biasa" @if($materi->type =="paragraph") selected @endif>Manual</option>
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
                                <label for="file_upload" class="col-3">Choose file (PDF, PNG, MP4)</label>
                                <label class="col-1 col-form-label">:</label>
                                <input class="col-7" type="file" name="file" accept=".png, .pdf, .mp4">
                            </div>
                            <div class="form-group row" id="submit_form" @if($materi->type !="paragraph") style="display:none" @endif>
                                <label for="paragraph" class="col-3">Paragraph</label>
                                <label class="col-1 col-form-label">:</label>
                                <textarea class="form-control col-7" name="paragraph" rows="5"name="txt">@if($materi->type =="paragraph"){{$materi->value}}@endif</textarea>
                            </div>
                            
                            <div class="row justify-content-center">
                                <button id="btnSubmit" type="submit" class="btn btn-success">Post</button>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection