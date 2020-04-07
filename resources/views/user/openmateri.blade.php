@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center hide">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>{{$materi->title}}</h2>
                <br>
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
          
    </div>
@endsection