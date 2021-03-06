@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ config('app.name', '') }}
                </div>

                <div class="card-body">
                    <div class="row">

                        <div
                            class="text-justify col-md-8 offset-md-2">

                            <p>
                                In order to facilitate qualitative
                                data analysis (case
                                law, interview, focus groups, press
                                articles, etc.), Corpus offers a
                                service that is both simple and
                                efficient, based on the experience in
                                qualitative methodology by
                                <strong>ULiège</strong>.
                            </p>
                            <p>
                                <div class="text-center">
                                    <img src="{{ asset('storage/corpus-workflow.png') }}"
                                        width="550px"
                                        alt="corpus workflow">
                                </div>
                            </p>

                            <p>
                                Corpus is developed by the University
                                of Liège and licensed under
                                <strong>GPLv3</strong>.
                            </p>

                            <p>
                                Code source is available at
                                <strong>GitHub</strong> and
                                everybody is welcome to contribute.
                            </p>
                        </div>

                        <div class="col-md-2">
                            <a href="https://docs.lltl.be"
                                class="btn btn-primary pull-right">
                                <fa icon="file-alt"></fa>
                                Docs
                            </a>
                            @auth

                            <a href="{{ route('portfolio') }}"
                                class="btn btn-success pull-right">
                                <fa icon="tachometer-alt"></fa>
                                {{ __('app.portfolio') }}
                            </a>
                            @endauth

                        </div>



                        <div class="text-right col-md-12">
                            <a
                                href="{{ config('core_settings.lltl_url') }}"><img
                                    src="{{ asset('storage/legaltech_logo.png') }}"
                                    width="240px" alt=""
                                    class="pull-right">
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
