@extends('layouts.hwpl')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">FRUIT ACTIVITY TYPES</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/setup">Setup</a></li>
                    <li class="active">Fruit Activity Types</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <a href="/activity-types"> <span class="fa fa-arrow-circle-left"></span> Back</a>
                    <h3 class="box-title">FRUIT ACTIVITY TYPES [NEW]</h3>
                     {!! Form::open(array('url' => '/activity-types', 'method' => 'post', 'class'=> 'form-horizontal')) !!}
                        <div class="form-group">
                          <div class="col-md-5">
                            {{Form::label('name', 'Type')}}
                            {{Form::text('name', null, ['class' => 'form-control'])}}
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-md-5">
                            {{Form::label('language_id', 'Language')}}
                            {{Form::select('language_id', $languages, null, ['class' => 'form-control select'])}}
                          </div>
                        </div>
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
