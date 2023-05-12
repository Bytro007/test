<?php
$jenis_mobil = ['Avanza', 'Rush', 'Alphard', 'Innova', 'Fortuner'];
sort($jenis_mobil)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan taxi</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>

<body>
    <div class="container border">
        <div class="row">
            <div class="col-1"><img src="assets/images/logo mobil.png" width="120%"></div>
            <div class="col-11"><br>
                <h4>Pemesanan Taxi Online</h4>
            </div>
        </div>
        <form action="index.php" method="post">
            <div class="row">
                <div class="col-lg-2"><label for="nama">Nama :</label></div>
                <div class="col-lg-2"><input type="text" id="nama" name="nama"></div>
            </div>
            <div class="row">
                <div class="col-lg-2"><label for="no_hp">No HP:</label></div>
                <div class="col-lg-2"><input type="text" id="no_hp" name="no_hp"></div>
            </div>
            <div class="row">
                <div class="col-lg-2"><label for="jenis_mobil">Jenis Mobil :</label></div>
                <div class="col-lg-2">
                    <select name="jenis_mobil" id="jenis_mobil">
                        <option value="">-Pilih Mobil-</option>
                        <?php

                        for ($a = 0; $a < sizeof($jenis_mobil); $a++) {
                            echo ("<option value=$jenis_mobil[$a].<br>" . $jenis_mobil[$a]);
                        }

                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2"><label for="jarak">Jarak (KM):</label></div>
                <div class="col-lg-2"><input type="text" id="jarak" name="jarak"></div>
            </div>
            <div class="row">
                <div class="col-lg-2"><button class="btn btn-primary" type="submit" value="pesan" name="Pesan">Pesan</button></div>
                <div class="col-lg-2"></div>
            </div>
        </form>
    </div>

    <?php

    if (isset($_POST['Pesan'])) {
        $jarak = $_POST['jarak'];

        $dataPemesanan = array(
            "nama" => $_POST['nama'],
            "no_hp" => $_POST['no_hp'],
            "jenis_mobil" => $_POST['jenis_mobil'],
            "jarak" => $_POST['jarak'],
        );

        $berkas = "dataPesan.json";
        $dataJson = json_encode($dataPemesanan, JSON_PRETTY_PRINT);
        file_put_contents($berkas, $dataJson);
        $dataJson = file_get_contents($berkas);
        $dataPemesanan = json_decode($dataJson, true);
        
        echo "
        <br/> 
        <div class='container'>
            <div class='row'>
                <div class='col-sm-4'>Nama : " . $dataPemesanan['nama'] . "</div>
            </div>
            <div class='row'>
                <div class='col-sm-4'>No HP : " . $dataPemesanan['no_hp'] . "</div>
            </div>
            <div class='row'>
                <div class='col-sm-4'>Jenis Mobil : " . $dataPemesanan['jenis_mobil'] . "</div>
            </div>
            <div class='row'>
                <div class='col-sm-4'>Jarak :" . $dataPemesanan['jarak'] . "</div>
            </div>
            <div class='row'>
                <div class='col-sm-4'>Total Tagihan :" .total_tagihan($jarak). "</div>
            </div>
        </div>
        ";
    }
    ?>

    <?php
            function total_tagihan($jarak)
            {
                if ($jarak <= 10) {
                    $total_tagihan = $jarak * 1000;
                } else {
                    $jarak_selanjutnya = $jarak - 10;
                    $total_tagihan = (10 * 1000) + ($jarak_selanjutnya * 5000);
                }
                
                return $total_tagihan;
            }
    ?>

</body>

</html>