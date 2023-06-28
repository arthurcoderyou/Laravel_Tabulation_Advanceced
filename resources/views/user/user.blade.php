@extends('layouts.main_layout')
@section('content')

    <div class="row">

        {{-- date table --}}

        <div class="col-sm-12">
            
        <div class="table-responsive mx-auto mt-2" style="width:95%;">
            <table class="table table-light no-wrap" id="table">
                <thead style="text-align:center;">

                    @if(session('success'))
                    <tr>
                        <td colspan="7">
                        <div class="alert alert-dismissible alert-success">{{ session('success') }}</div>
                        </td>
                    </tr>
                    @endif

                    @error('email')
                        <tr>
                        <td colspan="7">
                            <div class="alert alert-dismissible alert-danger">{{ $message }}</div>
                        </td>
                        </tr>
                    @enderror

                    <tr>
                        <th class="border-top-0" colspan="3">Contest Name</th>
                        
                        
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                {{-- --}}
                <tbody style=" justify-content:center; text-align:center;" >
                            
                        
                    @foreach ($contests as $contest)
                    <tr >
                        <td colspan="3">{{  $contest->contest_name }}</td>

                        
                        <td id="{{ $contest->id }}" colspan="2">
                        <a href="/contest/awards/{{ $contest->id }}" class="btn btn-outline-info  view_sub_cons {{ ($contest->show_contest_result) ? '': 'disabled'}}" >View Awards</a>
                        </td>
                        
                        
                    </tr>
                    
                    
                        
                    @endforeach
                

                </tbody>
                
            </table>
        </div>
        </div>

        <div class="text-bg-light mx-5" > 
        {{ $contests->links() }}
        </div>

    </div>


@endsection