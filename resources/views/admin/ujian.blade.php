@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Exam</h2>
                
                <div class="row mt-5">
                    <div class="col-12">
                        <form action="/admin/ujian" method="post" autocomplete="off" >
                            @csrf
                            <div class="form-group row">
                                <label for="examTitle" class="col-3 inputRequired">Exam Title*</label>
								<div class="col-1">:</div>
                                <input type="text" class="form-control col-7" id="examTitle" placeholder="Enter Exam Title" name="exam_title" required>
                            </div>
                            <div class="form-group row">
                                <label for="examDate" class="col-3 inputRequired">Week*</label>
								<div class="col-1">:</div>
                                <input type="number" class="form-control col-7 @error('week') is-invalid @enderror" id="examWeek" placeholder="Enter week when the material will be posted" name="week" required>
                                @error('week')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
							<!-- <div class="form-group row">
                                <label for="examTime" class="col-3 inputRequired">Exam Time*</label>
								<div class="col-1">:</div>
                                <input type="text" class="form-control col-3" id="examTime" placeholder="Enter Time" name="examTime" required>
                            </div> -->
							<div class="form-group row">
                                <label for="examDuration" class="col-3 inputRequired">Exam Duration*</label>
								<div class="col-1">:</div>
                                <input type="number" class="form-control col-7" id="exam_duration" placeholder="Enter Exam Duration in Minute" name="exam_duration" required>
								<!-- <select class="form-control col-3" id="examDuration" name="examDuration" required>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select> -->
							</div>
							<!-- <div class="form-group row">
                                <label for="examQuestion" class="col-3 inputRequired">Total Question*</label>
								<div class="col-1">:</div>
								<select class="form-control col-3" id="examQuestion" name="examQuestion" required>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
							</div>
							<div class="form-group row">
                                <label for="examRight" class="col-3 inputRequired">Mark for Right Answer*</label>
								<div class="col-1">:</div>
								<select class="form-control col-3" id="examRight" name="examRight" required>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
							</div>
							<div class="form-group row">
                                <label for="examWrong" class="col-3 inputRequired">Mark for Wrong Answer*</label>
								<div class="col-1">:</div>
								<select class="form-control col-3" id="examWrong" name="examWrong" required>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div> -->
							<div class="row justify-content-center">
								<button type="submit" class="btn btn-success">Add New Exam</button>
							</div>
                        </form>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col" width="5%">No</th>
                                    <th scope="col" width="30%">Title</th>
                                    <th scope="col" width="25%">Week</th>
                                    <th scope="col" width="25%">Duration in Minutes</th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(is_null($ujians ?? null) || count($ujians) <= 0)
                                <tr>
                                    <td colspan="5" class="text-center">Data not Found</td>
                                </tr>
                                @else
                                    @php($num = 1)
                                    @foreach($ujians as $ujian)
                                        <tr>
                                            <td scope="row" class="text-center">{{$num}}</td>
                                            <td>{{$ujian->exam_title}}</td>
                                            <td>{{$ujian->week}}</td>
                                            <td>{{$ujian->exam_duration}} menit</td>
                                            <td style="display: flex; justify-content: space-around;">
                                                <form class="submitForm" action="/admin/editUjian/{{$ujian->id}}" method="GET">
                                                    <button type="submit" class="btn btn-outline-success btn-sm btn-pill btnSubmit py-2 px-3">Edit</button>
                                                </form>
                                                <form class="submitForm" action="/admin/deleteUjian" method="POST">@csrf<input name="id" value="{{$ujian->id}}" style="display:none">
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-pill btnSubmit py-2 px-3">Delete</button>
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