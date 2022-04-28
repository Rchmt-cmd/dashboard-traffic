<div class="bg-white rounded shadow p-4">
    {{-- header --}}
    <h3><strong>{{ $chartTitle }}</strong></h3>
    <h6>Periode {{ $chart->getCurrentTime('monthfullname') }} {{ $chart->getCurrentTime('year') }}</h6><br>
    {{-- end header --}}

    {{-- dropdown --}}
    <div class="dropdown">
        <button class="btn light dark border border-1 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Scope
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item">Januari</a></li>
            <li><a class="dropdown-item">Februari</a></li>
            <li><a class="dropdown-item">Maret</a></li>
        </ul>
    </div>
    {{-- end dropdown --}}

    <div class="row align-items-center">        
        {{-- chart --}}
        <div class=" col-10 ">
            {!! $graph->container() !!}
        </div>
        {{-- end chart --}}
    
        {{-- description --}}
        <div class="col">
            {{-- LHR Terkini --}}
            <h6>LHR Terkini</h6>
            <h1><strong id="lhr-terkini">{{ $chart->getLhrData($chart->getCurrentTime('year'), $chart->getCurrentTime('monthnumber'), 'MMN') }}</strong></h1>
            <br>
            {{-- end LHR Terkini --}}


            {{-- LHR Last Year --}}
            <h6>{{ $chart->getCurrentTime('month') }} {{ $chart->getPrevTime('year') }}</h6>
            <div class="row justify-content-start">
                <h4 class="col-7"><strong>{{ $chart->getLhrData($chart->getPrevTime('year'), $chart->getCurrentTime('monthnumber'), 'MMN') }}</strong></h4>
                @if($chart->getGrowth('year', $chart->getCurrentTime('year'), $chart->getCurrentTime('monthnumber'), 'MMN') <= 0)
                    <span class="col p-0 text-danger">    &#9660; {{ $chart->getGrowth('year', $chart->getCurrentTime('year'), $chart->getCurrentTime('monthnumber'), 'MMN') }}%</span>  
                @else
                    <span class="col p-0 text-success">    &#9650; {{ $chart->getGrowth('year', $chart->getCurrentTime('year'), $chart->getCurrentTime('monthnumber'), 'MMN') }}%</span>
                @endif
            </div>
            {{-- end LHR last year --}}


            {{-- Lhr last month --}}
            <h6>{{ $chart->getPrevTime('month') }} {{ $chart->getCurrentTime('year') }}</h6>
            <div class="row">
                <h4 class="col-7"><strong>{{ $chart->getLhrData($chart->getCurrentTime('year'), $chart->getPrevTime('monthnumber'), 'MMN') }}</strong></h4>
                @if($chart->getGrowth('month', $chart->getCurrentTime('year'), $chart->getCurrentTime('monthnumber'), 'MMN') <= 0)
                    <span class="col p-0 text-danger">    &#9660; {{ abs($chart->getGrowth('month', $chart->getCurrentTime('year'), $chart->getCurrentTime('monthnumber'), 'MMN')) }}%</span>  
                @else
                    <span class="col p-0 text-success">    &#9650; {{ abs($chart->getGrowth('month', $chart->getCurrentTime('year'), $chart->getCurrentTime('monthnumber'), 'MMN')) }}%</span>
                @endif
            </div>
            {{-- end LHR last month --}}
            
        </div>
        {{-- end description --}}

    </div>
</div>

{{-- Function --}}
<script src="{{ $graph->cdn() }}"></script>
<script>
    function getData(value) {
        const a = document.getElementById('lhr-terkini');
        a.innerHTML = "{{ $chart->getLhrData('2022', '02', 'MMN') }}";
    }
</script>
{{-- end function --}}

{{ $graph->script() }}