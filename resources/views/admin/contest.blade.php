@extends('layouts.admin_layout')
@section('content')

  @auth
    @if(auth()->user()->role == 'admin')
        <div class="row">
            @if(session('success'))
                <div class="w-75 my-4 mx-auto">
                    <div class="alert alert-dismissible alert-success">{{ session('success') }}</div>
                </div>
            @endif
            <div class="w-75 my-4 mx-auto">
                
                <form class="" action="/admin/contest" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-8 mr-0 pr-0">
                            <input type="text" placeholder="Search..." class="form-control mt-0" name="search">
                            
                        </div>
                        <div class="col-sm-4 ml-0 pl-0">
                            <button class="btn btn-primary btn-sm mt-1 w-100" type="submit">
                                Submit
                            </button>
                        
                        </div>
                    </div>
                    
                </form>
            </div>
            
            {{-- date table --}}

            <div class="col-sm-8">
                 
                <div class="table-responsive mx-auto mt-2" style="width:95%;">
                    <table class="table table-light no-wrap" id="table">
                        <thead style="text-align:center;">
                            <tr>
                                <th class="border-top-0">Contest Name</th>
                                <th class="border-top-0">Announcement Date</th>
                                <th class="border-top-0">Show Contest Result</th>
                                    
                                
                                <th colspan="2">Actions</th>
                            </tr>
                        </thead>
                        

                        @empty($contests)
                            <tbody style=" justify-content:center; text-align:center;" >
                                <tr>
                                    <td colspan="6">No results found for " {{ $search }} "</td>
                                </tr>
                            </tbody>
                        @else
                            <tbody style=" justify-content:center; text-align:center;" >
                                
                            
                                @foreach ($contests as $contest)
                                    <tr >
                                        <td >{{ $contest->contest_name }}</td>
                                        <td >{{ $contest->announcement_date }}</td>
                                        <td >
                                            @if($contest->show_contest_result == true) 
                                                Show
                                            @else
                                                Hide
                                            @endif
                                        </td>

                                        <td id="{{ $contest->id }}">
                                            <button class="btn btn-info text-light update_btn" onclick="hello()">Update</button>
                                        </td>
                                        <td>
                                            <form action="/admin/contest/delete/{{ $contest->id }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger text-light" id="{{ $contest->id }}">Delete</button>
                                            </form>
                                            
                                        </td>
                                        {{-- 
                                        <td>
                                            <a type="submit" class="btn btn-primary text-light" href="/admin/contest/read/{{ $contest->id }}">View</a>
                                        </td>
                                         --}}
                                    </tr>
                                    <tr id="update_form_{{ $contest->id }}" class="update_form">
                                        <td colspan="6">
                                            <form  action="/admin/contest/update/{{ $contest->id }}" method="post" class="form bg-info mx-auto bg-primary p-2 text-light text-start w-75" style="width:95%; border-radius:10px">
                                                @csrf
                                                <legend>Update Contest</legend>
                            
                                                @error('contest_name')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                            
                                                @error('announcement_date')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                            
                                                @error('show_con_res')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                            
                                                @if(session()->has('success'))
                                                    <script>
                                                        alert({{ session('success') }});
                                                    </script>
                                                @endif
                            
                                                <p class="form-control-label mb-1">Contest Name:</p>
                                                <input value="{{ $contest->contest_name }}" name="contest_name" class="form-control" type="text" required>
                            
                                                <label for="announcement_date" class="form-control-label">Announcement Date:</label>
                                                <input value="{{ $contest->announcement_date }}" name="announcement_date" class="form-control" type="date" required>
                            
                                                <label for="show_con_res" class="form-control-label">Show Contest Result</label>
                                                <select value="{{ $contest->show_contest_result }}" class="form-select" name="show_con_res" id="show_con_res" required>
                                                    <option value="">Select</option>
                                                    <option value="1">Show</option>
                                                    <option value="0">Hide</option>
                                                </select>
                            
                                                <button type="submit" class="btn btn-light mt-3 text-center">Update</button>
                                                <button type="button" class="btn btn-dark ml-auto mt-3 text-center hide_btn">Hide</button>
                                            </form>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            
            
                            </tbody>

                        @endempty

                        {{-- 
                        <tfoot class="text-center">
                            <tr>
                                <td colspan="6">
                                    <button class="btn btn-dark " id="add">Add New Contest</button>
                                </td>
                            </tr>
                        </tfoot>
                         --}}
                    </table>
                </div>
                

               

            </div>

           
    
            {{-- update table --}}

            <div class="col-sm-4 text-bg-light my-2 " style=" text-align:center" >
                <form id="add_form" action="{{ route('admin.contest.create') }}" method="post" class="form mx-auto bg-light p-2 text-start " style="width:95%; border-radius:10px">
                    @csrf
                    <legend>Create new Contest</legend>

                    @error('contest_name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror

                    @error('announcement_date')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror

                    @error('show_con_res')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror

                    @if(session()->has('success'))
                        <script>
                            alert({{ session('success') }});
                        </script>
                    @endif

                    <label for="" class="form-control-label">Contest Name:</label>
                    <input name="contest_name" class="form-control" type="text" required>

                    <label for="" class="form-control-label">Announcement Date:</label>
                    <input name="announcement_date" class="form-control" type="date" required>

                    <label for="" class="form-control-label">Show Contest Result</label>
                    <select class="form-select" name="show_con_res" id="show_con_res" required>
                        <option value="">Select</option>
                        <option value="1">Show</option>
                        <option value="0">Hide</option>
                    </select>

                    <button type="submit" class="btn btn-dark mt-3 text-center">Create</button>
                </form>

                


            </div>

            <div class="text-bg-light mx-5" > 
                {{ $contests->links() }}
            </div>
        </div>
       
       
    @endif
  @endauth

   
@endsection

