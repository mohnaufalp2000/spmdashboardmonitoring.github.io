<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPM Monitoring Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            padding: 20px;
        }

        h1,
        h2,
        h3 {
            text-align: center;
        }

        .unit {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            width: 100%;
            /* Lebar unit 100% untuk layar kecil */
            max-width: 600px;
            /* Lebar maksimum unit */
            margin: auto;
            /* Tengah secara horizontal */
        }

        .unit h2 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .pressures-first {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* 3 kolom dengan lebar yang sama */
            grid-template-rows: auto auto;
            /* 2 baris dengan tinggi yang menyesuaikan konten */
            grid-column-gap: 20px;
            /* Jarak antar kolom */
            grid-row-gap: 10px;
            /* Jarak antar baris */
        }

        .pressures-second {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* 3 kolom dengan lebar yang sama */
            grid-template-rows: auto auto;
            /* 2 baris dengan tinggi yang menyesuaikan konten */
            grid-column-gap: 20px;
            /* Jarak antar kolom */
            grid-row-gap: 10px;
            /* Jarak antar baris */
        }

        p {
            text-align: center;
        }

        .image-container {
            display: flex;
            justify-content: center;
            /* Pusatkan secara horizontal */
        }

        .image-container img {
            max-width: 100%;
            /* Pastikan gambar tidak melebihi lebar kontainer */
            height: auto;
            /* Menjaga rasio aspek gambar */
        }



        .pressure {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .green {
            background-color: #d4edda;
            /* Warna latar belakang hijau */
        }

        .red {
            background-color: #f8d7da;
            /* Warna latar belakang merah */
        }

        /* Kustomisasi untuk tampilan spesifik */
        .pressure-1 {
            grid-column: 1 / span 1;
            /* Kolom pertama */
            grid-row: 1 / span 1;
            /* Baris pertama */
        }

        .pressure-logo {
            grid-column: 2 / span 1;
            /* Kolom pertama */
            grid-row: 1 / span 1;
            background-color: #f8d7da;
            /* Baris pertama */
        }

        .pressure-2 {
            grid-column: 3 / span 1;
            /* Kolom ketiga */
            grid-row: 1 / span 1;
            /* Baris pertama */
        }

        .pressure-3 {
            grid-column: 1 / span 1;
            /* Kolom ketiga */
            grid-row: 1 / span 1;
            /* Baris pertama */
        }

        .pressure-4 {
            grid-column: 2 / span 1;
            /* Kolom ketiga */
            grid-row: 1 / span 1;
            /* Baris pertama */
        }

        .pressure-5 {
            grid-column: 3 / span 1;
            /* Kolom ketiga */
            grid-row: 1 / span 1;
            /* Baris pertama */
        }

        .pressure-6 {
            grid-column: 4 / span 1;
            /* Kolom ketiga */
            grid-row: 1 / span 1;
            /* Baris pertama */
        }

        @media (max-width: 600px) {
            .unit {
                padding: 5px;
                /* Mengurangi padding untuk layar kecil */
            }

            .pressures {
                grid-template-columns: repeat(1, 1fr);
                /* Mengubah menjadi satu kolom pada layar kecil */
            }
        }
    </style>
</head>

<body>
    <h3>SPM Project Synergy CP - CK</h3>
    <div class="image-container">
        <img src="images/cpck.png" alt="Pressure Image" width="70%" height="80" />
    </div>
    <br />

    <?php

    function getPressureClass($pressure)
    {
        if ($pressure == 1) {
            return 'green'; // Kelas untuk warna hijau
        } elseif ($pressure == 0) {
            return 'red'; // Kelas untuk warna merah
        } else {
            return ''; // Kelas default
        }
    }

    // Check if idunit is provided in URL
    if (isset($_GET['idunit'])) {
        $idunit = $_GET['idunit'];

        // Construct API URL with idunit
        $api_url = 'https://cts-chitraparatama.co.id/ChitraTireMngr/product/api_get.php?function=get_tpms_satuan&idunit=' . urlencode($idunit);

        // Read JSON File
        $json_data = file_get_contents($api_url);

        // Decode JSON data into PHP array
        $response_data = json_decode($json_data);

        // Check if data exists in response
        if (isset($response_data->data)) {
            $units = $response_data->data;

            // Loop through units and display each unit's data
            foreach ($units as $unit) {
                echo '<div class="unit">';
                echo '<p>' . 'Tire Pressure Monitoring (' .  $unit->devicename . ')</p>';
                echo '<div class="pressures-first">';
                echo '<div class="pressure pressure-1 ' . (getPressureClass($unit->press1)) . '"> <strong>Pos 1:</strong> ' . '<br/>'  . $unit->pressure_1 . ' Psi' . '<br/>' . 'Temp.: ' . $unit->temperature_1 . '°C' . '</div>';
                echo '<div class="pressure-logo' . getPressureClass($unit->press1) . '">';
                echo '<img src="images/tpms_icon.png" alt="Pressure Image" width="100" height="60"/>';
                echo '<img src="images/2452.png" alt="Pressure Image" width="100" height="200"/>';
                echo '</div>';
                echo '<div class="pressure pressure-2 ' . (getPressureClass($unit->press2)) . '"> <strong>Pos 2:</strong> ' . '<br/>'  . $unit->pressure_2 . ' Psi' . '<br/>' . 'Temp.: ' . $unit->temperature_2 . '°C' . '</div>';
                echo '</div>'; // End pressures first
                echo '<div class="pressures-second">';
                echo '<div class="pressure ' . (getPressureClass($unit->press3)) . '"><strong>Pos 3:</strong> ' . '<br/>'  . $unit->pressure_3 . ' Psi' . '<br/>' . 'Temp. : ' . $unit->temperature_3 . '°C' . '</div>';
                echo '<div class="pressure ' . (getPressureClass($unit->press4)) . '"><strong>Pos 4:</strong> ' . '<br/>'  . $unit->pressure_4 . ' Psi' . '<br/>' . 'Temp. : ' . $unit->temperature_4 . '°C' . '</div>';
                echo '<div class="pressure ' . (getPressureClass($unit->press5)) . '"><strong>Pos 5:</strong> ' . '<br/>'  . $unit->pressure_5 . ' Psi' . '<br/>' . 'Temp. : ' . $unit->temperature_5 . '°C' . '</div>';
                echo '<div class="pressure ' . (getPressureClass($unit->press6)) . '"><strong>Pos 6:</strong> ' . '<br/>'  . $unit->pressure_6 . ' Psi' . '<br/>' . 'Temp. : ' . $unit->temperature_6 . '°C' . '</div>';
                echo '</div>'; // End pressures second
                echo '</div>'; // End unit
            }
        } else {
            echo '<p>No data available for idunit: ' . htmlspecialchars($idunit) . '</p>';
        }
    } else {
        echo '<p>No idunit provided in the URL.</p>';
    }
    ?>

</body>

</html>