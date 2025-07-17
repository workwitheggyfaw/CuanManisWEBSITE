<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Analisis - Cuan Manis</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to top, #FFA552, #FFF5E5, #ffffff);
            padding-bottom: 100px;
            margin: 0;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #FFF8C4;
            padding: 10px 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .logo {
            height: 40px;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 20px;
            margin: 0;
            padding: 0;
        }

        nav ul li a,
        nav ul li button {
            text-decoration: none;
            color: #102E50;
            font-weight: 600;
            padding: 8px 12px;
            border-radius: 8px;
            transition: 0.3s;
            background: none;
            border: none;
            cursor: pointer;
        }

        nav ul li a:hover,
        nav ul li button:hover {
            background-color: #FFE4C4;
            color: #FF7B00;
        }

        nav ul li a.active {
            background-color: #FFBD59;
            color: #fff;
        }

        h2.center-text {
            text-align: center;
            margin: 30px 0 20px;
            color: #FF7B00;
        }

        .graph-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
        }

        .charts-wrapper {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .chart-box {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.08);
            padding: 20px;
            flex: 1 1 300px;
            max-width: 400px;
        }

        .chart-box canvas {
            width: 100% !important;
            height: auto !important;
        }

        .pie-stats {
            margin-top: 10px;
            font-size: 14px;
            color: #102E50;
            line-height: 1.4;
        }

        .footer {
            background: #FFF8C4;
            padding: 15px;
            text-align: center;
            color: #102E50;
            font-size: 13px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        @media (max-width: 768px) {
            .graph-container {
                padding: 15px;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- NAVBAR -->
    <nav>
        <img class="logo" src="{{ asset('assets/web/logo_cuanmanis.png') }}" alt="Logo Cuan Manis">
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('profile.show') }}">Lihat Profil Saya</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </nav>

    <!-- HEADER -->
    <h2 class="center-text">Grafik Analisis Data</h2>

    <!-- GRAPH CONTAINER -->
    <div class="graph-container">
        <div class="charts-wrapper">
            <!-- Pie Chart Container -->
            <div class="chart-box">
                <canvas id="pieChart"></canvas>
                <div class="pie-stats">
                    Total barang: {{ $barangCount }}<br>
                    Total kos: {{ $kosCount }}
                </div>
            </div>

            <!-- Bar Chart Container -->
            <div class="chart-box">
                <canvas id="analyticsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        © {{ date('Y') }} Cuan Manis – Dibuat oleh mahasiswa, untuk mahasiswa. 🍯
    </div>

    <!-- Chart.js Script -->
    <script>
        const barang = {{ $barangCount }};
        const kosan  = {{ $kosCount }};
        const total  = barang + kosan;

        // PIE CHART
        new Chart(document.getElementById('pieChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Barang', 'Kosan'],
                datasets: [{
                    data: [barang, kosan],
                    backgroundColor: ['#FF7B00', '#FFBD59'],
                    borderColor: ['#E66B00', '#E6A94F'],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => {
                                const value = ctx.parsed;
                                const percent = ((value / total) * 100).toFixed(1);
                                return `${ctx.label}: ${percent}%`;
                            }
                        }
                    }
                }
            }
        });

        // BAR CHART
        new Chart(document.getElementById('analyticsChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Barang', 'Kosan'],
                datasets: [{
                    label: 'Jumlah Postingan',
                    data: [barang, kosan],
                    backgroundColor: ['#FF7B00', '#FFBD59'],
                    borderColor: ['#E66B00', '#E6A94F'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                },
                plugins: {
                    legend: { display: true, position: 'top' },
                    title: {
                        display: true,
                        text: 'Total Barang dan Kosan yang Diposting'
                    }
                }
            }
        });
    </script>
</body>
</html>
