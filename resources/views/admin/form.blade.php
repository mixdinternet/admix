@extends('admin.master')

@section('content')
    <section class="content">
        <div class="box flat">
            <div class="box-header with-border">
                <h3 class="box-title">

                    @yield('title')

                </h3>

                <div class="pull-right">
                    @include('admin.partials.actions.btn.save')
                    @include('admin.partials.actions.btn.back')
                </div>

            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">

                        @yield('form')

                    </div>
                </div>
            </div>
            <div class="box-footer">
            </div>
        </div>
    </section>
@stop