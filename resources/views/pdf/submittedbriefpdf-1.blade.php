@extends('layouts.pdf')

@section('title')
Brief Submitted File
@endsection

<?php
// dark red #a13535
if ($brief->projectstatus_id == 1) {
  $ps_color = "background-color:#5ec8d6;color:#ffffff;"; //light blue #5ec8d6 
} else {
  $ps_color = "background-color:#33b3a6;color:#ffffff;"; //blue green #33b3a6
}
?>

@section('content')
<div class="page-break1">
  <div class="row bg-white">
    <div class="col-xs-12">
      <!-- Title -->
      <div class="row m-b-md">
        <div class="col-xs-6 m-b-n m-t-n">
          <img src="{{url('/')}}/images/Vista_logo_Vista_gray.png" width="121" height="59">
      	  <h1 class="text-default hide">VISTA TEXT</h1>
        </div>
        <div class="col-xs-6 m-t-sm">
      	  <p class="pull-right text-muted">{{date('d/m/Y')}}</p>
        </div>
        <div class="col-xs-12 m-t-n">
      	  <h2 class="text-brand1">Brief Sheet</h2>
        </div>
      </div>
      <!-- / Title -->

      <!-- Information -->
      <div class="row">
        <div class="col-xs-6">
          <label class="control-label text-left"><strong>Client</strong></label>
        	<p class="bg-light p-l-sm">
            @if (count($brief->client))
              {{ $brief->client->name }}
            @else
              &lt;client info missing&gt;
            @endif
            &nbsp;
          </p>
        </div>
        <div class="col-xs-6">
          <label class="control-label text-left"><strong>Project Status</strong></label>
        	<p class="bg-light p-l-sm" style="{{$ps_color}}">
            @if (count($brief->projectstatus))
              {{ $brief->projectstatus->name }}
            @else
              &lt;status info missing&gt;
            @endif
            &nbsp;
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-6">
          <label class="control-label text-left"><strong>Job Number</strong></label>
        	<p class="bg-light p-l-sm">{{$brief->jobnumber}}</p>
        </div>
        <div class="col-xs-6">
          <label class="control-label text-left"><strong>Old Job Number</strong></label>
        	<p class="bg-light p-l-sm">{{$brief->old_jobnumber}}&nbsp;</p>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-9">
          <label class="control-label text-left"><strong>Job Name</strong></label>
        	<p class="bg-light p-l-sm p-r-sm">{{$brief->jobname}}</p>
        </div>
        <div class="col-xs-3">
          <label class="control-label text-left"><strong>Your Budget</strong></label>
        	<p class="bg-light p-l-sm p-r-sm">{{$brief->budget}}&nbsp;</p>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-9">
          <label class="control-label text-left"><strong>Key Deliverables</strong></label>
        	<p class="bg-light p-l-sm p-r-sm">{{$brief->keydeliverables}}&nbsp;</p>
        </div>
        <div class="col-xs-3">
            <label class="control-label text-left"><strong>Project Manager</strong></label>
        	<p class="bg-light p-l-sm p-r-sm">{{$brief->projectmanager}}&nbsp;</p>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-3">
          <label class="control-label text-left text-xs">
            <strong>Quote Required By</strong></label>
        	<p class="bg-light p-l-sm">
            {{(!empty($brief->quoted_required_by_at)) ? $brief->quoted_required_by_at->format('d M Y') : ''}}&nbsp;
          </p>
        </div>
        <div class="col-xs-3">
          <label class="control-label text-left text-xs">
            <strong>Proposal Required By</strong></label>
        	<p class="bg-light p-l-sm">
            {{ (!empty($brief->proposal_required_by_at)) ? $brief->proposal_required_by_at->format('d M Y') : '' }}&nbsp;
          </p>
        </div>
        <div class="col-xs-3">
          <label class="control-label text-left text-xs">
            <strong>1st Stage Required By</strong></label>
        	<p class="bg-light p-l-sm">
            {{ (!empty($brief->firststage_required_by_at)) ? $brief->firststage_required_by_at->format('d M Y') : '' }}&nbsp;
          </p>
        </div>
        <div class="col-xs-3">
          <label class="control-label text-left text-xs">
            <strong>Project Delivered By</strong></label>
        	<p class="bg-light p-l-sm">
            {{ (!empty($brief->project_delivered_by_at)) ? $brief->project_delivered_by_at->format('d M Y') : '' }}&nbsp;
          </p>
        </div>
      </div>
      <!-- / Information -->
    </div>
  </div>
</div>

<div class="">
  <div class="row bg-white" style="height:50px"></div>
</div>

