@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Anggota</h2>
                
                <div class="row mt-5">
                    <div class="col-12">
                        <form action="tambahanggota" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="userId" class="col-3">Nama Depan</label>
                                <div class="col-1">:</div>
                                <input type="text" class="form-control col-7" placeholder="Masukan Nama Depan" name="first_name" required>
                            </div>
                            <div class="form-group row">
                                <label for="userId" class="col-3">Nama Belakang</label>
                                <div class="col-1">:</div>
                                <input type="text" class="form-control col-7" placeholder="Masukan Nama Belakang" name="last_name" required>
                            </div>
                            <div class="form-group row">
                                <label for="nomor" class="col-3">No Handphone</label>
                                <div class="col-1">:</div>
                                <input type="number" class="form-control col-7" id="nomor" placeholder="Masukan No Hp" name="phone" required>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-3">Email</label>
                                <div class="col-1">:</div>
                                <input type="email" class="form-control col-7" id="email" placeholder="Masukan Email" name="email" required>
                            </div>
                            <div class="form-group row">
                                <label for="group_id" class="col-3">Group</label>
                                <div class="col-1">:</div>
								<select class="form-control col-2" id="group_id" name="group_id" required>
                                    <option value="">Please Pick One</option>
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->group_name}}</option>    
                                    @endforeach
                                </select>
							</div>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-success">Tambah Anggota</button>
							</div>
                        </form>
                    </div>
                </div>
				
                <div class="row mt-5 mr-1 justify-content-end">
                    <select id='filterText' style='display:inline-block' onchange='filterText()' class="btn btn-primary">
                        <option disabled selected>Filter List</option>
                        <option value='all'>All</option>
                        @foreach($groups as $group)
                            <option class="dropdown-item" value='{{$group->group_name}}'>{{$group->group_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col" width="5%">No</th>
                                    <th scope="col" width="20%">Nama</th>
                                    <th scope="col" width="20%">Nomor HP</th>
                                    <th scope="col" width="20%">Email</th>
                                    <th scope="col" width="20%">Total Lulus Ujian</th>
                                    <th scope="col" width="10%">Group</th>
                                    <th scope="col" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($users)>0)
                                    @php($num = 1)
                                    @foreach($users as $user)
                                        <tr class="content">
                                            <td scope="row" class="font-weight-bold text-center">{{$num}}</td>
                                            <td>{{$user->first_name}}&nbsp;{{$user->last_name}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->email}}</td>
                                            <td class="text-center">0</td><!--masi belom ada relasi-->
                                            <td class="text-center">{{$user->groupid}}</td>
                                            <td style="display: flex; justify-content: space-around;">
                                                <form>
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-pill btnSubmit py-2 px-3">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php($num++)
                                    @endforeach
                                @else
                                    <tr class="content">
                                        <td colspan="7" class="text-center">Records Not Found</td>
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