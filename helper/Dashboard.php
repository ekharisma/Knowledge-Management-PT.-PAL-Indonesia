<?php
class Dashboard
{
    public static function yearController($year)
    {
        require('../config/db_sql.php');
        $sql = "SELECT COUNT(*) as jumlah FROM tb_berkas WHERE tanggal LIKE ?";
        $stmt = $mysqli->prepare($sql);
        $dataPerBulan = array();
        if ($year == "2020") {
            $bulan = [
                '2020-01%', '2020-02%', '2020-03%', '2020-04%', '2020-05%', '2020-06%', '2020-07%', '2020-08%',
                '2020-09%', '2020-10%', '2020-11%', '2020-12%'
            ];
            for ($i = 0; $i < 12; $i++) {
                $tempBulan = $bulan[$i];
                $stmt->bind_param('s', $tempBulan);
                $stmt->execute();
                $data = $stmt->get_result()->fetch_assoc();
                $dataPerBulan[$i] = $data;
            }
            echo json_encode($dataPerBulan);
        } else if ($year == "2019") {
            $bulan = [
                '2019-01%', '2019-02%', '2019-03%', '2019-04%', '2019-05%', '2019-06%', '2019-07%', '2019-08%',
                '2019-09%', '2019-10%', '2019-11%', '2019-12%'
            ];
            for ($i = 0; $i < 12; $i++) {
                $tempBulan = $bulan[$i];
                $stmt->bind_param('s', $tempBulan);
                $stmt->execute();
                $data = $stmt->get_result()->fetch_assoc();
                $dataPerBulan[$i] = $data;
            }
            echo json_encode($dataPerBulan);
        }
    }
}


if (isset($_GET['year'])) {
    Dashboard::yearController($_GET['year']);
    unset($_GET['year']);
}
