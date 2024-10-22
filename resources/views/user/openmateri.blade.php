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
                                    <video controls width="100%" height="300" download>
                                        <source src="data:video/mp4;base64,{{$detail->value}}" />
                                    </video>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Question and Answer</h2>
                <form action="/user/submitNewComment" method="post">
                    @csrf
                    <input value="{{$materi->id}}" style="display:none" name="id">
                    <div class="form-group row col-12" id="submit_form">
                        <label for="paragraph" class="col-3">Write a new discussion</label>
                        <label class="col-1 col-form-label">:</label>
                        <textarea class="form-control col-7" name="content" rows="5"name="txt" required></textarea>
                    </div>
                    <div class="row justify-content-end col-11">
                        <button type="submit" class="btn btn-success">Post</button>
                    </div>
                </form>
                <br>
                <div class="preview">
                    <h2>Comments</h2>
                    @if(count($comments)>0)
                        @foreach($comments as $comment)
                            {{$comment->user->first_name.' '.$comment->user->last_name}}<b>{{' ('.$comment->user->group->group_name.') '}}</b> :<br>{!! nl2br($comment->content) !!}<b style="color:#828282">&nbsp;&nbsp;&nbsp;&nbsp;{{$comment->updated_at}}</b>
                            @if($comment->user->id == \Auth::user()->id)<form action="/user/deleteComment" method="post">
                                    @csrf
                                    <input value="{{$comment->id}}" style="display:none" name="id">
                                    <button type="submit" class="btn btn-outline-danger col-1">delete</button>
                                </form>@endif
                            @foreach($comment->replies as $reply)
                                <p class="ml-5">{{$reply->user->first_name.' '.$reply->user->last_name}}<b>@if(is_null($reply->user->group)) {{' (admin) '}} @else {{' ('.$reply->user->group->group_name.') '}} @endif</b> :
                                <br/>{!! nl2br($reply->content) !!}<b style="color:#828282">&nbsp;&nbsp;&nbsp;&nbsp;{{$reply->updated_at}}</b>@if($reply->user->id == \Auth::user()->id)<form class="ml-5" action="/user/deleteComment" method="post">
                                    @csrf
                                    <input value="{{$reply->id}}" style="display:none" name="id">
                                    <button type="submit" class="btn btn-outline-danger col-1">delete</button>
                                </form>@endif</p>
                            @endforeach
                            <form class="ml-5" action="/user/replyComment" method="post">
                                @csrf
                                <input value="{{$materi->id}}" style="display:none" name="id">
                                <input value="{{$comment->id}}" style="display:none" name="parent_id">
                                <div class="form-group row" id="submit_form">
                                    <textarea class="form-control col-7" name="content" name="txt" required placeholder="write a reply"></textarea>
                                    <button type="submit" class="btn btn-success ml-3 col-1">Post</button>
                                </div>
                            </form>
                        @endforeach
                    @else
                        No Comments has posted
                    @endif
                </div>
            </div>
        </div>
        <br>
    </div>
@endsection