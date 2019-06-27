@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif 
<?php
function makeLinks($str) {
	$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
	$urls = array();
	$urlsToReplace = array();
	if(preg_match_all($reg_exUrl, $str, $urls)) {
		$numOfMatches = count($urls[0]);
		$numOfUrlsToReplace = 0;
		for($i=0; $i<$numOfMatches; $i++) {
			$alreadyAdded = false;
			$numOfUrlsToReplace = count($urlsToReplace);
			for($j=0; $j<$numOfUrlsToReplace; $j++) {
				if($urlsToReplace[$j] == $urls[0][$i]) {
					$alreadyAdded = true;
				}
			}
			if(!$alreadyAdded) {
				array_push($urlsToReplace, $urls[0][$i]);
			}
		}
		$numOfUrlsToReplace = count($urlsToReplace);
		for($i=0; $i<$numOfUrlsToReplace; $i++) {
			$str = str_replace($urlsToReplace[$i], "<a target='_blank' href=\"".$urlsToReplace[$i]."\">".$urlsToReplace[$i]."</a> ", $str);
		}
		return $str;
	} else {
		return $str;
	}
}
?>

<!-- Box Project Info Begins -->
<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Project Details for: {{$projectDetail->projectName}}</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body" style="">
				<table class="table table-striped">
						<tr>
							<td width="25%"><b>Customer Name</b></td>
							<td width="75%">{{$projectDetail->customer->fname}} {{$projectDetail->customer->lname}} <input type="hidden" value="{{$projectDetail->id}}" id="project_id"></td>
						</tr>
						<tr>
								<td width="25%"><b>Project Name</b></td>
								<td width="75%">{{$projectDetail->projectName}}</td>
							</tr>
							<tr>
								<td><b>Description</b></td>
								<td>{!! html_entity_decode(nl2br(e(makeLinks($projectDetail->projectDescription)))) !!}</td>
							</tr>
							<!-- checkboxes -->
							<tr>
								<td><b>Requirements: </b></td>
								<td>
								 <b>SMM:</b> {{$projectDetail->isSMM=== 1 ? "Yes" : "No"}} | 
								 <b>Web:</b> {{$projectDetail->isWeb=== 1 ? "Yes" : "No"}} | 
								 <b>iOS APP:</b> {{$projectDetail->isiOS=== 1 ? "Yes" : "No"}} | 
								 <b>Android APP:</b> {{$projectDetail->isAndroid=== 1 ? "Yes" : "No"}} | 
								 <b>Custom Solutions:</b> {{$projectDetail->isCustom=== 1 ? "Yes" : "No"}}
								</td>
							</tr>
							<tr>
								<td><b>Created By</b></td>
								<td>{{$projectDetail->createdby->fname}} {{$projectDetail->createdby->lname}}</td>
							</tr>

							<tr>
								<td><b>Status</b></td>
								<td>
									@if ($projectDetail->status === 1)
										<span class="text-green"><b>Active</b></span>
									@else
										<span class="text-red"><b>Deactive</b></span>
									@endif
								</td>
							</tr>

							<tr>
								<td><b>Created At</b></td>
								<td>{{$projectDetail->created_at->format('d-m-Y')}}</td>
							</tr>
							<tr>
								<td><b>Updated At</b></td>
								<td>{{$projectDetail->updated_at->format('d-m-Y')}}</td>
							</tr>	
				</table>

	
		</div>
		<!-- /.box-body -->
	</div>
<!-- Box Project Info ends -->

