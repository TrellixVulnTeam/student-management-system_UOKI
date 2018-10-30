@extends('layouts.hwpl')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">LANGUAGES</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/setup">Setup</a></li>
                    <li class="active">Languages</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <a href="/languages"> <span class="fa fa-arrow-circle-left"></span> Back</a>
                    <h3 class="box-title">LANGUAGE [NEW]</h3>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                        @endforeach
                    @endif

                     {!! Form::open(array('url' => '/languages', 'method' => 'post', 'class'=> 'form-horizontal')) !!}
                        <div class="form-group">
                          <div class="col-md-5">
                            {{Form::label('name', 'Language')}}
                            {{Form::text('name', null, ['class' => 'form-control'])}}
                          </div>
                        </div>

                       <div class="form-group">
                          <div class="col-md-5">
                            {{Form::label('short_name', 'Language Short Name')}}
                            {{Form::text('short_name', null, ['class' => 'form-control', 'placeholder'=>'e.g. EN for English or KR for Korean'])}}
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
