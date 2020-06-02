@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center hide">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>{{$materi->title}}</h2>
                <br>
                <div class="preview">
                    <div class="card">
                        <h5 class="card-header"></h5>
                        <div class="card-body">
                            @foreach($materi->materi_details as $detail)
                                @if($detail->type == "paragraph")        
                                    <p class="card-text">{!! nl2br($detail->value) !!}</p>
                                @elseif($detail->type == "image/png")
                                    <div class="row justify-content-center">
                                        <img src="data:image/png;base64,{{$detail->value}}" data-toggle="modal" data-target="#previewMedia" width="400px"  alt="">
                                    </div>
                                @elseif($detail->type == "application/pdf")
                                    <iframe src="data:application/pdf;base64,{{$detail->value}}" height="500" width="100%"></iframe>
                                @elseif($detail->type == "video/mp4")
                                    <video controls width="100%" height="300">
                                        <source src="data:video/mp4;base64,{{$detail->value}}" />
                                    </video>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
          
    </div>
@endsection