@extends('dashboard.layouts.app')

@role('admin')

@section('extra-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap/dist/css/jsvectormap.min.css" />
@endsection

@section('content')
<div class="justify-center max-xl:w-full">
    <div class="flex flex-col bg-white rounded-xl p-8 drop-shadow-lg">
        <section class="mb-7">
            <h1 class="text-xl text-gray-800 mb-5">Statistik</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">
                @foreach($dashboard->statistics as $statistic)
                <div class="border-2 border-primary rounded-lg p-5 shadow-lg">
                    <div class="font-semibold">Total {{ $statistic->name }}</div>
                    <div class="mt-4 text-primary">
                        <div class="text-3xl font-bold">{{ number_format( $statistic->count ,0,",",".") }}</div>
                        <div class="text-sm text-right mt-1">{{ $statistic->name }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        {{--
        <section class="mb-7">
            <h1 class="text-xl text-gray-800 mb-5">Total Wirausaha</h1>
            <div class="flex flex-col gap-5">
                <div class="w-full h-auto">
                    <canvas id="bar-entrepreneurs"></canvas>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="border-2 border-primary rounded-lg p-5 shadow-lg">
                        <div class="font-semibold mb-3">Kategori Wirausaha</div>
                        <canvas id="pie-entrepreneurs"></canvas>
                    </div>
                    <div class="border-2 border-primary rounded-lg p-5 shadow-lg">
                        <div class="font-semibold">Usia Usaha</div>
                        <canvas id="pie-age"></canvas>
                    </div>
                    <div class="border-2 border-primary rounded-lg p-5 shadow-lg">
                        <div class="font-semibold">NIB</div>
                        <canvas id="pie-nib"></canvas>
                    </div>
                    <div class="border-2 border-primary rounded-lg p-5 shadow-lg">
                        <div class="font-semibold">Platform</div>
                        <canvas id="pie-platform"></canvas>
                    </div>
                </div>
            </div>
        </section>
        --}}

        <section class="mb-7">
            <h1 class="text-xl text-gray-800 mb-5">Perseberan Wilayah</h1>
            <div id="map" class="w-full !h-[350px]"></div>
        </section>

        <section class="mb-7">
            <h1 class="text-xl text-gray-800 mb-5">Program Terfavorit</h1>
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">
                @foreach($dashboard->favourite->workshops as $workshop)
                <div class="flex flex-col justify-between border-2 border-primary rounded-lg p-5 shadow-lg">
                <div class="font-semibold">{{ Str::limit($workshop->title, 120, '...') }}</div>
                    <div class="mt-4 text-primary">
                        <div class="text-3xl font-bold">{{ number_format( $workshop->count ,0,",",".") }}</div>
                        <div class="text-sm text-right mt-1">Partisipan</div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <section class="mb-7">
            <h1 class="text-xl text-gray-800 mb-5">Mentor Terfavorit</h1>
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">
                @foreach($dashboard->favourite->mentors as $mentor)
                <div class="flex justify-between flex-col md:flex-row items-center gap-3 border-2 border-primary rounded-lg p-5 shadow-lg">
                    <div class="flex items-center gap-3">
                        <img class="w-20 h-20 object-cover rounded-full" src="{{ $mentor->avatar_url }}" alt="{{ $mentor->fullname }}" />
                        <div class="flex flex-col gap-1 lg:items-start items-center">
                            <div class="font-semibold">{{ $mentor->fullname }}</div>
                            <div class="text-xs">{{ $mentor->expertise }}</div>
                        </div>
                    </div>
                    <div class="text-3xl text-primary font-bold">{{ number_format( $mentor->count ,0,",",".") }}</div>
                </div>
                @endforeach
            </div>
        </section>
    </div>
</div>
@endsection

@endrole

@section('extra-js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jsvectormap"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/maps.js') }}"></script>
<script>
    const mapData = @json($dashboard->map_data);

    var map = new jsVectorMap({
        selector: "#map",
        map: "indonesia",
        showTooltip: true,
        markers: mapData,
        labels: {
            markers: {
                render(marker, index) {
                    return marker.name || 'Not available'
                }
            }
        }
    });

    new Chart(document.getElementById('bar-entrepreneurs'), {
        type: 'bar',
        data: {
            labels: ['Quartal 1', 'Quartal 2', 'Quartal 3', 'Quartal 4'],
            datasets: [
                {
                    label: 'Masyarakat Umum',
                    data: graphicData.general,
                    backgroundColor: 'rgba(147, 214, 164, 1)'
                },
                {
                    label: 'Calon Wirausaha',
                    data: graphicData.candidate,
                    backgroundColor: 'rgba(184, 196, 129, 1)'
                },
                {
                    label: 'Wirausaha Pemula',
                    data: graphicData.starter,
                    backgroundColor: 'rgba(139, 175, 75, 1)'
                },
                {
                    label: 'Wirausaha Mapan',
                    data: graphicData.expert,
                    backgroundColor: 'rgba(30, 81, 99, 1)'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    new Chart(document.getElementById('pie-entrepreneurs'), {
        type: 'pie',
        data: {
            labels: ['Masyarakat Umum', 'Calon Wirausaha', 'Wirausaha Pemula', 'Wirausaha Mapan'],
            datasets: [{
                data: pieData.entrepreneur,
                backgroundColor: ['rgba(147, 214, 164, 1)', 'rgba(184, 196, 129, 1)', 'rgba(139, 175, 75, 1)', 'rgba(30, 81, 99, 1)']
            }]
        },
        options: {
            responsive: true,
            aspectRatio: 2.5,
            plugins: {
                legend: {
                    position: 'right'
                }
            }
        }
    });

    new Chart(document.getElementById('pie-age'), {
        type: 'pie',
        data: {
            labels: ['0-3.5 tahun', '> 3.5'],
            datasets: [{
                data: pieData.pie,
                backgroundColor: ['rgba(147, 214, 164, 1)', 'rgba(184, 196, 129, 1)']
            }]
        },
        options: {
            responsive: true,
            aspectRatio: 2.5,
            plugins: {
                legend: {
                    position: 'right'
                }
            }
        }
    });

    new Chart(document.getElementById('pie-nib'), {
        type: 'pie',
        data: {
            labels: ['NIB', 'Belum punya NIB'],
            datasets: [{
                data: pieData.nib,
                backgroundColor: ['rgba(147, 214, 164, 1)', 'rgba(184, 196, 129, 1)']
            }]
        },
        options: {
            responsive: true,
            aspectRatio: 2.5,
            plugins: {
                legend: {
                    position: 'right'
                }
            }
        }
    });

    new Chart(document.getElementById('pie-platform'), {
        type: 'pie',
        data: {
            labels: ['Tokopedia', 'Bukalapak', 'Shopee', 'Lazada'],
            datasets: [{
                data: pieData.platform,
                backgroundColor: ['rgba(147, 214, 164, 1)', 'rgba(184, 196, 129, 1)', 'rgba(139, 175, 75, 1)', 'rgba(30, 81, 99, 1)']
            }]
        },
        options: {
            responsive: true,
            aspectRatio: 2.5,
            plugins: {
                legend: {
                    position: 'right'
                }
            }
        }
    });
</script>
@endsection
