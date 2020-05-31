@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Group</h2>
                
                <div class="row mt-5">
                    <div class="col-12">
                        <form action="/admin/group" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="judul" class="col-3 inputRequired">Group Name*</label>
                                <div class="col-1">:</div>
                                <input type="text" class="form-control col-7 @error('group_name') is-invalid @enderror" id="judul" placeholder="Enter Group Name" name="group_name" required  value="{{old('group_name')}}">
                                @error('group_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="judul" class="col-3 inputRequired">Group Start Date*</label>
                                <div class="col-1">:</div>
                                <input type="text" class="form-control col-7" id="datepicker" placeholder="Enter Date (Y-m-d)" name="group_strt_dt" required  value="{{old('group_strt_dt')}}">
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-success">Add Grup</button>
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
                                    <th scope="col" width="55%">Group Name</th>
                                    <th scope="col" width="20%">Starting Date</th>
                                    <th scope="col" width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($groups)>0)
                                    @php($num=1)
                                    @foreach($groups as $group)
                                        <tr>
                                            <td scope="col" width="5%" class="text-center">{{$num}}</td>
                                            <td scope="col" width="50%">{{$group->group_name}}</td>
                                            <td scope="col" width="25%">{{$group->group_strt_dt}}</td>
                                            <td style="display: flex; justify-content: space-around;">
                                                <form action="/admin/exportGroupData" method="POST">
                                                    @csrf
                                                    <input value="{{$group->id}}" name="id" style="display:none">
                                                    <button type="submit" class="btn btn-outline-success btn-sm btn-pill btnSubmit py-2 px-3">Detail</button>
                                                </form>
                                                <form>
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-pill btnSubmit py-2 px-3">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php($num++)
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">Data not Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                    <div class="row justify-content-center">
                        <div class="col-8">
                            <canvas id="myChart"></canvas>
                        </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="/assets/js/chartjs.min.js"></script>
    <script>
        const items = @json($groups);
        var names = items.map(function(item) {
            return item['group_name'];
        });
        var countgroupmember = items.map(function(item) {
            return item['userMemberCount'];
        });
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: names,
                datasets: [
                    {
                        label: 'total group members',
                        data: countgroupmember,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)'
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection