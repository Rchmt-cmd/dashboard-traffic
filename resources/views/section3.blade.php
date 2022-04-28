<div class="bg-white rounded shadow p-4">
    <h3><strong>{{ $chartTitle3 }}</strong></h3>
    <h6>Update {{ $chart3->getCurrentTime('monthfullname') }} {{ $chart3->getCurrentTime('year') }}</h6><br>
    
    <div class="row align-items-center">
        
        {{-- chart --}}
        <div class=" col-10 ">
            {!! $graph3->container() !!}
        </div>
    
        {{-- description --}}
        <div class="col">
            <h6>LHR YTD Aktual</h6>
            <h1><strong>{{ $chart3->getLhrYtd() }}</strong></h1>
            <br>
            <h6>Aktual {{ $chart3->getPrevTime('year') }}</h6>
            <div class="row justify-content-start">
                <h4 class="col-7"><strong>{{ $chart3->getLhrYtd('prev') }}</strong></h4>
                @if($chart3->getGrowth() <= 0)
                    <span class="col p-0 text-danger">    &#9660; {{ $chart3->getGrowth() }} %</span>
                @else
                    <span class="col p-0 text-success">    &#9650; {{ $chart3->getGrowth() }} %</span>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="{{ $graph3->cdn() }}"></script>

{{ $graph3->script() }}