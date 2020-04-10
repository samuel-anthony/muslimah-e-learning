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
                                    <p class="card-text">{{$detail->value}}</p>
                                @elseif($detail->type == "image/png")
                                    <div class="row justify-content-center">
                                        <img src="data:image/png;base64,{{$detail->value}}" data-toggle="modal" data-target="#previewMedia" width="400px"  alt="">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
          
    </div>
@endsection