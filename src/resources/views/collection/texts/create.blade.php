@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Text create view -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">

                <div class="card-header">
                    {{ __('app.create_new_text') }}</div>

                <div class="card-body">

                    {!! Form::open(['url' =>
                    route('collection.texts.store',
                    $collection->slug)]) !!}


                    <div class="row">
                        <div class="form-group">

                            <label for="id-field-ame"
                                class="control-label col-lg-12">Name</label>
                            <div class="col-lg-12">
                                <input id="id-field-Name" name="name"
                                    maxlength="1000"
                                    class="form-control" required>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="form-group">

                            <label for="id-field-abstract"
                                class="control-label col-lg-12">Abstract</label>
                            <div class="col-lg-12">
                                <textarea id="id-field-abstract"
                                    rows="10" cols="50"
                                    name="abstract" maxlength="1000"
                                    class="form-control">
                        </textarea>
                            </div>
                        </div>

                    </div>


                    <div class="pull-right">
                        {!! Form::button(__("app.create_new_text") . '
                        <i class="fa fa-floppy-o"></i>', array('type'
                        => 'submit', 'class' => 'btn btn-primary'))
                        !!}
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
