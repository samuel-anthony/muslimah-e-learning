@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>{{$ujian->exam_title}}</h2>
                
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="judul" class="col-3 inputRequired">Nilai Ujian</label>
                            <div class="col-1">:</div>
                            <label for="judul" class="col-3">{{$ujian->score*100}}%</label>
                        </div>
                        <div class="form-group row">
                            <label for="judul" class="col-3 inputRequired">Hasil Ujian</label>
                            <div class="col-1">:</div>
                            <label for="judul" class="col-3">{{$ujian->grade}}</label>
                        </div>
                    </div>
                </div>
		
                <div class="row mt-5">
                    <div class="col-12">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col" width="5%">No</th>
                                    <th scope="col" width="55%">Soal</th>
                                    <th scope="col" width="20%">jawaban benar</th>
                                    <th scope="col" width="20%">jawaban user</th>
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
            </div>
        </div>
    </div>
@endsection