<script type="text/javascript">
    $(function () {
        var {{ $model->id }} = new Highcharts.Chart({
            colors: [
                @foreach($model->colors as $c)
                    "{{ $c }}",
                @endforeach
            ],
            chart: {
                renderTo:  "{{ $model->id }}",
                @include('charts::_partials.dimension.js2')
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'column'
            },
            @if($model->title)
                title: {
                    text:  "{{ $model->title }}"
                },
            @endif
            @if(!$model->credits)
                credits: {
                    enabled: false
                },
            @endif
            plotOptions: {
                series: {
                    colorByPoint: true,
                },
            },
           xAxis: {
                categories: [
                    @foreach($model->labels as $label)
                         "{{ $label }}",
                    @endforeach
                ],
            },
            yAxis: {
                title: {
                    text:  "{{ $model->element_label }}"
                },
            },
            series: [{
                name: "{{ $model->element_label }}",
                data: [
                    @foreach($model->values as $dta)
                        {{ $dta }},
                    @endforeach
                ]
            }]
        })
    });
</script>

@if(!$model->customId)
    @include('charts::_partials.container.div')
@endif
