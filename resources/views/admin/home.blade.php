<x-app-layout>

    {{-- store admin dashboard --}}
    

{{-- card for vistors number in js.chart --}}
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Visitors</h3>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="visitors" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
</div>
{{-- single tone for vistors number --}}
<script>
    var ctx = document.getElementById("visitors").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                @foreach($visitors as $visitor)
                    "{{ $visitor->created_at->format('d-m-Y') }}",
                @endforeach
            ],
            datasets: [{
                label: 'Visitors',
                data: [
                    @foreach($visitors as $visitor)
                        {{ $visitor->count }},
                    @endforeach
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>

    {{-- get the number of current wesite visitors using ajax --}}
    <script>
        function getVisitors() {
            $.ajax({
                url: '/admin/visitors',
                type: 'GET',
                success: function(data) {
                    $('#visitors').html(data);
                }
            });
        }
        getVisitors();
        setInterval(getVisitors, 1000);
    </script>

   
    

</x-app-layout>
