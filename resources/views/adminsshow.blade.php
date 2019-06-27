@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif
<!-- some CSS styling changes and overrides -->
<style>
.kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
}
.kv-avatar {
    display: inline-block;
}
.kv-avatar .file-input {
    display: table-cell;
    width: 213px;
}
.kv-reqd {
    color: red;
    font-family: monospace;
    font-weight: normal;
}
</style>

    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">{{$user->fname}} {{$user->lname}} Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
            <div class="row">
              <div class="col-md-4 text-center">
                  <div class="kv-avatar">
                          <img src="{{ asset('img/staff/'.$user->avatar) }}" width="90%">
                  </div>
              </div> 
              <div class="col-md-8">
              <table class="table table-striped">
                <tr>
                    <td><b>First Name</b></td>
                    <td>{{$user->fname}}</td>
                </tr>
                <tr>
                    <td><b>Last Name</b></td>
                    <td>{{$user->lname}}</td>
                </tr>
                <tr>
                    <td><b>Email</b></td>
                    <td>{{$user->email}}</td>
                </tr>
                <tr>
                    <td><b>Phone Number</b></td>
                    <td>{{$user->phonenumber}}</td>
                </tr>
                <tr>
                    <td><b>Created At</b></td>
                    <td>{{$user->created_at->format('d-m-Y')}}</td>
                </tr>
                <tr>
                    <td><b>Updated At</b></td>
                    <td>{{$user->updated_at->format('d-m-Y')}}</td>
                </tr>
                <tr>
                    <td><b>User Role</b></td>
                    <td>{{$user['role']['role_title']}}</td>
                </tr>
                <tr>
                    <td><b>Status</b></td>
                    <td>
                        @if ($user->status === 1)
                          <span class="text-green"><b>Active</b></span>
                        @else
                            <span class="text-red"><b>Deactive</b></span>
                        @endif
                    </td>
                </tr>
                
              </table>
                  

              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/admins'); !!}" class="btn btn-default">Back</a>
              </div>
              <!-- /.box-footer -->

</div>
<!-- Attendance Logs begins -->
<div class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">Attendance</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body" style="">
            @if(count($attlog) > 0)
                <table id="attlogs" class="display responsive wrap" style="width:100%;">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Paid</th>
                    <th>Check-Out Marked</th>
                    <th>Tardies</th>
                    <th>Short Leave</th>
                    <th>Hours Worked</th>
                    <th>Remarks</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($attlog as $att)
                    <?php
                        if($att->dayname=='Sun'){
                            $class="bg-green";
                        }elseif($att->status=='Holiday'){
                            $class="bg-green";
                        }elseif($att->status=='Absent'){
                            $class="bg-red";
                        }else{
                            $class="";
                        }
                    ?>
                    <tr class="{{$class}}">
                    <td>{{$att->dated->format('d-m-Y')}}</td>
                    <td>{{$att->dayname}}</td>
                    <td>{{$att->checkin}}</td>
                    <td>{{$att->checkout}}</td>
                    <td>{{$att->paid}}</td>
                    <td>{{$att->checkoutfound}}</td>
                    <td>{{$att->tardies}}</td>
                    <td>{{$att->shortleaves}}</td>
                    <td>{{$att->workedhours}}</td>
                    <td>{{$att->remarks}}</td>
                    <td>{{$att->status}}</td>
                    <td>
                        <a href="javascript:void(0)" data-id="{{$att->id}}" class="btn btn-default"><li class="fa fa-edit"></li></a>
                    </td>
                    </tr>
                    @endforeach			  
                </tbody>
                <tfoot>
                </tfoot>
                </table>
                @else
                <div>No Record found.</div>
                @endif

    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix" style="">
    </div>
    <!-- /.box-footer -->
</div>
<!-- Attendance Logs ends -->

<!-- Login Logs begins -->
<div class="box box-danger">
	<div class="box-header with-border">
		<h3 class="box-title">Login Logs</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body" style="">
            @if(count($loginlogs) > 0)
              <table id="loginlogs" class="display responsive wrap" style="width:100%;">
                <thead>
                <tr>
                  <th>Login Date</th>
                  <th>IP</th>
                  <th>Device Info</th>
                </tr>
                </thead>
                <tbody>
                @foreach($loginlogs as $loginlog)
                  <tr>
					<td>{{$loginlog->login_at !="" ? $loginlog->login_at->format('d-M-Y h:i:s') : "NA"}}</td>
                    <td>{{$loginlog->ip_address}}</td>
                    <td>{{$loginlog->user_agent}}</td>
                  </tr>
                  @endforeach			  
                </tbody>
                <tfoot>
                </tfoot>
              </table>
              @else
              <div>No Record found.</div>
              @endif

	</div>
	<!-- /.box-body -->
	<div class="box-footer clearfix" style="">
	</div>
	<!-- /.box-footer -->
