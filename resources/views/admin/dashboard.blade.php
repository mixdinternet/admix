@extends('admin.master')

@section('content')
    <section class="content-header">
        <h1>
            Dashboard
            <small>estatísticas dos últimos {{ $days }} dias</small>
        </h1>
    </section>

    @if(env('ANALYTICS_SITE_ID') != '')
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $box['pageViews'] }} </h3>
                            <p>Visualização de página</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $box['uniquePageviews'] }}</h3>
                            <p>Visualizações de páginas únicas</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-connection-bars"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $box['avgTimeOnPage'] }}</h3>
                            <p>Tempo médio na página</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clock"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ number_format($box['bounceRate'], 0) }}% </h3>
                            <p>Taxa de rejeição</p>
                        </div>
                        <div class="icon">
                        @if ($box['bounceRate'] > 30 )
                            <i class="ion ion-sad-outline"></i>
                        @else
                            <i class="ion ion-happy-outline"></i>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="box flat">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Visualizações
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="lineChartViews" class="jq-line-chart"></canvas>
                            </div>
                            <script>
                                var lineChartViewsData = {
                                    labels: [{!! $graph['label'] !!}],
                                    datasets: [
                                        {
                                            label: "Visualizações",
                                            fillColor: "rgba(151,187,205,0.2)",
                                            strokeColor: "rgba(151,187,205,1)",
                                            pointColor: "rgba(151,187,205,1)",
                                            pointStrokeColor: "#fff",
                                            pointHighlightFill: "#fff",
                                            pointHighlightStroke: "rgba(151,187,205,1)",
                                            data: [{!! $graph['pageViews'] !!}]
                                        }
                                    ]
                                };
                            </script>
                        </div>
                        <div class="box-footer clearfix">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="box flat">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Visualizações de páginas unicas
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="lineChartVisits" class="jq-line-chart"></canvas>
                            </div>
                            <script>
                                var lineChartVisitsData = {
                                    labels: [{!! $graph['label'] !!}],
                                    datasets: [
                                        {
                                            label: "Visitas",
                                            fillColor: "rgba(151,187,205,0.2)",
                                            strokeColor: "rgba(151,187,205,1)",
                                            pointColor: "rgba(151,187,205,1)",
                                            pointStrokeColor: "#fff",
                                            pointHighlightFill: "#fff",
                                            pointHighlightStroke: "rgba(151,187,205,1)",
                                            data: [{!! $graph['visitors'] !!}]
                                        }
                                    ]
                                };
                            </script>
                        </div>
                        <div class="box-footer clearfix">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="box flat">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Origem
                            </h3>
                        </div>
                        <div class="box-body no-padding">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>Url</th>
                                    <th>Visualizações</th>
                                </tr>
                                @foreach ($direct as $item)
                                    <tr>
                                        <td>{{ $item['url'] }}</td>
                                        <td>{{ $item['pageViews'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box flat">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Páginas mais visualizadas
                            </h3>
                        </div>
                        <div class="box-body no-padding">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>Url</th>
                                    <th>Visualizações</th>
                                </tr>
                                @foreach ($mostVisited as $item)
                                    <tr>
                                        <td>{{ $item['url'] }}</td>
                                        <td>{{ $item['pageViews'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box flat">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Palavras chaves
                            </h3>
                        </div>
                        <div class="box-body no-padding">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>Palavra</th>
                                    <th>Sessões</th>
                                </tr>
                                @foreach ($topKeywords as $item)
                                    <tr>
                                        <td>{{ $item['keyword'] }}</td>
                                        <td>{{ $item['sessions'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
