@extends('admin.master')

@section('content')
    <section class="content">
        <div class="box flat">
            <div class="box-header with-border">
                <h3 class="box-title">
                    @yield('title')
                </h3>

                <div class="pull-right">
                <span class="jq-actions">
                    @yield('btn-insert')
                </span>
                <span class="jq-actions-sel">
                    @yield('btn-delete-all')
                </span>
                </div>
            </div>

            <div class="box-search with-border">

                @yield('search')

            </div>

            <div class="box-body table-responsive">

                @yield('table')

            </div>

            <div class="box-footer clearfix">
                <span class="no-margin pull-left hidden-xs pagination-showing">
                    @yield('pagination-showing')
                </span>

                <span class="no-margin pull-right">
                    @yield('pagination')
                </span>
            </div>
        </div>
    </section>
@endsection