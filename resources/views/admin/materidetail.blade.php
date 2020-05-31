@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>{{$materi->title}}</h2>

                <div class="row mt-5">
                    <div class="col-12">
                        <form action="/admin/submitMateriDetail" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="file_upload" class="col-3">Select Material Type</label>
                                <label class="col-1 col-form-label">:</label>
                                <select class="form-control col-7" id="materi_type" name="materi_type" required>
                                    <option value="biasa" selected>Manual</option>
                                    <option value="file_upload">File Upload</option>
                                </select>
                            </div>
                            <input style="display:none" name="materi_id" value="{{$materi->id}}">
                            
                            <div class="form-group row" id="file_upload" style="display:none">
                                <label for="file_upload" class="col-3">Choose file (TXT, PNG, 3GP)</label>
                                <label class="col-1 col-form-label">:</label>
                                <input class="col-7" type="file" name="file" accept=".txt, .png, .3gp, .pdf">
                            </div>
                            <div class="form-group row" id="submit_form">
                                <label for="paragraph" class="col-3">Paragraph</label>
                                <label class="col-1 col-form-label">:</label>
                                <textarea class="form-control col-7" name="paragraph" rows="5"name="txt"></textarea>
                            </div>
                            
                            <div class="row justify-content-center">
                                <button id="btnSubmit" type="submit" class="btn btn-success">Post</button>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if(count($materi->materi_details)==0)
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Preview</h2>
                <div class="preview">
                    <p>No Detail Display</p>
                    <p>Please Upload a Material to be Displayed</p>
                </div>
            </div>
        </div>
        @else
        <div class="row mt-3 justify-content-center show">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Preview</h2>
                <br>
                <div class="row justify-content-end mr-1 mb-3">
                    <button id="show" class="btn btn-primary">Hide Line and Button</button>
                </div>
                <div class="preview">
                    @foreach($materi->materi_details as $detail)
                        <div style="border-style:solid;border-width: 2px;" class="mb-5">
                            <div class="card">
                                <h5 class="card-header"></h5>
                                <div class="card-body">
                                    @if($detail->type == "paragraph")            
                                        {!! nl2br($detail->value) !!}
                                    @elseif($detail->type == "image/png")
                                        <div class="row justify-content-center">
                                            <img src="data:image/png;base64,{{$detail->value}}" data-toggle="modal" data-target="#previewMedia" width="400px" alt="">
                                        </div>
                                    @elseif($detail->type == "application/pdf")
                                        <iframe src="data:application/pdf;base64,{{$detail->value}}" height="500" width="100%"></iframe>
                                    @endif
                                    <div class="row justify-content-center mb-3">
                                        <form action="/admin/editMateri/{{$detail->materi_id}}/{{$detail->id}}" method="GET">
                                            <button type="submit" class="btn btn-primary mr-3">Edit</button>
                                        </form>
                                        <form action="/admin/deleteMateriDetail" method="post">@csrf
                                            <input style="display:none" name="id" value="{{$detail->id}}">
                                            <input style="display:none" name="mstr_id" value="{{$detail->materi_id}}">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="row mt-3 justify-content-center hide">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Preview</h2>
                <br>
                <div class="row justify-content-end mr-1 mb-3">
                    <button id="hide" class="btn btn-primary">Show Line and Button</button>
                </div>
                <div class="preview ">
                    @foreach($materi->materi_details as $detail)
                        <div class="card mb-5">
                            <h5 class="card-header"></h5>
                            @if($detail->type == "paragraph")        
                                {!! nl2br($detail->value) !!}
                            @elseif($detail->type == "image/png")
                                <div class="row justify-content-center">
                                    <img src="data:image/png;base64,{{$detail->value}}" data-toggle="modal" data-target="#previewMedia" width="400px"  alt="">
                                </div>
                            @elseif($detail->type == "application/pdf")
                                <iframe src="data:application/pdf;base64,{{$detail->value}}" height="500" width="100%"></iframe>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
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
            $(".show").show();
            $("#show").click(function(){
                $(".hide").show();
                $(".show").hide();
            });
            $(".hide").hide();
            $("#hide").click(function(){
                $(".show").show();
                $(".hide").hide();
            });
        </script>

    </div>
@endsection