</div>
<!-- Login Logs ends -->

@endsection

@push('scripts')
<script>
$(document).ready(function (e) {
  InitTable();
 $(".loading").fadeOut();
 
 //Add Department Begins
  $("#frmAddHoliday").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{url('/settings/holidays/')}}",
         type: "POST",
         data:  new FormData(this),
         contentType: false,
         cache: false,
         processData:false,
          beforeSend : function()
          {
            $(".loading").fadeIn();
          },
          statusCode: {
            403: function() {
              $(".loading").fadeOut();                
              swal("Failed", "Permission deneid for this action." , "error");
              return false;
            }
          },
          success: function(data)
            {
                if(data.errors)
                {
                  $(".loading").fadeOut();                
                  swal("Failed", "Unable to Create new holiday, " + data.errors.dated , "error");
                }
                else
                {
                  $('#modal-default').modal('toggle');
                  $("#frmAddHoliday")[0].reset(); 
                  swal("Success", "New holiday created successfully.", "success");
                  InitTable();
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to create new holiday, Please try again later.", "error");
              }          
       });
    }));
  //Add Department Ends
  //Edit Department Form Begins
    $(document).on('click', '.edit', function()
    {
      var id = $(this).attr('data-id');
      $.ajax({
        "url": "{{route('holiday.edit')}}",
        type: "POST",
        data: {'id': id,_token: '{{csrf_token()}}'},
        dataType : "json",
        beforeSend : function()
        {
          $(".loading").fadeIn();
        },
        statusCode: {
            403: function() {
              $(".loading").fadeOut();                
              swal("Failed", "Permission deneid for this action." , "error");
              return false;
            }
          },
        success: function(data)
        {
          $(".loading").fadeOut();
          //Populating Form Data to Edit Begins
          $('#modal-default-edit').modal('toggle');
          $('#editid').val(data.id);
          $('#editdated').val(data.dated);
          $('#editdescription').val(data.description);
          //Populating Form Data to Edit Ends
        },
          error: function(){},          
      });
    });
  //Edit Department Form Ends
  //Update Department Begins
  $("#frmEditHoliday").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{route('holiday.update')}}",
         type: "POST",
         data:  new FormData(this),
         contentType: false,
         cache: false,
         processData:false,
          beforeSend : function()
          {
            $(".loading").fadeIn();
          },
          statusCode: {
            403: function() {
              $(".loading").fadeOut();                
              swal("Failed", "Permission deneid for this action." , "error");
              return false;
            }
          },
          success: function(data)
            {
              
                if(data.errors)
                {
                  console.log(data.errors);
                  $(".loading").fadeOut();
                  swal("Failed", "Unable to update holiday, " + data.errors.dated , "error");
                }
                else
                {
                  $('#modal-default-edit').modal('toggle');
                  $("#frmEditHoliday")[0].reset(); 
                  swal("Success", "Holiday updated successfully.", "success");
                  InitTable();
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to Create new holiday, Please try again later.", "error");
              }          
       });
    }));
    //Update Department Ends

    //Delete Department Begins
    $(document).on('click', '.delete', function(e)
    {
      swal({
        title: "Are you sure to delete?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          var id = $(this).attr('data-id');  
          var token= '{{csrf_token()}}';
              e.preventDefault();
              
              var request_method = $("#form"+id).attr("method"); 
              var form_data = $("#form"+id).serialize(); 
              
              $.ajax({
                url: "holiday/delete/"+id,
                type: request_method,
                dataType: "JSON",
                data: form_data,
                beforeSend : function()
                {
                  $(".loading").fadeIn();
                },
                statusCode: {
                  403: function() {
                    $(".loading").fadeOut();                
                    swal("Failed", "Permission deneid for this action." , "error");
                    return false;
                  }
                },
                success: function(data)
                {
                  $(".loading").fadeOut();
                  swal("Success", "Holiday delete successfully.", "success");
                  var table = $('#table_data').DataTable();
                  table
                  .row( $(this).parents('tr') )
                  .remove()
                  .draw();

                  $(".loading").fadeOut();
                },
                  error: function(){
                    $(".loading").fadeOut();
                    swal("Failed", "Unable to delete Holiday." , "error");
                  },          
              });
          
        } 
      });

    });
    //Delete Department Ends

  });
</script>
@endpush