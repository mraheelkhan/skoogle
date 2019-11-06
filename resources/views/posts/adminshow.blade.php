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
            <h3 class="box-title">Title:  {{ $post->post_title }} </h3>
              <span class="pull-right">
                
                
              </span>
            </div>
            <!-- /.box-header -->
             <div class="box-body">
              
                    <div class="alert alert-danger alert-styled-left" style="display: none;" id="delete">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="delete"></p>
                    </div>
                    <p> {!!$post->post_content!!} </p>
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
          
          @foreach($postcomments  as $postcomment) 
            <li>
                  
              <i class="fa fa-comments bg-yellow"></i>
            
              <div class="timeline-item" style="background: {{($postcomment->isSolution == 1) ? '#b2ffb1;' : '#fff' }}">
                <span class="time"><i class="fa fa-clock-o"></i> {{ $postcomment->created_at}}</span>

                <h3 class="timeline-header" style="background: {{($postcomment->is_deleted == 1) ? '#fd9a9a;' : '#fff' }}"><a href="#">{{$postcomment->user->fname}} {{$postcomment->user->lname }}</a> - posted a comment </h3>

                <div class="timeline-body">
                  {{ $postcomment->comment_body }}
                </div>
                @if($postcomment->is_deleted == 0)
                <div class="timeline-footer">
                    <button class="btn btn-danger btn-xs" onclick="markAsDeleted({{$postcomment->id}})">Delete</button>
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
        routeURL = "{{ route('post.admincommentdelete') }}";
        $.ajax({
            url: routeURL,
            method: 'POST',
            data: {
                "comment_id" : id,
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
