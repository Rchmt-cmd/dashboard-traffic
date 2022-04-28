
    <div class="row m-0 justify-content-between">
        <div class=" col p-4 bg-white rounded shadow ">
            <h3><strong>{{ $chartTitle4 }}</strong></h3>
            <h6>Periode {{ $chart4->getCurrentTime('monthfullname') }} {{ $chart4->getCurrentTime('year') }}</h6><br>
            {!! $graph4->container() !!} <br><br>
            <h3><strong>Perbandingan Per Gerbang</strong></h3>
            <h6>{{ $chart4->getCurrentTime('year') }} vs {{ $chart4->getPrevTime('year') }}</h6><br>
            <table class="table table-hover table-sm text-small">
                <thead>
                    <tr>
                        <th scope="col-9"></th>
                        @foreach ($chart4->getGraphData('gate') as $gate)
                            <th scope="col-1" class="test">{{ $gate }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" class="test">{{ $chart4->getCurrentTime('year') }}</th>
                        @foreach ($chart4->getGraphData('percentage') as $percentage)
                            <td class="test">{{ $percentage }}%</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th scope="row" class="test">{{ $chart4->getPrevTime('year') }}</th>
                        @foreach ($chart4->getGraphData('percentage', 'prev') as $percentage)
                            <td class="test">{{ $percentage }}%</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
            {!! $chart7->container() !!}
        </div>


        <div class="col p-4 bg-white rounded shadow">
            <h3><strong>{{ $chartTitle5 }}</strong></h3>
            <h6>Periode {{ $chart5->getCurrentTime('monthfullname') }} {{ $chart5->getCurrentTime('year') }}</h6><br>
            {!! $graph5->container() !!} <br><br>
            <h3><strong>Perbandingan Per Golongan</strong></h3>
            <h6>{{ $chart5->getCurrentTime('year') }} vs {{ $chart5->getPrevTime('year') }}</h6><br>
            <table class="table table-hover table-sm text-small">
                <thead>
                    <tr>
                        <th scope="col-9"></th>
                        @foreach ($chart5->getGraphData('class') as $class)
                            <th scope="col-1" class="test">{{ $class }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" class="test">{{ $chart5->getCurrentTime('year') }}</th>
                        @foreach ($chart5->getGraphData('percentage') as $percentage)
                            <td class="test">{{ $percentage }}%</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th scope="row" class="test">{{ $chart5->getPrevTime('year') }}</th>
                        @foreach ($chart5->getGraphData('percentage', 'prev') as $percentage)
                            <td class="test">{{ $percentage }}%</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
            {!! $chart8->container() !!}
        </div>
    </div>

<script src="{{ $graph4->cdn() }}"></script>
<script src="{{ $graph5->cdn() }}"></script>
<script src="{{ $chart7->cdn() }}"></script>
<script src="{{ $chart8->cdn() }}"></script>

{{ $graph4->script() }}
{{ $graph5->script() }}
{{ $chart7->script() }}
{{ $chart8->script() }}