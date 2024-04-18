    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="{{ asset('css/datakelembaban.css') }}" rel="stylesheet">

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['gauge']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Label', 'Value'],
                    ['Lembab', 0]
                ]);

                var options = {
                    width: 600,
                    height: 300,
                    redFrom: 90,
                    redTo: 100,
                    yellowFrom: 75,
                    yellowTo: 90,
                    greenFrom: 0,
                    greenTo: 75,
                    minorTicks: 5,
                    max: 100 // Set maximum value to 100%
                };

                var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

                chart.draw(data, options);

                // Function to update the gauge
                function updateGauge(kelembabanterbaru) {
                    data.setValue(0, 1, kelembabanterbaru);
                    chart.draw(data, options);
                }

                // AJAX function to fetch data from the server
                function fetchDataAndUpdateGauge() {
                    $.ajax({
                        url: '/owner/speedometer', // URL to your route that fetches kelembaban data
                        type: 'GET',
                        success: function(response) {
                            updateGauge(response
                                .kelembabanterbaru); // Assuming the response is in JSON format with a 'kelembabanterbaru' field
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                }
                fetchDataAndUpdateGauge();
                setInterval(fetchDataAndUpdateGauge, 2000); // Fetch data every 5 seconds (adjust as needed)
            }
        </script>
    </head>


    <body>
        {{-- header --}}
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand me-auto" href="#">
                    <img src="{{ asset('image/logo.png') }}" alt="" width="100">
                </a>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                            <a class="navbar-brand me-auto" href="#">
                                <img src="{{ asset('image/logo.png') }}" alt="" width="100">
                            </a>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-center flex-grow-1 pe-5">
                            <li class="nav-item">
                                <a class="nav-link mx-lg-3 active" aria-current="page" href="#">Data
                                    Kelembaban</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-lg-3" href="#">List Tugas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-lg-3" href="#">Data Karyawan</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('image/profile.png') }}" alt="" width="40px">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-item userdropdown">
                                <img src="{{ asset('image/profile.png') }}" alt="" width="40px">&nbsp
                                {{ $user->name }}
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item isidropdown1" href="/owner/profil"><img
                                        src="{{ asset('image/profile.png') }}" alt=""
                                        width="20px">&nbsp&nbspProfile
                                    <span>></span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item isidropdown2 mt-2" href="/logout"><img
                                        src="{{ asset('image/logout.png') }}" alt=""
                                        width="20px">&nbsp&nbspLogout
                                    <span>></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        {{-- header end --}}

        <!-- content -->
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <table class="table tabelbiasa" id="tabelkelembaban">
                        <thead>
                            <tr>
                                <th scope="col" colspan="3" style="background-color: #515646" class="text-light">
                                    Data Kelembaban</th>
                                <td scope="col" class="text-end tdatas" style="background-color: #515646"><a
                                        href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                        id="lihatsemua">Lihat Semua <i class="fa-solid fa-expand"></i></a></td>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($dataKelembaban as $kelembaban)
                                <tr>
                                    <td>{{ $kelembaban->kelembaban }}%</td>
                                    <td>{{ date('j F Y', strtotime($kelembaban->date)) }}</td>
                                    <!-- Menampilkan tanggal -->
                                    <td>{{ date('H:i', strtotime($kelembaban->date)) }}</td>
                                    <!-- Menampilkan waktu -->
                                    <td>{{ $kelembaban->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Data Kelembaban</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table tabelmodal" id="tabelkelembaban">
                                    <tbody class="text-center">
                                        <tr>
                                            @foreach ($dataKelembaban as $kelembaban)
                                        <tr>
                                            <td>{{ $kelembaban->kelembaban }}%</td>
                                            <td>{{ date('j F Y', strtotime($kelembaban->date)) }}</td>
                                            <!-- Menampilkan tanggal -->
                                            <td>{{ date('H:i', strtotime($kelembaban->date)) }}</td>
                                            <!-- Menampilkan waktu -->
                                            <td>{{ $kelembaban->status }}</td>
                                        </tr>
                                        @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div id="chart_div" class="speedometer"></div>
                </div>
            </div>
        </div>

        <!-- content end -->

        <script src="{{ asset('js/datakelembaban.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    </body>

    </html>
