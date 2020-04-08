@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>{{$user_ujian->ujian->exam_title}}</h2>
                
                <div class="row mt-5">
                    <div class="col-12">
                        @foreach($user_ujian->ujian->pertanyaans as $pertanyaan) 
                            <div class="form-group row">
                                <label for="pertanyaan" class="col-3 inputRequired">{{$pertanyaan->soal_ujian}}</label>
                                <label for="pertanyaan" class="col-3 inputRequired">{{$pertanyaan->jawaban_a}}</label>
                                <label for="pertanyaan" class="col-3 inputRequired">{{$pertanyaan->jawaban_b}}</label>
                                <label for="pertanyaan" class="col-3 inputRequired">{{$pertanyaan->jawaban_c}}</label>
                                <label for="pertanyaan" class="col-3 inputRequired">{{$pertanyaan->jawaban_d}}</label>
                                
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection