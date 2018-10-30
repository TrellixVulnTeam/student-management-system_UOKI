@extends('layouts.hwpl')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">{{$event->name}}</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                   <li class="active">Other Attendees Activity Report</li>
               </ol>
           </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <a href="/events/{{$event->slug}}"> <span class="fa fa-calendar"></span> Event Page</a>
                    <h3 class="box-title">{{$activity_title}} / <span class="text-muted">{{$participant->name}}</span></h3>
                    {!! Form::open(array('route' => array($route, $type, $participant->id, $event->slug), 'method' => 'post', 'class'=> 'form-vertical form-material', 'enctype="multipart/form-data"')) !!}
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">

                                {{Form::label('users[]', 'Representatives')}}
                                {{Form::select('users[]', $users, null, ['class' => 'form-control select2 select2-multiple', 'multiple'])}}
                                <small><span class="help-text">Please include all representatives in attendance apart from yourself [<strong>{{Auth::user()->name}}</strong>]. If you were the only representative, please leave this field blank.</span></small>
                            </div>
                        </div> 
                    </div>
                    @if($activity_type != 'Meeting')
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">

                                {{Form::label('direction', 'Direction')}}
                                {{Form::select('direction', ['Out' => 'Out Going', 'In'=>'In Coming'], null, ['class' => 'form-control'])}}
                            </div>
                        </div> 
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-5">
                        <div class="form-group">

                            {{Form::label('other_participant', 'Who')}}
                            {{Form::hidden('activity_type', $activity_type, ['class' => 'form-control'])}}
                            {{Form::text('other_participant', $participant->name, ['class' => 'form-control', 'readonly'])}}

                        </div>
                    </div> 
                    </div>
                   <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        {{Form::label('when', 'When')}}
                        {{Form::text('when', null, ['class' => 'form-control mydatepicker', 'placeholder' => 'Click here', 'autocomplete'=>'off', 'required'])}}

                        </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        {{Form::label('time', 'Time')}}
                        {{Form::text('time', null, ['class' => 'form-control timepicker', 'placeholder' => 'Click here', 'autocomplete'=>'off', 'required'])}}

                        </div>
                    </div>
                    </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    {{Form::label('why', 'Why')}}
                    {{Form::textarea('why', null, ['class' => 'form-control', 'placeholder' => 'Type here'])}}
                </div>
            </div>
        </div>
           <div class="row">
                <div class="col-md-12">
              <div class="form-group">
                {{Form::label('outcome', 'Outcome')}}
                {{Form::textarea('outcome', null, ['class' => 'form-control', 'placeholder' => 'Type here'])}}
            </div>
           </div>
           @if($activity_type == 'Meeting')
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {{Form::label('photos', 'Photos')}}
                        {{Form::file('photos[]', null, ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::file('photos[]', null, ['class' => 'form-control'])}}
                    </div>
                     <div class="form-group">
                        {{Form::file('photos[]', null, ['class' => 'form-control'])}}
                    </div>
                </div>
            </div>
            @endif

    <button type="submit" class="btn btn-success"><span class="fa fa-check-circle"></span> Save</button>
    <button type="reset" class="btn btn-warning"><span class="fa fa-ban"></span> Reset</button>
    {!! Form::close() !!}
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
