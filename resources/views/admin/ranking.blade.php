@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Ranking List</h2>
                
                <div class="row mt-5">
                    <div class="col-12">
                            <div class="form-group row">
                                <label for="judul" class="col-3 inputRequired">Group*</label>
                                <div class="col-1">:</div>
                                <select class="form-control col-4" id="group_id" name="group_id" required>
                                    <option value="">Choose Group</option>
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->group_name}}</option>    
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="judul" class="col-3 inputRequired">Exam Title*</label>
                                <div class="col-1">:</div>
                                <select class="form-control col-4" id="exam_id" name="exam_id" required>
                                    <option value="">Choose Exam Title</option>
                                </select>
                                <div class="col-1"></div>
                                <button type="submit" class="btn btn-success col-2" id="button_check">Check</button>
                        
                            </div>
                    </div>
                </div>
		

                <div class="row mt-5 col-12 justify-content-end">
                    <select id='sortTable' class="btn btn-primary">
                        <option value="1" selected>Highest To Lowest</option>
                        <option value="2">Lowest To Highest</option>
                    </select>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col" width="5%">No</th>
                                    <th scope="col" width="35%">Name </th>
                                    <th scope="col" width="10%">Group</th>
                                    <th scope="col" width="20%">Date Taking Exam</th>
                                    <th scope="col" width="10%">Score</th>
                                    <th scope="col" width="20%">Grade</th>
                                </tr>
                            </thead>
                            <tbody id="table">
                                <tr>
                                    <td colspan="6" class="text-center">Data not Found</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script src="/assets/js/jquery-3.4.1.slim.min.js"></script>
<script>   
    const groups = @json($groups);
    console.log(groups);
    let choosenGroup,choosenExam;
    $( "#group_id" ).change(function() {
        $('#exam_id').empty().append('<option value="">Pilih Salah Satu Judul Ujian</option>');
        const id = $(this).val();
        choosenExam = null;
        choosenGroup = groups.find(group=>group.id == id);
        console.log(choosenGroup);
        if(!!choosenGroup){
            choosenGroup.ujians.forEach(
                (ujian) => {$('#exam_id').append(new Option(ujian.exam_title,ujian.id));});
        }
    });
    $( "#exam_id" ).change(function() {
        const id = $(this).val();
        choosenExam = choosenGroup.ujians.find(ujian=>ujian.id == id);
        console.log(choosenExam);
    });
    $( "#button_check" ).click(function(){
        if(!!choosenExam && !!choosenGroup){
            $("#table").empty();
            if($("#sortTable").val() === "1")
                choosenExam.dataUjian.sort(function (a, b) {
                    return  b.score-a.score; //dari gede ke kecil 
                });
            else
                choosenExam.dataUjian.sort(function (a, b) {
                    return  a.score-b.score; //dari gede ke kecil 
                });
            let number = 1;
            choosenExam.dataUjian.forEach((data)=>{
                const newRow = '<tr><td>'+number+'</td><td>'+data.name+'</td><td>'+data.group+'</td><td>'+data.created_at+'</td><td>'+data.score+'%</td><td>'+data.grade+'</td></tr>';
                $("#table").append(newRow);
                number++;
            });
            if(choosenExam.dataUjian.length ==0)
                $("#table").empty().append('<tr><td colspan="6" class="text-center">Data not Found</td></tr>');
        }
        else{
            $("#table").empty().append('<tr><td colspan="6" class="text-center">Data not Found</td></tr>');
        }
    });
    $("#sortTable").change(()=>{
        if(!!choosenExam && !!choosenGroup){
            $("#table").empty();
            if($("#sortTable").val() === "1")
                choosenExam.dataUjian.sort(function (a, b) {
                    return  b.score-a.score; //dari gede ke kecil 
                });
            else
                choosenExam.dataUjian.sort(function (a, b) {
                    return  a.score-b.score; //dari gede ke kecil 
                });
            let number = 1;
            choosenExam.dataUjian.forEach((data)=>{
                const newRow = '<tr><td>'+number+'</td><td>'+data.name+'</td><td>'+data.group+'</td><td>'+data.created_at+'</td><td>'+data.score+'%</td><td>'+data.grade+'</td></tr>';
                $("#table").append(newRow);
                number++;
            });
            if(choosenExam.dataUjian.length ==0)
                $("#table").empty().append('<tr><td colspan="6" class="text-center">Data not Found</td></tr>');
        }
        else{
            $("#table").empty().append('<tr><td colspan="6" class="text-center">Data not Found</td></tr>');
        }
    });
</script>
@endsection

                                    