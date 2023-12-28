@extends('_partials.index')
@section('content')
    @if (in_array(session()->get('role'), ['A', 'P']))
        <section class="section">
            <div class="row mb-2" id="card-statistik">
                <div class="col-12 col-md-3">
                    <div class="card card-statistic">
                        <div class="card-body p-0">
                            <div class="d-flex flex-column">
                                <div class='px-3 py-3 d-flex justify-content-between'>
                                    <h3 class='card-title'>Data Ibu</h3>
                                </div>
                                <div class="px-3 d-flex justify-content-between">
                                    <h3 class='card-title'><i class="fa-solid fa-person-breastfeeding fa-fade fa-2xl"></i>
                                    </h3>
                                    <div class="card-right d-flex align-items-center">
                                        <p class="fs-1 p-0 card-s" id="data_ibu">0</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card card-statistic">
                        <div class="card-body p-0">
                            <div class="d-flex flex-column">
                                <div class='px-3 py-3 d-flex justify-content-between'>
                                    <h3 class='card-title'>Data Anak</h3>
                                </div>
                                <div class="px-3 d-flex justify-content-between">
                                    <h3 class='card-title'><i class="fa-solid fa-children fa-fade fa-2xl"></i></h3>
                                    <div class="card-right d-flex align-items-center">
                                        <p class="fs-1 p-0 card-s" id="data_anak">0</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (in_array(session()->get('role'), ['A']))
                    <div class="col-12 col-md-3">
                        <div class="card card-statistic">
                            <div class="card-body p-0">
                                <div class="d-flex flex-column">
                                    <div class='px-3 py-3 d-flex justify-content-between'>
                                        <h3 class='card-title'>Data Posyandu</h3>
                                    </div>
                                    <div class="px-3 d-flex justify-content-between">
                                        <h3 class='card-title'>
                                            <i class="fa-solid fa-house-medical-flag fa-fade fa-2xl"></i>
                                        </h3>
                                        <div class="card-right d-flex align-items-center">
                                            <p class="fs-1 p-0 card-s" id="data_posyandu">0</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="card card-statistic">
                            <div class="card-body p-0">
                                <div class="d-flex flex-column">
                                    <div class='px-3 py-3 d-flex justify-content-between'>
                                        <h3 class='card-title'>Data Petugas</h3>
                                    </div>
                                    <div class="px-3 d-flex justify-content-between">
                                        <h3 class='card-title'><i class="fa-solid fa-user-nurse fa-fade fa-2xl"></i>
                                        </h3>
                                        <div class="card-right d-flex align-items-center">
                                            <p class="fs-1 p-0 card-s" id="data_petugas">0</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if (in_array(session()->get('role'), ['P']))
                    <div class="col-12 col-md-6">
                        <div class="card card-statistic">
                            <div class="card-body p-0">
                                <div class="d-flex flex-column">
                                    <div class='px-3 py-3 d-flex justify-content-between'>
                                        <h3 class='card-title'>Data Check UP</h3>
                                    </div>
                                    <div class="px-3 d-flex justify-content-between">
                                        <h3 class='card-title'><i class="fa-solid fa-list-check fa-fade fa-2xl"></i>
                                        </h3>
                                        <div class="card-right d-flex align-items-center">
                                            <p class="fs-1 p-0 card-s" id="data_checkup">0</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row d-none mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Statistik Pemeriksaan Kesehatan</h4>
                        </div>
                        <div class="card-body">
                            <div id="bar"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Statistik Pemeriksaan Imunisasi</h4>
                        </div>
                        <div class="card-body">
                            <div id="line"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Statistik Check Up</h4>
                        </div>
                        <div class="card-body">
                            <div id="polar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            $(function() {
                let cards = $('#card-statistik').find('.card-s');
                const url = '{{ route('cardstatistik') }}'
                const requestOptions = {
                    method: 'GET',
                };

                fetch(url, requestOptions)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        $.each(cards, function(indexInArray, valueOfElement) {
                            let attr = $(valueOfElement).attr('id')
                            let textContent = data[attr];
                            $(this).text(textContent);
                        });

                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
            var barOptions = {
                series: [{
                    name: 'Jumlah Anak Diperiksa',
                    data: [120, 200, 150, 300, 180, 250, 100]
                }, {
                    name: 'Rata-rata Berat Badan',
                    data: [10, 15, 12, 18, 14, 16, 8]
                }, {
                    name: 'Rata-rata Tinggi Badan',
                    data: [80, 90, 85, 95, 88, 92, 78]
                }],
                chart: {
                    type: "bar",
                    height: 350,
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "55%",
                        endingShape: "rounded",
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ["transparent"],
                },
                xaxis: {
                    categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct"],
                },
                yaxis: {
                    title: {
                        text: "Jumlah / Rata-rata",
                    },
                },
                fill: {
                    opacity: 1,
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return "$ " + val + " thousands";
                        },
                    },
                },
            };


            var PolarOptions = {
                chart: {
                    type: 'polarArea',
                    height: 350,
                    toolbar: {
                        show: true
                    }
                },
                series: [30, 40, 45, 50, 49, 60, 70, 91],
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                fill: {
                    opacity: 1
                },
                stroke: {
                    width: 1,
                    colors: undefined
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'left',
                    offsetX: 40
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 300
                        },
                        legend: {
                            show: false
                        }
                    }
                }]
            }

            var bar = new ApexCharts(document.querySelector("#bar"), barOptions);

            var polar = new ApexCharts(document.querySelector("#polar"), PolarOptions);
            bar.render();
            line.render();
            polar.render();
        </script>
    @endif
    @if (in_array(session()->get('role'), ['O', 'A', 'P']))
        <section class="section">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header text-center bg-info">
                                <h2 class="text-white text-uppercase fw-bolder">Selamat Datang Di SIPANDU</h2>
                            </div>
                            <img class="card-img img-fluid" src="{{ asset('assets/images/bg-home4.jpg') }}"
                                alt="Card image">
                            <div class="card-body">
                                <figure>
                                    <blockquote class="blockquote">
                                        <h4>Tetap Jaga Kesehatan Si Kecil: Imunisasi dan Vitamin</h4>
                                    </blockquote>
                                    <blockquote class="blockquote">
                                        <p>"Kesehatan si kecil adalah investasi terbesar kita. Imunisasi dan
                                            vitamin merupakan langkah penting dalam menjaga pertumbuhan dan masa
                                            depan yang cerah bagi buah hati kita</p>
                                        <p>Ayo, jadwalkan kunjungan ke posyandu atau fasilitas kesehatan
                                            terdekat. Dengan rutin memeriksakan si kecil dan memastikan jadwal
                                            imunisasi serta suplemen vitamin yang direkomendasikan oleh dokter,
                                            kita memberikan yang terbaik untuk masa depannya."</p>
                                    </blockquote>
                                    <figcaption class="blockquote-footer mt-3">
                                        Jaga kesehatan si kecil, jaga masa depannya.
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                @if (in_array(session()->get('role'), ['O']))
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Statistik Tinggi Badan Anak</h4>
                            </div>
                            <div class="card-body">
                                <div id="area"></div>
                            </div>
                        </div>
                    </div>
                    <script>
                        const url = '{{ route('statistiktinggi') }}';
                        fetch(url)
                            .then(response => response.json())
                            .then(data => {
                                console.log(data)
                                let month = data.map(item => {
                                    // Memformat tanggal hanya menampilkan bulan
                                    return item.bulan_periksa
                                });
                                let heights = data.map(item => item.tinggi_pemeriksaan);
                                var LineOptions = {
                                    chart: {
                                        type: 'area',
                                        height: 350,
                                        toolbar: {
                                            show: true
                                        }
                                    },
                                    series: [{
                                        name: 'BCG',
                                        data: heights
                                    }],
                                    xaxis: {
                                        categories: month,
                                    },
                                    yaxis: {
                                        title: {
                                            text: 'Tinggi Badan'
                                        }
                                    },
                                    stroke: {
                                        curve: 'smooth'
                                    },
                                    markers: {
                                        size: 4,
                                        colors: ['#008FFB']
                                    },
                                    legend: {
                                        position: 'top',
                                        horizontalAlign: 'left',
                                        offsetX: 40
                                    }
                                }

                                var line = new ApexCharts(document.querySelector("#area"), LineOptions);
                                line.render();
                            })
                            .catch(error => {
                                console.log(error)
                            })
                    </script>
                @endif

            </div>
        </section>
    @endif
@endsection
