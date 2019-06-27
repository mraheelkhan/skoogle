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
              
              <span class="pull-right">
                    @can('create-project')<a href="{!! url('projects/create/'.$user->id.''); !!}" class="btn btn-danger"><li class="fa fa-plus"></li> Project</a>@endcan
                    @can('create-lead')<a href="{!! url('leads/create/'); !!}" class="btn btn-warning"><li class="fa fa-plus"></li> Lead</a>@endcan
              </span>
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
                <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
              </div>
              <!-- /.box-footer -->

</div>




<div class="row">
<!-- Address book, Email 	START -->
<div class="col-md-6">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Customer Email</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
        
                    <table class="table table-bordered" id="TblProjectLinks">
                        <tbody><tr>
                          <th>Email</th>
                          <th>Action</th>
                        </tr>
                        <tr>
                            <td><input type="email" name="txtemail" id="txtemail" placeholder="Enter Email" class="form-control"></td>
                            <td><button class="btn btn-success" id="btnAddLink"><li class="fa fa-plus"></li></button><span id="IDlinkadding"></span></td>
                        </tr>	
                        @if(count($addressbooks) > 0)
                        @foreach($addressbooks as $addressbook)
                            <tr id="MyLinks_{{$addressbook->id}}">
                              <td>{{$addressbook->email}}</td>
                              <td><button class="btn btn-danger" id="btnDeleteLink" data-notif-id="MyLinks" data-id="{{$addressbook->id}}"><li class="fa fa-trash"></li></button></td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                    
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix" style="">
                    <div class="pull-right">
                    </div>
                </div>
                <!-- /.box-footer -->
        </div>
        </div>
        <!-- Address book, Email 	END  -->
        
        
        <!-- Address book, Phone 	START -->
        <div class="col-md-6">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Customer Phone</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
        
                    <table class="table table-bordered" id="TblProjectLinksPhone">
                        <tbody><tr>
                          <th>Phone</th>
                          <th>Action</th>
                        </tr>
                        <tr>
                            <td><input type="text" name="txtphone" id="txtphone" placeholder="Enter Phone" class="form-control"></td>
                            <td><button class="btn btn-success" id="btnAddLinkPhone"><li class="fa fa-plus"></li></button><span id="IDlinkadding"></span></td>
                        </tr>	
                        @if(count($addressbooksphone) > 0)
                        @foreach($addressbooksphone as $addressbookphone)
                            <tr id="MyLinks_{{$addressbookphone->id}}">
                              <td>{{$addressbookphone->phone}}</td>
                              <td><button class="btn btn-danger" id="btnDeleteLink" data-notif-id="MyLinks" data-id="{{$addressbookphone->id}}"><li class="fa fa-trash"></li></button></td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                    
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix" style="">
                    <div class="pull-right">
                    </div>
                </div>
                <!-- /.box-footer -->
        </div>
        </div>
        <!-- Address book, Phone END  -->
</div>
        
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



        <script>
        //Add Address book Begins //EMAIL
        $('#btnAddLink').click(function () {
        
        var txtEmail   = $("#txtemail").val();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
           url: "/addressbook",
           type: "POST",
           data:  {'email': txtEmail, 'user_id': {{$user->id}}},
           beforeSend : function()
           {
            //$("#preview").fadeOut();
            //$("#err").fadeOut();
           },
           success: function(data)
           {
                    
                if(data.errors)
                {
                    
                    swal("Failed", "All fields are required, Please fill the detail before submitting.", "error");
                }
                else
                {
                    $("#txtemail").val("");
                    $('#TblProjectLinks tr:last').after(data.messages);
                    swal("Success", "Added successfully.", "success");		
                }
            },
                complete: function() {
                    $('#loader').hide();
            }
        });
        
        return false;
        });
        //Add Address book Ends
        
        //Delete Address book Ends //EMAIL
        
        
        //Add Address book Begins //PHONE
        $('#btnAddLinkPhone').click(function () {
        
        var txtPhone   = $("#txtphone").val();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
           url: "/addressbookphone",
           type: "POST",
           data:  {'phone': txtPhone, 'user_id': {{$user->id}}},
           beforeSend : function()
           {
            //$("#preview").fadeOut();
            //$("#err").fadeOut();
           },
           success: function(data)
           {
                    
                if(data.errors)
                {
                    
                    swal("Failed", "All fields are required, Please fill the detail before submitting.", "error");
                }
                else
                {
                    $("#txtphone").val("");
                    $('#TblProjectLinksPhone tr:last').after(data.messages);
                    swal("Success", "Added successfully.", "success");		
                }
            },
                complete: function() {
                    $('#loader').hide();
            }
        });
        
        return false;
        });
        //Add Address book Ends		//PHONE
        
        
        //Delete Address book Begins
        $('button[data-notif-id]').click(function () {
        var LinkID=$(this).data("id")
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
           url: "/addressbook/"+LinkID,
           type: "POST",
           data:  {'_method': 'DELETE', 'id': LinkID },
           beforeSend : function()
           {
            //$("#preview").fadeOut();
            //$("#err").fadeOut();
            
           },
           success: function(data)
           {
                    
                if(data.errors)
                {
                    //$("#errmessage").html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Unable to sent message, please try again.</div>').fadeIn().fadeOut(5000);
                    swal("Failed", data.errors, "error");
                }
                else
                {
                    //$('#TblProjectLinks tr:last').after(data.messages);
                    $('#MyLinks_'+LinkID).remove();
                    swal("Success", data.messages, "success");
                    //$('#IDlinkadding').
                    
                }
            },
                complete: function() {
                    $('#loader').hide();
            }
        });
        return false;
        });
        
        </script>
@endsection