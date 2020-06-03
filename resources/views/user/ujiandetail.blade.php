@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2 id="time"></h2>
                <div class="row mt-5">
                    <div class="col-12">
                        <form action="/user/saveAnswer" method="POST" id="saveAnswer">
                            @csrf
                            <input value="{{$user_ujian->ujian->id}}" name="ujian_id" style="display:none"/>
                            @php($num=1)
                            @php($index=0)
                            @foreach($user_ujian->ujian->pertanyaans as $pertanyaan)
                            <div class="card">
                                <h5 class="card-header">{{$num}}. {{$pertanyaan->soal_ujian}}</h5>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="pertanyaan"></label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jawaban{{$pertanyaan->id}}" id="jawabanA{{$pertanyaan->id}}" value="1" >
                                            <label class="form-check-label" for="jawabanA">
                                                A. {{$pertanyaan->jawaban_a}}
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jawaban{{$pertanyaan->id}}" id="jawabanB{{$pertanyaan->id}}" value="2">
                                            <label class="form-check-label" for="jawabanB">
                                                B. {{$pertanyaan->jawaban_b}}
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jawaban{{$pertanyaan->id}}" id="jawabanC{{$pertanyaan->id}}" value="3">
                                            <label class="form-check-label" for="jawabanC">
                                                C. {{$pertanyaan->jawaban_c}}
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jawaban{{$pertanyaan->id}}" id="jawabanD{{$pertanyaan->id}}" value="4">
                                            <label class="form-check-label" for="jawabanD">
                                                D. {{$pertanyaan->jawaban_d}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php($num++)
                            @endforeach
                        </form>

                        <form action="/user/submitAnswer" method="POST" style="display:none" id="submitAnswer">
                            @csrf
                            <input value="{{$user_ujian->ujian->id}}" name="ujian_id" style="display:none"/>
                            @php($num=1)
                            @foreach($user_ujian->ujian->pertanyaans as $pertanyaan)
                            <div class="card">
                                <h5 class="card-header">{{$num}}. {{$pertanyaan->soal_ujian}}</h5>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="pertanyaan"></label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="text" name="jawaban{{$pertanyaan->id}}" id="jawaban{{$pertanyaan->id}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php($num++)
                            @endforeach
                        </form>

                        <div class="row justify-content-center mt-5">
                            <button id="btnSave" type="submit" class="btn btn-primary mr-3" onclick="event.preventDefault(); document.getElementById('saveAnswer').submit();">Save Answers</button>
                            <button id="btnSubmit" type="submit" class="btn btn-success" onclick="event.preventDefault(); document.getElementById('submitAnswer').submit();">Submit Answers</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/js/jquery-3.4.1.slim.min.js"></script>
    <script>
        var data = @json($user_ujian->ujian->pertanyaans);
        var data2 = @json($user_ujian->user_ujian_details);
        $.each(data, function( index, value ) {
            $("#jawabanA"+data[index].id).change(function(){
                if($(this).prop("checked")){
                    $("#jawaban"+data[index].id).val($(this).val());
                }
            });
            $("#jawabanB"+data[index].id).change(function(){
                if($(this).prop("checked")){
                    $("#jawaban"+data[index].id).val($(this).val());
                }
            });
            $("#jawabanC"+data[index].id).change(function(){
                if($(this).prop("checked")){
                    $("#jawaban"+data[index].id).val($(this).val());
                }
            });
            $("#jawabanD"+data[index].id).change(function(){
                if($(this).prop("checked")){
                    $("#jawaban"+data[index].id).val($(this).val());
                }
            });
        });
        $.each(data2, function( index, value ) {
            if(data2[index].jawaban==1){
                $("#jawabanA"+data2[index].pertanyaan_id).prop("checked",true);
            }
            else if(data2[index].jawaban==2){
                $("#jawabanB"+data2[index].pertanyaan_id).prop("checked",true);
            }
            else if(data2[index].jawaban==3){
                $("#jawabanC"+data2[index].pertanyaan_id).prop("checked",true);
            }
            else if(data2[index].jawaban==4){
                $("#jawabanD"+data2[index].pertanyaan_id).prop("checked",true);
            }
            $("#jawaban"+data2[index].pertanyaan_id).val(data2[index].jawaban);
        });
    </script>
    <script>
        var countDownDate = {{$duration}}
        console.log(countDownDate);
        var x = setInterval(function() {
            countDownDate--;

            var minutes = Math.floor(countDownDate/60);
            var seconds = Math.floor(countDownDate%60);
            $("#time").text(minutes+":"+seconds);
                
            if (countDownDate <= 0) {
                clearInterval(x);
                $("#btnSubmit").click();
            }
        }, 1000);
    </script>
@endsection
