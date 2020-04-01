@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Ujian</h2>
                
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="group_id" class="col-3 inputRequired">Pilih Ujian*</label>
                            <div class="col-1">:</div>
                            <select class="form-control col-4" id="group_id" name="group_id" required>
                                    <option value="">Pilih Salah Satu Ujian</option>
                                    <option value="ujian1">Ujian 1</option>
                                    <option value="ujian2">Ujian 2</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Detail Ujian 1</div>
                    <div class="card-body">
                        <div class="row">
                            <label for="userId" class="col-4">Nama Ujian</label>
                            <div class="col-1">:</div>
                            <p class="col-7">nama_ujian</p>
                        </div>
                        <div class="row">
                            <label for="userId" class="col-4">Materi Ujian</label>
                            <div class="col-1">:</div>
                            <p class="col-7">materi_ujian</p>
                        </div>
                        <div class="row">
                            <label for="userId" class="col-4">Durasi Pengerjaan</label>
                            <div class="col-1">:</div>
                            <p class="col-7">durasi_pengerjaan</p>
                        </div>
                        <div class="row">
                            <label for="userId" class="col-4">Ujian ditutup dalam waktu</label>
                            <div class="col-1">:</div>
                            <p class="col-7">waktu_penutupan</p>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">Mulai</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection