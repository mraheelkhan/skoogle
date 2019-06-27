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
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Projects</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($projects) > 0)
              <table id="example1" class="display responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>Project No.</th>
                  <th>Project Name</th>
                  <th>Customer Name</th>
                  <th>Created By</th>
                  <th>Status</th>
				          <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($projects as $project)
                  <tr>
                    <td><a href="{!! url('/projects/'.$project['id'] ); !!}">{{$project['id']}}</a></td>
                    <td>{{$project['projectName']}}</td>
                    <td>{{$project->customer->fname }} {{ $project->customer->lname }}</td>
                    <td>{{$project->createdby->fname }} {{ $project->createdby->lname }}</td>
                    <td>
                      @if ($project['status'] === 1)
                      <span class="btn btn-success">Open</span>
                      @else
                      <span class="btn btn-danger">Closed</span>
                      @endif
                    </td>
                     <!-- For Delete Form begin -->
                    <form id="form{{$project['id']}}" action="{{action('ProjectController@destroy', $project['id'])}}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                    </form>
                    <!-- For Delete Form Ends -->
                    <td>
                      <a href="{!! url('/projects/'.$project['id'] ); !!}" class="btn btn-primary" title="View Detail"><i class="fa fa-eye"></i> </a>    
                      <a href="{!! url('/projects/'.$project['id'].'/edit'); !!}"  class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>                     
                    </td>
                  </tr>
                  @endforeach			  
                </tbody>
                <tfoot>
                <tr>
                  <th>Project No.</th>
                  <th>Project Name</th>
                  <th>Customer Name</th>
                  <th>Created By</th>
                  <th>Status</th>				  
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
              @else
              <div>No Record found.</div>
              @endif
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->   

@endsection