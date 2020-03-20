@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Group</h2>
                
                <div class="row mt-5">
                    <div class="col-8">
                        <form action="/admin/group" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="judul">Nama Group</label>
                                <input type="text" class="form-control" id="judul" placeholder="Enter Nama Group" name="group_name" required>
                            </div>
                            <div class="form-group">
                                <label for="judul">Group Mulai</label>
                                <input type="text" class="form-control" id="datepicker" placeholder="Enter Hari Mulai Group (Y-m-d)" name="group_strt_dt" required>
                            </div>
                            <button type="submit" class="btn btn-success">Submit Group Baru</button>
                        </form>
                    </div>
                </div>
		
                <div class="row mt-3">
                    <div class="col-12">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">No</th>
                                    <th scope="col" width="55%">Nama Group</th>
                                    <th scope="col" width="20%">Hari Group Mulai</th>
                                    <th scope="col" width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($groups)>0)
                                    @php($num=1)
                                    @foreach($groups as $group)
                                        <tr>
                                            <td scope="col" width="5%">{{$num}}</td>
                                            <td scope="col" width="55%">{{$group->group_name}}</td>
                                            <td scope="col" width="20%">{{$group->group_strt_dt}}</td>
                                            <td style="display: flex; justify-content: space-around;">
                                                <form>
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-pill btnSubmit py-2 px-3">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php($num++)
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">Records Not Found</td>
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