<!-- Box Project Lead Info Begins -->
@if($projectDetail->lead_id !=null)
@php
$lead_detail=$projectDetail->lead
@endphp
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Lead Details</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body" style="">

		<table class="table table-striped">
			<tr>
				<td width="25%"><b>Business Name</b></td>
				<td width="75%">{{$lead_detail->businessName}}</td>
			</tr>
			<tr>
				<td width="25%"><b>Business Address</b></td>
				<td width="75%">{{$lead_detail->businessAddress}}</td>
			</tr>
			<tr>
				<td><b>Business Nature</b></td>
				<td>{{$lead_detail->businessNature}}</td>
			</tr>
			<tr>
				<td><b>Description</b></td>
				<td>{!! html_entity_decode(nl2br(e(makeLinks($lead_detail->description)))) !!}</td>
			</tr>
			<!-- checkboxes -->
			<tr>
				<td><b>Shared Details</b></td>
				<td><b>Company Profile:</b> {{$lead_detail->company_pro=== 1 ? "Yes" : "No"}} | <b>Testimonials:</b> {{$lead_detail->testimonials=== 1 ? "Yes" : "No"}} | <b>Solutions & Services:</b> {{$lead_detail->solser=== 1 ? "Yes" : "No"}}</td>
			</tr>
			<!-- social links -->
			<tr>
				<td><b>Facebook</b></td>
				<td><a href="{{$lead_detail->fblink}}" target="_blank">{{$lead_detail->fblink}}</a> (<b>Likes:</b> {{$lead_detail->fblike}})</td>
			</tr>
			<tr>
				<td><b>Twitter</b></td>
				<td><a href="{{$lead_detail->twlink}}" target="_blank">{{$lead_detail->twlink}} </a> (<b>Followers:</b> {{$lead_detail->twfollwer}})</td>
			</tr>				
			<tr>
				<td><b>Instagram</b></td>
				<td><a href="{{$lead_detail->inlink}}" target="_blank">{{$lead_detail->inlink}} </a> (<b>Followers:</b> {{$lead_detail->incfollower}})</td>
			</tr>
			<tr>
				<td><b>LinkedIn</b></td>
				<td><a href="{{$lead_detail->lilink}}" target="_blank">{{$lead_detail->lilink}}</a> <b>(Followers:</b> {{$lead_detail->livisitor}})</td>
			</tr>
			<tr>
				<td><b>Web</b></td>
				<td><a href="{{$lead_detail->weblink}}" target="_blank">{{$lead_detail->weblink}}</a></td>
			</tr>
			<tr>
				<td><b>Assigned To</b></td>
				<td>{{isset($lead_detail->assignedTo) ? $lead_detail->assignedTo->fname.' '.$lead_detail->assignedTo->lname : "NA" }}</td>
			</tr>

			<tr>
				<td><b>Created By</b></td>
				<td>{{$lead_detail->createdby->fname}} {{$lead_detail->createdby->lname}}</td>
			</tr>

			<tr>
				<td><b>Created At</b></td>
				<td>{{$lead_detail->created_at->format('d-m-Y')}}</td>
			</tr>
			<tr>
				<td><b>Updated At</b></td>
				<td>{{$lead_detail->updated_at->format('d-m-Y')}}</td>
			</tr>				
			
		  </table>
			


	</div>
	<!-- /.box-body -->
</div>
<!-- Box Project Lead Info ends -->
@endif

<!-- Box Project Assets Begins -->

<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-title">Project Assets</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body" style="">
				
				@if(count($assets) > 0)
				<ul class="mailbox-attachments clearfix">
						@foreach($assets as $asset)
						@if(Storage::disk('local')->exists('public/projects_assets/'.$projectDetail->id.'/'.$asset->attachment))
						
							<li>
								<div class="mailbox-attachment-info">
									<p class="mailbox-attachment-name">{{$asset->note}}</p>
											<span class="mailbox-attachment-size">
											{{number_format((Storage::disk('local')->size('public/projects_assets/'.$projectDetail->id.'/'.$asset->attachment)/1024),2)}} KBs
												<a href="{{Storage::disk('local')->url('public/projects_assets/'.$projectDetail->id.'/'.$asset->attachment)}}" target="_blank" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
											</span>
								</div>
							</li>
							@endif
							@endforeach
						</ul>
				@endif
		</div>
		<!-- /.box-body -->
		<div class="box-footer clearfix" style="">
				<div class="pull-right">
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default"><li class="fa fa-plus"></li> Upload</button>
				</div>
			</div>
			<!-- /.box-footer -->
	</div>
<!-- Box Project Assets ends -->

<!-- Box Project Links Begins -->

<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title">Project Links</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body" style="">

			<table class="table table-bordered" id="TblProjectLinks">
				<tbody><tr>
				  <th>Platform Name</th>
				  <th>Link</th>
				  <th>Action</th>
				</tr>
				<tr>
					<td><input type="text" name="txttitle" id="txttitle" placeholder="Enter Platform Name" class="form-control"></td>
					<td><input type="url" name="txtlinkurl" id="txtlinkurl" placeholder="Enter URL" class="form-control"></td>
					<td><button class="btn btn-success" id="btnAddLink"><li class="fa fa-plus"></li></button><span id="IDlinkadding"></span></td>
				</tr>	
				@if(count($projectlinks) > 0)
				@foreach($projectlinks as $projectlink)
					<tr id="MyLinks_{{$projectlink->id}}">
					  <td>{{$projectlink->title}}</td>
					  <td><a href="{{$projectlink->linkurl}}" target="_blank">{{$projectlink->linkurl}}</a></td>
					  <td><button class="btn btn-danger" id="btnDeleteLink" data-notif-id="MyLinks" data-id="{{$projectlink->id}}"><li class="fa fa-trash"></li></button></td>
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
<!-- Box Project Links ends -->
		</section>		
		<div class="modal fade" id="modal-default" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span></button>
						<h4 class="modal-title">Upload Document</h4>
					</div>
					<form role="form" id="frmAssetForm">
						@csrf
						<input type="hidden" name="project_id" value="{{$projectDetail->id}}">
					<div class="modal-body">
							<div class="box-body">
								<div class="form-group">
									<input type="text" placeholder="Enter Title" name="note" id="note" class="form-control">
								</div>
								<div class="form-group">
									<input type="file" id="projectAsset" name="projectAsset" class="form-control">
								</div>
							</div>
							<span id="err"></span>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" id="btnUploadAsset">Upload</button>
					</div>
					</form>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		


		<!-- timeline -->