<div class="page-break1">
  <div class="row bg-white">

    <div class="col-xs-12">
      <div class="row m-b-md">
        <div class="col-xs-6">
          <h3>Original Brief</h3>
        </div> 
      </div>
    </div>

    <div class="col-xs-12">

      @if ($brief->summary)
      <div class="row m-t-n">
        <div class="col-xs-12 m-b-sm">
          <p class="bg-primary p-l-sm" style="{{$ps_color}} margin-bottom:0px;"><strong>#01 Brief Summary</strong></p>
          <p class="bg-light p-l-sm p-r-sm" style="margin-top:0px;">{!! nl2br(e($brief->summary)) !!}</p>
        </div>
      </div>
      @endif

      @if ($brief->disciplines_required_ids)
      <div class="row m-t-sm">
        <div class="col-xs-12">
          <p class="bg-primary p-l-sm" style="{{$ps_color}}"><strong>#02 Disciplines Required</strong></p>
        </div>
        <div class="col-xs-12 m-b-sm">
          <div class="row">
            @foreach ($departments as $department)
            <div class="col-xs-3">
              <p><strong>{{ $department->name }}</strong></p>
              <p class="bg-light p-l-sm">
                {{ (in_array($department->id, explode(',',$brief->disciplines_required_ids))) ? 'Yes':'&nbsp;' }}
              </p>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      @endif

      @if ($brief->objectives_or_measures)
      <div class="row m-t-sm">
        <div class="col-xs-12 m-b-lg">
          <p class="bg-primary p-l-sm" style="{{$ps_color}} margin-bottom:0px;"><strong>#03 Objectives / Measure</strong></p>
          <p class="bg-light p-l-sm p-r-sm" style="margin-top:0px;">{!! nl2br(e($brief->objectives_or_measures)) !!}&nbsp;</p>
        </div>
      </div>
      @endif

      @if ($brief->content)
      <div class="row m-t-sm">
        <div class="col-xs-12 m-b-lg">
          <p class="bg-primary p-l-sm" style="{{$ps_color}} margin-bottom:0px;"><strong>#04 Context</strong></p>
          <p class="bg-light p-l-sm p-r-sm" style="margin-top:0px;">{!! nl2br(e($brief->content)) !!}&nbsp;</p>
        </div>
      </div>
      @endif

      @if ($brief->targetaudience_and_insight)
      <div class="row m-t-sm">
        <div class="col-xs-12 m-b-lg">
          <p class="bg-primary p-l-sm" style="{{$ps_color}} margin-bottom:0px;"><strong>#05 Target Audience and Insight</strong></p>
          <p class="bg-light p-l-sm p-r-sm" style="margin-top:0px;">{!! nl2br(e($brief->targetaudience_and_insight)) !!}</p>
        </div>
      </div>
      @endif

      @if ($brief->targetaudience_think)
      <div class="row m-t-sm">
        <div class="col-xs-12 m-b-lg">
          <p class="bg-primary p-l-sm" style="{{$ps_color}} margin-bottom:0px;"><strong>#06 What do I want the target audience to Think?</strong></p>
          <p class="bg-light p-l-sm p-r-sm" style="margin-top:0px;">{!! nl2br(e($brief->targetaudience_think)) !!}</p>
        </div>
      </div>
      @endif

      @if ($brief->targetaudience_feel)
      <div class="row m-t-sm">
        <div class="col-xs-12 m-b-lg">
          <p class="bg-primary p-l-sm" style="{{$ps_color}} margin-bottom:0px;"><strong>#06 What do I want the target audience to Feel?</strong></p>
          <p class="bg-light p-l-sm p-r-sm" style="margin-top:0px;">{!! nl2br(e($brief->targetaudience_feel)) !!};</p>
        </div>
      </div>
      @endif

      @if ($brief->targetaudience_do)
      <div class="row m-t-sm">
        <div class="col-xs-12 m-b-lg">
          <p class="bg-primary p-l-sm" style="{{$ps_color}} margin-bottom:0px;"><strong>#06 What do I want the target audience to Do?</strong></p>
          <p class="bg-light p-l-sm p-r-sm" style="margin-top:0px;">{!! nl2br(e($brief->targetaudience_do)) !!}</p>
        </div>
      </div>
      @endif

      @if ($brief->keymessages_or_propositions)
      <div class="row m-t-sm">
        <div class="col-xs-12 m-b-lg">
          <p class="bg-primary p-l-sm" style="{{$ps_color}} margin-bottom:0px;"><strong>#07 Key Messages / Propositions</strong></p>
          <p class="bg-light p-l-sm p-r-sm" style="margin-top:0px;">{!! nl2br(e($brief->keymessages_or_propositions)) !!}</p>
        </div>
      </div>
      @endif

      @if ($brief->creative)
      <div class="row m-t-sm">
        <div class="col-xs-12 m-b-lg">
          <p class="bg-primary p-l-sm" style="{{$ps_color}} margin-bottom:0px;"><strong>#08 Creative</strong></p>
          <p class="bg-light p-l-sm p-r-sm" style="margin-top:0px;">{!! nl2br(e($brief->creative)) !!}</p>
        </div>
      </div>
      @endif

      @if ($brief->budget_timings_and_outputs)
      <div class="row m-t-sm">
        <div class="col-xs-12 m-b-lg">
          <p class="bg-primary p-l-sm" style="{{$ps_color}} margin-bottom:0px;"><strong>#09 Budgets, Timings and Outputs Required</strong></p>
          <p class="bg-light p-l-sm p-r-sm" style="margin-top:0px;">{!! nl2br(e($brief->budget_timings_and_outputs)) !!}</p>
        </div>
      </div>
      @endif

      @if (count($brief->attachmentsNotAmend))
      <div class="row m-t-sm m-b-n">
        <div class="col-xs-12 m-b-lg">
          <p class="bg-brand-1 p-l-sm text-white" style="{{$ps_color}}"><strong>#10 Attachments</strong></p>
          @foreach ($brief->attachmentsNotAmend as $attachment)
          <div>
            <ul class="p-l-n l-s-n">
              <li>
                <i class="{{ $attachment->classNames }} text-md"></i> 
                <a 
                  class="" 
                  href="{{ route('download_attachment', [$attachment->id]) }}">
                  <span class="text-brand1">{{ $attachment->filename }}</span>
                </a>
              </li>
            </ul>
            <h6 class="p-l-n text-muted">
              @if (count($attachment->user))
                Uploaded by {{ $attachment->user->forename }} {{ $attachment->user->surname }}
              @else
                Upload by &lt;missing info&gt;
              @endif
               - {{ $attachment->updated_at->format('H:i:s l, d M Y') }}
            </h6>
          </div>
          @endforeach
        </div>
      </div>
      @endif
      </div>
    </div>
  </div>
</div>
@endsection