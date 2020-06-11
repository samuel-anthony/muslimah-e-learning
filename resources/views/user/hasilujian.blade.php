@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>{{$ujian->exam_title}}</h2>
                
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="judul" class="col-3 inputRequired">Exam Audience</label>
                            <div class="col-1">:</div>
                            <label for="judul" class="col-3">{{Auth::user()->first_name.' '.Auth::user()->last_name}}</label>
                        </div>
                        <div class="form-group row">
                            <label for="judul" class="col-3 inputRequired">Score</label>
                            <div class="col-1">:</div>
                            <label for="judul" class="col-3">{{$ujian->score*100}}%</label>
                        </div>
                        <div class="form-group row">
                            <label for="judul" class="col-3 inputRequired">Exam Grade</label>
                            <div class="col-1">:</div>
                            <label for="judul" class="col-3">{{$ujian->grade}}</label>
                        </div>
                        <div class="form-group row">
                            <label for="judul" class="col-3 inputRequired">Status</label>
                            <div class="col-1">:</div>
                            <label for="judul" class="col-3">@if($ujian->score>0.5)Passed @else Failed @endif</label>
                        </div>
                    </div>
                </div>
		
                <div class="row mt-5">
                    <div class="col-12">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col" width="5%">No</th>
                                    <th scope="col" width="55%">Question</th>
                                    <th scope="col" width="20%">Correct Answer</th>
                                    <th scope="col" width="20%">Your Answer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($num=1)
                                @foreach($ujian->pertanyaans as $pertanyaan)
                                    <tr>
                                        <td scope="col" width="5%" class="text-center">{{$num}}</td>
                                        <td scope="col" width="50%">{{$pertanyaan->soal_ujian}}</td>
                                        <td scope="col" width="25%">{{$pertanyaan->jawaban_benar_text}}</td>
                                        <td scope="col" width="25%">{{$pertanyaan->jawaban_user}}</td>
                                    </tr>
                                    @php($num++)
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <form action="/user/exportHasilUjian" method="POST">
                    @csrf
                    <input value="{{$ujian->id}}" name="ujian_id" style="display:none">
                    <button type="submit" class="btn btn-outline-success btn-sm btn-pill btnSubmit py-2 px-3">Download Report excel</button>
                </form>
                <form action="/user/exportHasilUjianpdf" method="POST">
                    @csrf
                    <input value="{{$ujian->id}}" name="ujian_id" style="display:none">
                    <button type="submit" class="btn btn-outline-success btn-sm btn-pill btnSubmit py-2 px-3">Download Report pdf</button>
                </form>
            </div>
        </div>
    </div>
@endsection