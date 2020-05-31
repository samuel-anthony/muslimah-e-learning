@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-10 bg-light rounded py-4 px-5">
                <h2>Members</h2>
                
                <div class="row mt-5">
                    <div class="col-12">
                        <form action="tambahanggota" method="post">
                            @csrf 
                            <div class="form-group row">
                                <label for="userId" class="col-3 inputRequired">First Name*</label>
                                <div class="col-1">:</div>
                                <input type="text" class="form-control col-7" placeholder="Enter First Name" name="first_name" required value="{{old('first_name')}}">
                            </div>
                            <div class="form-group row">
                                <label for="userId" class="col-3 inputRequired">Last Name*</label>
                                <div class="col-1">:</div>
                                <input type="text" class="form-control col-7" placeholder="Enter Last Name" name="last_name" required value="{{old('last_name')}}">
                            </div>
                            <div class="form-group row">
                                <label for="nomor" class="col-3 inputRequired">Phone Number*</label>
                                <div class="col-1">:</div>
                                <input type="number" class="form-control col-7 @error('phone') is-invalid @enderror" id="nomor" placeholder="Enter Phone Number" name="phone" required value="{{old('phone')}}">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-3 inputRequired">Email*</label>
                                <div class="col-1">:</div>
                                <input type="email" class="form-control col-7 @error('email') is-invalid @enderror" id="email" placeholder="Enter Email" name="email" required value="{{old('email')}}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="group_id" class="col-3 inputRequired">Group*</label>
                                <div class="col-1">:</div>
								<select class="form-control col-3" id="group_id" name="group_id" required>
                                    <option value="">Choose Group</option>
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}" @if($group->id == old('group_id'))selected @endif>{{$group->group_name}}</option>    
                                    @endforeach
                                </select>
							</div>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-success">Add Member</button>
							</div>
                        </form>
                    </div>
                </div>
				
                <div class="row mt-5 mr-1 col-12 justify-content-between">
                    <div>
                        <input id="searchBox" placeholder="Enter Name">
                        <button class="btn btn-success" id="searchButton">Search</button>
                    </div>         
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
                                    <th scope="col" width="20%">Name</th>
                                    <th scope="col" width="20%">Telephone number</th>
                                    <th scope="col" width="20%">Email</th>
                                    <th scope="col" width="20%">Passed Exam</th>
                                    <th scope="col" width="10%">Group</th>
                                    <th scope="col" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($users)>0)
                                    @foreach($users as $user)
                                        <tr class="content">
                                            <td>{{$user->first_name}}&nbsp;{{$user->last_name}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->email}}</td>
                                            <td class="text-center">0</td><!--masi belom ada relasi-->
                                            <td class="text-center">{{$user->group->group_name}}</td>
                                            <td style="display: flex; justify-content: space-around;">
                                                <form action="deleteAnggota" method="post">@csrf<input name="id" value="{{$user->id}}" style="display:none">
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-pill btnSubmit py-2 px-3">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="content">
                                        <td colspan="7" class="text-center">Data not Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
<script src="/assets/js/jquery-3.4.1.slim.min.js"></script>
<script>
    const users = @json($users);
    $("#searchButton").click(function (){
        const value = $("#searchBox").val();
        const res = value.split(" ");
        let newVal = ".*";
        res.forEach((data)=>{
            newVal = newVal + data + ".*"
        });
        var rex = new RegExp(newVal);
        $('.content').hide();
        $('.content').filter(function() {
            return rex.test($(this).text());
        }).show();
        
    });
</script>
@endsection