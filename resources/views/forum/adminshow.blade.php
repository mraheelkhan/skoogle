@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif
@if(session('failed'))
    <script>
      $( document ).ready(function() {
        swal("Failed", "{{session('failed')}}", "error");
      });
      
    </script>
@endif



<!-- Table start -->
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            <h3 class="box-title">Question:  {{ $question->question_title }} </h3>
              <span class="pull-right">
                
                
              </span>
            </div>
            <!-- /.box-header -->
             <div class="box-body">
              
                    <div class="alert alert-danger alert-styled-left" style="display: none;" id="delete">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="delete"></p>
                    </div>
                    <p> {{ $question->question_body }} </p>
                    <div class="alert alert-success alert-styled-left" style="display: none;" id="success">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="success"></p>
                    </div> 

             
            </div>
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        
</div>

<div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
          
          @foreach($answers as $answer) 
            <li>
                  
              <i class="fa fa-comments bg-yellow"></i>
            
              <div class="timeline-item" style="background: {{($answer->isSolution == 1) ? '#b2ffb1;' : '#fff' }}">
                <span class="time"><i class="fa fa-clock-o"></i> {{ $answer->created_at}}</span>

                <h3 class="timeline-header" style="background: {{($answer->is_deleted == 1) ? '#fd9a9a;' : '#fff' }}"><a href="#">{{$answer->user->fname}} {{$answer->user->lname }}</a> answer on question</h3>

                <div class="timeline-body">
                  {{ $answer->answer_body }}
                </div>
                @if($answer->is_deleted == 0)
                <div class="timeline-footer">
                    <button class="btn btn-danger btn-xs" onclick="markAsDeleted({{$answer->id}})">Delete</button>
                </div>
                @endif
               
              </div>
          
            </li>
           @endforeach
          </ul>
        </div>
        <!-- /.col -->
      </div>
<!-- Table end -->
<script>
    function markAsDeleted(id){
        routeURL = "{{ route('forum.admindelete') }}";
        $.ajax({
            url: routeURL,
            method: 'POST',
            data: {
                "answer_id" : id,
                "_token" : "{{csrf_token()}}"
            },
            success: function(data){
                console.log(data);
                if(data.success == 1){
                    swal('deleted', 'Marked as Deleted', "success");
                    location.reload();
                } else {
                    swal('Already Solved', 'You cannot mark 2 answer as solution', "error");
                }
                
            },
            error: function(error){
                console.log(error);
            }
        });
    }
</script>

@endsection