<section class="content">
<div id="btnNew" style="cursor:pointer;z-index:100;">
	<span class="pull-right"><a href="{!! url('tasks/'.$projectDetail->id.'' ); !!}" class="btn btn-info btn-flat btn-lg margin"><li class="fa fa-eye"></li> View Tasks</a>
	<a href="{!! url('tasks/create/'.$projectDetail->id.'' ); !!}" class="btn bg-green btn-flat btn-lg margin"><li class="fa fa-plus"></li> New Task</a>
	<span class="btn bg-orange btn-flat btn-lg margin" onclick="openNav()" id="btnNewMessage"><li class="fa fa-plus"></li> New Message</span>
</div>
<!-- row -->
<div class="row">
	<div class="col-md-12">
		<?php
			$dated="";
			$showdate=1;
		?>
		@if(count($messages) > 0)
		@foreach($messages as $message)
		<?php

			if($dated==""){
				$dated=$message->created_at->format('d-M-Y');
				$showdate=1;
			}elseif($dated===$message->created_at->format('d-M-Y')){				
					$showdate=0;
			}else{
				$showdate=1;
				$dated=$message->created_at->format('d-M-Y');
			}
		?>
		<!-- The time line -->
		<ul class="timeline" id="timelinemore" data-next-page="{{ $messages->nextPageUrl() }}">
			@if($showdate===1)
			<!-- timeline time label -->
			<li class="time-label" >
						<span class="bg-red">
							{{$dated}}
						</span>
			</li>
			<!-- /.timeline-label -->
			@endif
			<!-- timeline item -->
			<li>
				<i class="fa fa-envelope bg-blue"></i>

				<div class="timeline-item">
					<span class="time"><i class="fa fa-clock-o"></i> {{$message->created_at->format('H:i')}} </span>

					<h3 class="timeline-header"><a href="#">{{$message->user->fname}} {{$message->user->lname}}</a> posted</h3>

					<div class="timeline-body">
						{!! html_entity_decode(nl2br(e(makeLinks($message->message)))) !!}
								@if(count($message->assets) > 0)
								<div class="clearfix"><br></div>
								<ul class="mailbox-attachments clearfix">
									@foreach($message->assets as $asset)
									@if(Storage::disk('local')->exists('public/projects_assets/'.$projectDetail->id.'/messages/'.$asset->attachment))
									
										<li>
											<div class="mailbox-attachment-info">
												<p class="mailbox-attachment-name">{{$asset->orginalfilename}}</p>
														<span class="mailbox-attachment-size">
														{{number_format((Storage::disk('local')->size('public/projects_assets/'.$projectDetail->id.'/messages/'.$asset->attachment)/1024),2)}} KBs
															<a href="{{Storage::disk('local')->url('public/projects_assets/'.$projectDetail->id.'/messages/'.$asset->attachment)}}" target="_blank" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
														</span>
											</div>
										</li>
										@endif
										@endforeach
									</ul>
							@endif
					</div>

				</div>
			</li>
			<!-- END timeline item -->
			
			@endforeach
		</ul>
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
@endif
			<!-- timeline ends -->
<style>
	.loader {
			border: 8px solid #f2f2f2; /* Light grey */
			border-top: 8px solid #3498db; /* Blue */
			border-radius: 50%;
			width: 40px;
			height: 40px;
			animation: spin 2s linear infinite;
	}
	
	@keyframes spin {
			0% { transform: rotate(0deg); }
			100% { transform: rotate(360deg); }
	}
	</style>
	<div id="loader" class="loader text-center"></div>
<style>

.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1050;
    top: 0;
    right: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
    padding: 4px 4px 4px 16px;
    text-decoration: none;
    color: #f1f1f1;
    display: block;
    transition: 0.3s;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    left: 5px;
    font-size: 56px;
		border-radius:100%;
}
@media screen and (max-height: 450px)
{
	.sidenav
	{width:100%;}
}
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>

<div id="mySidenav" class="sidenav">
	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	
	
						<!-- form start -->
						<div style="padding: 50px;">
            <form role="form" id="frmMessage" method="post" >
						@csrf
						<input type="hidden" name="project_id" value="{{$projectDetail->id}}">
              <div class="box-body">
                <div class="form-group">
                  <textarea class="form-control" rows="12" name="message" id="message" placeholder="Enter your Message Here"></textarea>
                </div>
                <div class="form-group">
                  <input type="file" id="MessageAssets" name="MessageAssets[]" class="btn btn-danger btn-lg" multiple>
								</div>
								
                <div class="form-group">
									<span id="errmessage"></span>
                  <button type="submit" class="btn btn-danger btn-lg pull-right">Post Message</button>                  
                </div>
              </div>
						</form>
					</div>
          

  
</div>
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "70%";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

	$(window).scroll(function(e){ 
  var $el = $('#btnNew'); 
  var isPositionFixed = ($el.css('position') == 'fixed');
  if ($(this).scrollTop() > 200 && !isPositionFixed){ 
    $('#btnNew').css({'position': 'fixed', 'top': '0px', 'right': '10px'}); 
  }
  if ($(this).scrollTop() < 200 && isPositionFixed)
  {
    $('#btnNew').css({'position': 'static', 'top': '0px', 'right': '10px'}); 
  } 
});

$(document).ready(function (e) {
 $("#frmAssetForm").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "/projectasset",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {
    //$("#preview").fadeOut();
    $("#err").fadeOut();
   },
   success: function(data)
    {
			
				if(data.errors)
				{
					$("#err").html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Unable to upload, Title and file are required.</div>').fadeIn().fadeOut(5000);
				}
				else
				{
				// view uploaded file.
					$("#frmAssetForm")[0].reset(); 
					$('#modal-default').modal('hide');
					swal("Success", "Document uploaded successfully.", "success");
					location.reload();
				}
    },
     error: function(e) 
      {
    		$("#err").html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+ e +'</div>').fadeIn();
      }          
    });
 }));
});

$(document).ready(function (e) {
 $("#frmMessage").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "/projectmessage",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {
    //$("#preview").fadeOut();
    $("#err").fadeOut();
   },
   success: function(data)
    {
			
				if(data.errors)
				{
					$("#errmessage").html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Unable to sent message, please try again.</div>').fadeIn().fadeOut(5000);
				}
				else
				{
				// view uploaded file.
					$("#frmMessage")[0].reset(); 
					document.getElementById("mySidenav").style.width = "0";
					swal("Success", "Message sent successfully.", "success");
					location.reload();

				}
    },
     error: function(e) 
      {
    		$("#errmessage").html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+ e +'</div>').fadeIn();
      }          
    });
 }));
});

var ajaxRunning = false;
$(document).ready(function() {
	$('#loader').hide();
		 $(window).scroll(fetchPosts);
	
		 function fetchPosts() {
	
				 var page = $('.timeline').data('next-page');

				 if(page !== null) {
	
						 clearTimeout( $.data( this, "scrollCheck" ) );

					
						 $.data( this, "scrollCheck", setTimeout(function() {
								 var scroll_position_for_posts_load = $(window).height() + $(window).scrollTop() + 100;
	
								 if(scroll_position_for_posts_load >= $(document).height()) {				 	
										  $.ajax(page, {asynchronous:true, evalScripts:true, method:'get', 
													beforeSend: function() {
														$('#loader').show();
													},
													success: function(data) {
														$('#loader').hide();
														$('#timelinemore').append(data.messages);
														$('#timelinemore').data('next-page', data.next_page);

													},
													complete: function() {
														$('#loader').hide();
															ajaxRunning = false;
													}
												},);
								 }
						 }, 350))
	
				 }
		 }
	
	
 });


//Add Link Script Begins
$('#btnAddLink').click(function () {

var txtTitle   = $("#txttitle").val();
var txtLinkurl = $("#txtlinkurl").val();
$.ajaxSetup({
	headers: {
	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$.ajax({
   url: "/projectlink",
   type: "POST",
   data:  {'title': txtTitle, 'linkurl': txtLinkurl, 'project_id': {{$projectDetail->id}}},
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
			$("#txttitle").val("");
			$("#txtlinkurl").val("");
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
//Add Link Script Ends

//Delete Link Script Begins
$('button[data-notif-id]').click(function () {
var LinkID=$(this).data("id")

$.ajaxSetup({
	headers: {
	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});
$.ajax({
   url: "/projectlink/"+LinkID,
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
//Delete Link Script Ends
</script>
@endsection