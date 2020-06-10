<?php
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=".$ujian->exam_title.".xls");
?>

            <h2>{{$ujian->exam_title}}</h2>
            
            <div class="row mt-5">
                <div class="col-12">
                    <div class="form-group row">
                        <label for="judul" class="col-3 inputRequired">Exam Audience : {{Auth::user()->first_name.' '.Auth::user()->last_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="judul" class="col-3 inputRequired">Score : {{$ujian->score*100}}%</label>
                    </div>
                    <div class="form-group row">
                        <label for="judul" class="col-3 inputRequired">Exam Grade : {{$ujian->grade}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="judul" class="col-3 inputRequired">Status : @if($ujian->score>0.5)Passed @else Failed @endif</label>
                    </div>
                </div>
            </div>
            <br>
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
            </div>
        </div>
    </div>
