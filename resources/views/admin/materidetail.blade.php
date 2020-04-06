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
                                <label for="file_upload" class="col-3">Pilih jenis materi baru</label>
                                <label class="col-1 col-form-label">:</label>
                                <select class="form-control col-7" id="materi_type" name="materi_type" required>
                                    <option value="file_upload">unggah file</option>
                                    <option value="biasa" selected>manual</option>
                                </select>
                            </div>
                            <input style="display:none" name="materi_id" value="{{$materi->id}}">
                            
                            <div class="form-group row" id="file_upload" style="display:none">
                                <label for="file_upload" class="col-3">Pilih file (TXT, PNG, 3GP)</label>
                                <label class="col-1 col-form-label">:</label>
                                <input class="col-7" type="file" name="file" accept=".txt, .png, .3gp">
                            </div>
                            <div class="form-group row" id="submit_form">
                                <label for="paragraph" class="col-3">Paragrap</label>
                                <label class="col-1 col-form-label">:</label>
                                <textarea class="form-control col-7" name="paragraph" rows="5"name="txt"></textarea>
                            </div>
                            
                            <div class="row justify-content-center">
                                <button id="btnSubmit" type="submit" class="btn btn-success">Kirim</button>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if(count($materi->materi_details)==0)
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Pratinjau</h2>
                <div class="preview">
                    <p>Tidak ada detail saat ini dipilih untuk ditampilkan</p>
                    <p>Mohon unggah atau kirim materi untuk bisa ditampilkan</p>
                </div>
            </div>
        </div>
        @else
        <div class="row mt-3 justify-content-center show">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Pratinjau</h2>
                <br>
                <button id="show">tampilkan garis dan tombol</button>
                <div class="preview">
                    @foreach($materi->materi_details as $detail)
                        <div style="border-style:solid;border-width: 2px;">
                            @if($detail->type == "paragraph")        
                                <p>&nbsp;&nbsp;&nbsp;&nbsp;{{$detail->value}}</p>
                            @elseif($detail->type == "image/png")
                                <img src="data:image/png;base64,{{$detail->value}}" data-toggle="modal" data-target="#previewMedia" width="400px"  alt="">
                            @endif
                            <form action="/admin/editMateri/{{$detail->materi_id}}/{{$detail->id}}" method="GET">
                                <button type="submit">ubah</button>
                            </form>
                            <form action="/admin/deleteMateriDetail" method="post">@csrf
                                <input style="display:none" name="id" value="{{$detail->id}}">
                                <input style="display:none" name="mstr_id" value="{{$detail->materi_id}}">
                                <button type="submit">hapus</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="row mt-3 justify-content-center hide">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Pratinjau</h2>
                <br>
                <button id="hide">tampilkan garis dan tombol</button>
                <div class="preview">
                    @foreach($materi->materi_details as $detail)
                        @if($detail->type == "paragraph")        
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;{{$detail->value}}</p>
                        @elseif($detail->type == "image/png")
                            <img src="data:image/png;base64,{{$detail->value}}" data-toggle="modal" data-target="#previewMedia" width="400px"  alt="">
                        @endif
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