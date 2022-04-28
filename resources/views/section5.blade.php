<div class="bg-white rounded shadow p-4">
    <h3><strong>{{ $chartTitle6 }}</strong></h3>

    {{-- chart --}}
    <div class="container">
        <div class="">
            {!! $chart6->container() !!}
        </div>
        <br><br>
        <div class="">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col-9">Tahun</th>
                        <th scope="col-1">Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1998</th>
                        <td>Commenced Operation on April 29, 1998</td>
                    </tr>
                    <tr>
                        <th scope="row">2004-2005</th>
                        <td>V / C ratio of Ir. Sutami is saturated with the existing width: 7m which is used in 2 directions</td>
                    </tr>
                    <tr>
                        <th scope="row">2006-Sept 2008</th>
                        <td>Implementation of Section IV Toll Road Construction so that traffic decreases</td>
                    </tr>
                    <tr>
                        <th scope="row">2009-2013</th>
                        <td>Traffic generation caused by the operation of Toll Road section IV (JTSE)</td>
                    </tr>
                    <tr>
                        <th scope="row">2014-2015</th>
                        <td>JTSE frontage damage affects BMN traffic because residents prefer to use Perintis kemerdekaan roads</td>
                    </tr>
                    <tr>
                        <th scope="row">2016</th>
                        <td>Traffic grew relatively small due to the disruption of the construction of the Simpang Lima Mandai Work</td>
                    </tr>
                    <tr>
                        <th scope="row">2017</th>
                        <td>Traffic increased due to the construction of the Lima Mandai intersection completed at the end of June 2017</td>
                    </tr>
                    <tr>
                        <th scope="row">2018</th>
                        <td>With the construction of the Pettarani elevated toll road, have an impact on the decline in traffic that began in the August 2018 period and a significant influence occurred in the December 2018 period</td>
                    </tr>
                    <tr>
                        <th scope="row">2019</th>
                        <td>The Pettarani Elevated Toll Road Project has an impact on the decrease in Traffic compared to the previous period</td>
                    </tr>
                    <tr>
                        <th scope="row">2020</th>
                        <td>Covid 19 cause decreased traffic, and Pettarani Elevated Toll Road Project still has an influence</td>
                    </tr>
                    <tr>
                        <th scope="row">2021</th>
                        <td>Covid 19 still continue impact to decrease traffic</td>
                    </tr>
                    <tr>
                        <th scope="row">2022</th>
                        <td>Covid 19 still continue impact to decrease traffic</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="{{ $chart6->cdn() }}"></script>

{{ $chart6->script() }}