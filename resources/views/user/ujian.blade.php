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
                                    @foreach($ujians as $ujian)
                                        <option value="{{$ujian->id}}">{{$ujian->exam_title}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card" style="display:none" id="detail">
                    <div class="card-header">Detail Ujian</div>
                    <div class="card-body">
                        <div class="row">
                            <label for="userId" class="col-4">Nama Ujian</label>
                            <div class="col-1">:</div>
                            <p class="col-7" id="detail_nama">nama_ujian</p>
                        </div>
                        <div class="row" style="display:none">
                            <label for="userId" class="col-4">Materi Ujian</label>
                            <div class="col-1">:</div>
                            <p class="col-7" id="">materi_ujian</p>
                        </div>
                        <div class="row">
                            <label for="userId" class="col-4">Durasi Pengerjaan</label>
                            <div class="col-1">:</div>
                            <p class="col-7" id="detail_durasi">durasi_pengerjaan</p>
                        </div>
                        <div class="row">
                            <label for="userId" class="col-4">Ujian ditutup dalam waktu</label>
                            <div class="col-1">:</div>
                            <p class="col-7" id="detail_waktu">waktu_penutupan</p>
                        </div>
                    </div>
                    <form action="/user/ujian" method="post">
                        @csrf
                        <input style="display:none" name="ujian_id" id="ujian_id">
                        <div class="card-footer text-center" id="button_mulai">
                            <button type="submit" class="btn btn-primary">Mulai</button>
                        </div>
                    </form>
                </div>
                
                <script src="/assets/js/jquery-3.4.1.slim.min.js"></script>
                <script>
                    var data = @json($ujians);
                    $("#group_id").change(function (){
                        $("#detail").show();
                        $.each(data, function( index, value ) {
                            if(data[index].id == $("#group_id").val()){
                                $("#detail_nama").html(data[index].exam_title);
                                $("#detail_durasi").html(data[index].exam_duration) ;
                                $("#detail_waktu").html(data[index].end_date);
                                $("#ujian_id").val(data[index].id);
                                $("#button_mulai").show();
                                if(data[index].expired){
                                    $("#button_mulai").hide();
                                }
                                return false;
                            }
                        });
                    });
                </script>

            </div>
        </div>
    </div>
@endsection