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