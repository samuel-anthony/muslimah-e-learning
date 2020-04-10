@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>{{$user_ujian->ujian->exam_title}}</h2>
                
                <div class="row mt-5">
                    <div class="col-12">
                        @foreach($user_ujian->ujian->pertanyaans as $pertanyaan) 
                        <div class="card">
                            <h5 class="card-header">Pertanyaan Ke - </h5>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="pertanyaan">1. {{$pertanyaan->soal_ujian}} ?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jawaban" id="jawabanA" value="option1">
                                        <label class="form-check-label" for="jawabanA">
                                            A. {{$pertanyaan->jawaban_a}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jawaban" id="jawabanB" value="option2">
                                        <label class="form-check-label" for="jawabanB">
                                            B. {{$pertanyaan->jawaban_b}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jawaban" id="jawabanC" value="option3">
                                        <label class="form-check-label" for="jawabanC">
                                            C. {{$pertanyaan->jawaban_c}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jawaban" id="jawabanD" value="option4">
                                        <label class="form-check-label" for="jawabanD">
                                            D. {{$pertanyaan->jawaban_d}}
                                        </label>
                                    </div>
                                    <div class="row justify-content-center mt-5">
                                        <button id="btnSave" type="submit" class="btn btn-primary mr-3">Simpan Jawaban</button>
                                        <button id="btnSubmit" type="submit" class="btn btn-success">Kirim Jawaban</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection