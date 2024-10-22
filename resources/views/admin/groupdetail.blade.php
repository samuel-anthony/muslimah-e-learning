<?php
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=".$group->group_name.".xls");
?>

            <h2>Grup</h2>
                <div class="row mt-5">
                    <div class="col-12">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col" width="5%">No</th>
                                    <th scope="col" width="20%">Name</th>
                                    <th scope="col" width="20%">Phone Number</th>
                                    <th scope="col" width="20%">Email</th>
                                    <th scope="col" width="20%">Passed Exam</th>
                                    <th scope="col" width="10%">Group</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($users)>0)
                                    @php($num=1)
                                    @foreach($users as $user)
                                        <tr class="content">
                                            <td scope="row" class="text-center">{{$num}}</td>
                                            <td>{{$user->first_name}}&nbsp;{{$user->last_name}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->email}}</td>
                                            <td class="text-center">{{$user->totalPassed}}</td>
                                            <td class="text-center">{{$user->group->group_name}}</td>
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
            </div>
        </div>
    </div>
