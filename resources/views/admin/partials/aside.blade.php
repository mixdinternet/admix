<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ auth()->user()->image->url('crop') }}" class="img-circle"
                     alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <a><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        {!! Menu::render('adminlte-sidebar') !!}

    </section>
</aside>