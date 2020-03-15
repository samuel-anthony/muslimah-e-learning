@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Daftar Pertanyaan</h2>
                
                <div class="row mt-5">
                    <div class="col-12">
                        <form action="" method="post">
                            <div class="form-group row">
                                <label for="pertanyaan" class="col-3 inputRequired">Question 1*</label>
								<div class="col-1">:</div>
                                <input type="text" class="form-control col-7" id="pertanyaan" placeholder="Enter Question" name="pertanyaan" required>
                            </div>
							<div class="form-group row">
                                <label for="pilihan1" class="col-3 inputRequired">Pilihan 1*</label>
								<div class="col-1">:</div>
                                <input type="text" class="form-control col-7" id="pilihan1" placeholder="Enter Title" name="pilihan1" required>
                            </div>
							<div class="form-group row">
                                <label for="pilihan2" class="col-3 inputRequired">Pilihan 2*</label>
								<div class="col-1">:</div>
                                <input type="text" class="form-control col-7" id="pilihan2" placeholder="Enter Title" name="pilihan2" required>
                            </div>
							<div class="form-group row">
                                <label for="pilihan3" class="col-3 inputRequired">Pilihan 3*</label>
								<div class="col-1">:</div>
                                <input type="text" class="form-control col-7" id="pilihan3" placeholder="Enter Title" name="pilihan3" required>
                            </div>
							<div class="form-group row">
                                <label for="pilihan4" class="col-3 inputRequired">Pilihan 4*</label>
								<div class="col-1">:</div>
                                <input type="text" class="form-control col-7" id="pilihan4" placeholder="Enter Title" name="pilihan4" required>
                            </div>
							<div class="form-group row">
                                <label for="answer" class="col-3 inputRequired">Jawaban*</label>
								<div class="col-1">:</div>
								<select class="form-control col-1" id="answer" name="answer" required>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
									<option>4</option>
                                </select>
							</div>
							<div class="row justify-content-center">
								<button type="submit" class="btn btn-success">Tambah Pertanyaan</button>
							</div>
                        </form>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">No</th>
                                    <th scope="col" width="55%">Pertanyaan</th>
                                    <th scope="col" width="20%">Jawaban Benar</th>
                                    <th scope="col" width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(is_null($question ?? null) || count($question) <= 0)
                                <tr>
                                    <td colspan="5" class="text-center">Records Not Found</td>
                                </tr>
                                @else
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Pertanyaan</td>
                                    <td>Jawaban Benar</td>
                                    <td style="display: flex; justify-content: space-around;">
                                        <form id="button-yes-question{{$question->question_id}}" class="submitForm" action="/admin/approve/question" method="POST">@csrf<input for="question" name="question" value="{{$question->question_id}}" style="display:none"><input for="adm" name="adm" value="{{$admin->adm_id}}" style="display:none">
                                            <button type="submit" class="btn btn-outline-success btn-sm btn-pill btnSubmit py-2 px-3">Edit</button>
                                        </form>
                                        <form id="button-no-question{{$question->question_id}}" class="submitForm" action="/admin/disapprove/question" method="POST">@csrf<input for="question" name="question" value="{{$question->question_id}}" style="display:none"><input for="adm" name="adm" value="{{$admin->adm_id}}" style="display:none">
                                            <button type="submit" class="btn btn-outline-danger btn-sm btn-pill btnSubmit py-2 px-3">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection