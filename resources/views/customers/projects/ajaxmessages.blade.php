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
@endif