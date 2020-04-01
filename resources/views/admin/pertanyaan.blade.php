@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Ujian</h2>

                <div class="mt-5">
                    <form action="/admin/submitEditUjian" method="post">
                        @csrf
                        <input type="text" style="display:none" name="ujian_id" value="{{$ujian->id}}">
                        <div class="form-group row">
                            <label class="col-3 inputRequired">Judul</label>
                            <div class="col-1">:</div>
                            <input type="text" class="form-control col-7" placeholder="Enter Title" name="exam_title" required value="{{$ujian->exam_title}}">
                        </div>
                        <div class="form-group row">
                            <label class="col-3 inputRequired">Minggu Ke</label>
                            <div class="col-1">:</div>
                            <input type="number" class="form-control col-7" placeholder="Enter Week" name="week" required value="{{$ujian->week}}">
                        </div>
                        <div class="form-group row">
                            <label class="col-3 inputRequired">Waktu</label>
                            <div class="col-1">:</div>
                            <input type="number" class="form-control col-7" placeholder="Enter Exam Duration in minutes" name="exam_duration" required value="{{$ujian->exam_duration}}">
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
                
                <h2 class="mt-5">Daftar Pertanyaan</h2>
                
                <div class="row mt-5">
                    <div class="col-12">
                        @if($soalKe > count($soals))
                            <form action="/admin/submitPertanyaan" method="post">
                                @csrf
                                <input type="text" style="display:none" name="ujian_id" value="{{$ujian->id}}">
                                <div class="form-group row">
                                    <label for="pertanyaan" class="col-3 inputRequired">Pertanyaan ke {{$soalKe}}*</label>
                                    <div class="col-1">:</div>
                                    <input type="text" class="form-control col-7" id="pertanyaan" placeholder="Masukkan Pertanyaan" name="soal_ujian" required>
                                </div>
                                <div class="form-group row">
                                    <label for="pilihan1" class="col-3 inputRequired">Pilihan A*</label>
                                    <div class="col-1">:</div>
                                    <input type="text" class="form-control col-7" id="pilihan1" placeholder="Masukkan Pilihan" name="jawaban_a" required>
                                </div>
                                <div class="form-group row">
                                    <label for="pilihan2" class="col-3 inputRequired">Pilihan B*</label>
                                    <div class="col-1">:</div>
                                    <input type="text" class="form-control col-7" id="pilihan2" placeholder="Masukkan Pilihan" name="jawaban_b" required>
                                </div>
                                <div class="form-group row">
                                    <label for="pilihan3" class="col-3 inputRequired">Pilihan C*</label>
                                    <div class="col-1">:</div>
                                    <input type="text" class="form-control col-7" id="pilihan3" placeholder="Masukkan Pilihan" name="jawaban_c" required>
                                </div>
                                <div class="form-group row">
                                    <label for="pilihan4" class="col-3 inputRequired">Pilihan D*</label>
                                    <div class="col-1">:</div>
                                    <input type="text" class="form-control col-7" id="pilihan4" placeholder="Masukkan Pilihan" name="jawaban_d" required>
                                </div>
                                <div class="form-group row">
                                    <label for="answer" class="col-3 inputRequired">Jawaban*</label>
                                    <div class="col-1">:</div>
                                    <select class="form-control col-1" id="answer" name="jawaban_benar" required>
                                        <option value="1">A</option>
                                        <option value="2">B</option>
                                        <option value="3">C</option>
                                        <option value="4">D</option>
                                    </select>
                                </div>
                                <div class="row justify-content-center">
                                    <button type="submit" class="btn btn-success">Tambah Pertanyaan</button>
                                </div>
                            </form>
                        @else
                            <form action="/admin/submitEditPertanyaan" method="post">
                            @csrf
                                <input type="text" style="display:none" name="ujian_id" value="{{$ujian->id}}">
                                <input type="text" style="display:none" name="soal_id" value="{{$soals[$soalKe-1]->id}}">
                                <div class="form-group row">
                                    <label for="pertanyaan" class="col-3 inputRequired">Pertanyaan ke {{$soalKe}}*</label>
                                    <div class="col-1">:</div>
                                    <input type="text" class="form-control col-7" id="pertanyaan" placeholder="Masukkan Pertanyaan" name="soal_ujian" required value="{{$soals[$soalKe-1]->soal_ujian}}"> 
                                </div>
                                <div class="form-group row">
                                    <label for="pilihan1" class="col-3 inputRequired">Pilihan A*</label>
                                    <div class="col-1">:</div>
                                    <input type="text" class="form-control col-7" id="pilihan1" placeholder="Masukkan Pilihan" name="jawaban_a" required value="{{$soals[$soalKe-1]->jawaban_a}}">
                                </div>
                                <div class="form-group row">
                                    <label for="pilihan2" class="col-3 inputRequired">Pilihan B*</label>
                                    <div class="col-1">:</div>
                                    <input type="text" class="form-control col-7" id="pilihan2" placeholder="Masukkan Pilihan" name="jawaban_b" required value="{{$soals[$soalKe-1]->jawaban_b}}">
                                </div>
                                <div class="form-group row">
                                    <label for="pilihan3" class="col-3 inputRequired">Pilihan C*</label>
                                    <div class="col-1">:</div>
                                    <input type="text" class="form-control col-7" id="pilihan3" placeholder="Masukkan Pilihan" name="jawaban_c" required value="{{$soals[$soalKe-1]->jawaban_c}}">
                                </div>
                                <div class="form-group row">
                                    <label for="pilihan4" class="col-3 inputRequired">Pilihan D*</label>
                                    <div class="col-1">:</div>
                                    <input type="text" class="form-control col-7" id="pilihan4" placeholder="Masukkan Pilihan" name="jawaban_d" required value="{{$soals[$soalKe-1]->jawaban_d}}">
                                </div>
                                <div class="form-group row">
                                    <label for="answer" class="col-3 inputRequired">Jawaban*</label>
                                    <div class="col-1">:</div>
                                    <select class="form-control col-1" id="answer" name="jawaban_benar" required>
                                        <option value="1" @if($soals[$soalKe-1]->jawaban_benar == 1) selected @endif>A</option>
                                        <option value="2" @if($soals[$soalKe-1]->jawaban_benar == 2) selected @endif>B</option>
                                        <option value="3" @if($soals[$soalKe-1]->jawaban_benar == 3) selected @endif>C</option>
                                        <option value="4" @if($soals[$soalKe-1]->jawaban_benar == 4) selected @endif>D</option>
                                    </select>
                                </div>
                                <div class="row justify-content-center">
                                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                </div>
                            </form>
                        @endif
                        
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col" width="5%">No</th>
                                    <th scope="col" width="30%">Pertanyaan</th>
                                    <th scope="col" width="25%">Pilihan Jawaban</th>
                                    <th scope="col" width="20%">Jawaban Benar</th>
                                    <th scope="col" width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(is_null($soals ?? null) || count($soals) <= 0)
                                <tr>
                                    <td colspan="5" class="text-center">Data Tidak Ditemukan</td>
                                </tr>
                                @else
                                    @php($num = 1)
                                    @foreach($soals as $soal)
                                        <tr>
                                            <td scope="row" class="text-center">{{$num}}</td>
                                            <td>{{$soal->soal_ujian}}</td>
                                            <td>
                                                A. {{$soal->jawaban_a}}<br>
                                                B. {{$soal->jawaban_b}}<br>
                                                C. {{$soal->jawaban_c}}<br>
                                                D. {{$soal->jawaban_d}}
                                            </td>
                                            <td>
                                                @if($soal->jawaban_benar == 1)A.
                                                @elseif($soal->jawaban_benar == 2)B.
                                                @elseif($soal->jawaban_benar == 3)C.
                                                @elseif($soal->jawaban_benar == 4)D.
                                                @endif
                                            </td>
                                            <td style="display: flex; justify-content: space-around;">
                                                <form id="button-yes-question{{$soal->id}}" class="submitForm" action="/admin/editPertanyaan/{{$soal->id}}" method="GET">
                                                    <button type="submit" class="btn btn-outline-success btn-sm btn-pill btnSubmit py-2 px-3">Ubah</button>
                                                </form>
                                                <form id="button-no-question{{$soal->id}}" class="submitForm" action="/admin/deletePertanyaan" method="POST">@csrf<input name="id" value="{{$soal->id}}" style="display:none">
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-pill btnSubmit py-2 px-3">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php($num++)
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection