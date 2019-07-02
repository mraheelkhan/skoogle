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
              <h3 class="box-title">Manage Organization</h3>
              @can('create-department')
              <span class="pull-right">
                {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modaldefault"><span class="fa fa-plus"></span> Add New Organization</button> --}}
                </span>
              @endcan
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="">
                    <form role="form" action="{{url('/settings/departments')}}" method="POST" id="frmAddDepartment">
                      @csrf
                      <div class="box-body">
                        <div class="form-group">
                          <label for="deptname">Organization Name</label>
                          <input type="text" class="form-control" id="deptname" name="deptname" placeholder="Enter Department Name" autocomplete="off">
                        </div>
                        <div class="form-group">
                          <label for="status">Select Status</label>
                          <select class="form-control" id="status" name="status">
                            <option value="1" selected>Active</option>
                            <option value="0">Deactive</option>
                          </select>
                        </div>
                      </div>
                      <!-- /.box-body -->
        
                      <div class="box-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <span class="pull-right"><button type="submit" class="btn btn-primary">Submit</button></span>
                      </div>
                    </form>
                  </div>
            </div>
            <div class="box-body">
              <table id="table_data" class="display responsive wrap" style="width:100%">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Organization Name</th>
                  <th>Created By</th>
                  <th>Created At</th>
                  <th>Modified By</th>
                  <th>Modified At</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               	  
                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Organization Name</th>
                  <th>Created By</th>
                  <th>Created At</th>
                  <th>Modified By</th>
                  <th>Modified At</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->   

      <!-- Add Modal Begins -->   
      <div class="modal fade" id="modaldefaultHide">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Add Organization</h4>
            </div>
            <div class="modal-body">
              <form role="form" action="{{url('/settings/departments')}}" method="POST" id="frmAddDepartment">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="deptname">Organization Name</label>
                    <input type="text" class="form-control" id="deptname" name="deptname" placeholder="Enter Department Name" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="status">Select Status</label>
                    <select class="form-control" id="status" name="status">
                      <option value="1" selected>Active</option>
                      <option value="0">Deactive</option>
                    </select>
                  </div>
                </div>
                <!-- /.box-body -->
  
                <div class="box-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <span class="pull-right"><button type="submit" class="btn btn-primary">Submit</button></span>
                </div>
              </form>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <!-- Add Modal Ends -->   

      <!-- Edit Modal Begins -->   
      <div class="modal fade" id="modal-default-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Department</h4>
              </div>
              <div class="modal-body">
                <form role="form" action="{{route('department.update')}}" method="POST" id="frmEditDepartment">
                  @csrf
                  <input name="_method" type="hidden" value="PATCH">
                  <input name="id" id="editid" type="hidden" value="0">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="deptname">Department Name</label>
                      <input type="text" class="form-control" id="editdeptname" name="deptname" placeholder="Enter Department Name" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label for="status">Select Status</label>
                      <select class="form-control" id="editstatus" name="status">
                        <option value="1" selected>Active</option>
                        <option value="0">Deactive</option>
                      </select>
                    </div>
                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <span class="pull-right"><button type="submit" class="btn btn-primary">Submit</button></span>
                  </div>
                </form>
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- Edit Modal Ends -->  
      <div class="loading">
        <div class="loader"></div>
      </div>
@endsection
@push('scripts')
<style>
.loading{
    display: hidden;
    position: fixed;
    left: 0;
    top: 0;
    padding-top: 45vh;
    padding-left:100vh;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background-color: gray;
    opacity: 0.8;
}
.loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

</style>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script>
//Fetch Data Begins
  function InitTable() {
    $(".loading").fadeIn();
        $('#table_data').DataTable({
        "bDestroy": true,
        "processing": true,
        "serverSide": true,
        "Paginate": true,
        "order": [[1, 'desc']],
        "pageLength": 25,
        "ajax":{
                  "url": "{{ route('departments.fetch') }}",
                  "dataType": "json",
                  "type": "POST",
                  "data":{ _token: "{{csrf_token()}}"}
                },
        "columns": [
            { "data": "id" },
            { "data": "deptname" },
            { "data": "user_id" },
            { "data": "created_at" },
            { "data": "last_modified_by" },
            { "data": "updated_at" },
            { "data": "status" },
            { "data": "options" ,"orderable":false},
        ]  

    });     
}
//Fetch Data Ends

$(document).ready(function (e) {
  InitTable();
 $(".loading").fadeOut();
 //Add Department Begins
  $("#frmAddDepartment").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{url('/settings/departments/')}}",
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
                  swal("Failed", "Unable to Create new department, " + data.errors.deptname , "error");
                }
                else
                {
                  $('#modaldefault').modal('toggle');
                  $("#frmAddDepartment")[0].reset(); 
                  swal("Success", "Department created successfully.", "success");
                  InitTable();
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to Create new department, Please try again later.", "error");
              }          
       });
    }));
  //Add Department Ends
  //Edit Department Form Begins
    $(document).on('click', '.edit', function()
    {
      var id = $(this).attr('data-id');
      $.ajax({
        "url": "{{route('department.edit')}}",
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
          $('#editdeptname').val(data.deptname);
          $('#editstatus').val(data.status);
          //Populating Form Data to Edit Ends
        },
          error: function(){},          
      });
    });
  //Edit Department Form Ends
  //Update Department Begins
  $("#frmEditDepartment").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{route('department.update')}}",
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
                  swal("Failed", "Unable to update department, " + data.errors.deptname , "error");
                }
                else
                {
                  $('#modal-default-edit').modal('toggle');
                  $("#frmEditDepartment")[0].reset(); 
                  swal("Success", "Department updated successfully.", "success");
                  InitTable();
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to Create new department, Please try again later.", "error");
              }          
       });
    }));
    //Update Department Ends

    //Change Department Status Begins
    $(document).on('click', '.status', function()
    {
      swal({
        title: "Are you sure want to change the status?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          var id = $(this).attr('data-id');
          var action = $(this).attr('data-action');
          if(action==0){
              url="{{url('/settings/department/deactivate/')}}";
          }else{
              url="{{url('/settings/department/active/')}}";
          }
          $.ajax({
            "url":url,
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
              swal("Success", "Department status updated successfully.", "success");
              InitTable();
              $(".loading").fadeOut();
              //Populating Form Data to Edit Ends
            },
              error: function(){
                $(".loading").fadeOut();
                swal("Failed", "Unable to update department status." , "error");
              },          
          });
        } 
      });

    });
    //Change Department Status Ends

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
                url: "department/delete/"+id,
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
                  swal("Success", "Department delete successfully.", "success");
                  var table = $('#table_data').DataTable();
                  table
                  .row( $(this).parents('tr') )
                  .remove()
                  .draw();

                  $(".loading").fadeOut();
                },
                  error: function(){
                    $(".loading").fadeOut();
                    swal("Failed", "Unable to delete department." , "error");
                  },          
              });
          
        } 
      });

    });
    //Delete Department Ends

  });
  

</script>
@endpush