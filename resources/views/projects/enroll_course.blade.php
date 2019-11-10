@extends('layouts.home')
@section('content')
<section class="blog_tow_area">
    <div class="container">
            @if(Session::has('message'))
            <p class="alert alert-success">{!! Session::get('message') !!}</p>    
        @elseif(Session::has('error'))
            <p class="alert alert-danger">{!! Session::get('error') !!}</p>
        @endif
        @if(session('failed'))
            <script>
              $( document ).ready(function() {
                swal.fire("Failed", "{!! Session::get('error') !!}", "error");
              });
              
            </script>
        @endif
        <div class="row blog_tow_row">
                {{-- <h3> Already Enrolled </h3> --}}
                <p>
                     <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                       Show Already Enrolled 
                     </a>
                   </p>
                   <div class="collapse" id="collapseExample">
                     <div class="card card-body">
                       
                            <table class="table text-center">
                                    <thead>
                                        <th>No</th>
                                        <th class="text-center">Name</th>
                                        <th  class="text-center">Email</th>
                                        <th class="text-center">Action</th>
                                    </thead>
                                    <tbody>
                                        @php $index = 1; @endphp
                                        @foreach($enrolledUsers as $enrolledUser)
                                        <tr>
                                           <td>{{ $index++ }}</td>
                                           <td>{{ $enrolledUser->user->fname . " " . $enrolledUser->user->lname }}</td>
                                           <td>{{ $enrolledUser->user->email }}</td>
                                           <td> 
                                                <a  href="{{route('CourseUserEnrollDelete', $enrolledUser->id)}}" class="btn btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                           </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                           <th>No</th>
                                           <th class="text-center">Name</th>
                                           <th class="text-center">Email</th>
                                           <th class="text-center">Action</th>
                                    </tfoot>
                                </table>
                    </div>
                   </div>
        </div>
        <hr>
       <div class="row blog_tow_row">
           <div class="video text-center">
              
             <h2 class="mb-5">All User Lists</h2>

             <table class="table text-center">
                 <thead>
                     <th>No</th>
                     <th class="text-center">Name</th>
                     <th  class="text-center">Email</th>
                     <th class="text-center">Action</th>
                 </thead>
                 <tbody>
                     @php $index = 1; @endphp
                     @foreach($users as $user)
                     <tr>
                        <td>{{ $index++ }}</td>
                        <td>{{ $user->fname . " " . $user->lname }}</td>
                        <td>{{ $user->email }}</td>
                        <td> 
                            <a  href="{{route('CourseUserEnroll', [$user->id, $course->id])}}" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                            </a>
                        </td>
                     </tr>
                     @endforeach
                 </tbody>
                 <tfoot>
                        <th>No</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Action</th>
                 </tfoot>
             </table>
           
        </div>
       </div>
    </div>
</section>
<script>
    function enrollUser(){

    }
</script>
@endsection