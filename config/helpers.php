<?php


if (!function_exists('TanggalID')) {

    /**
     * TanggalID
     *
     * @param $format
     * @param mixed $tanggal
     * @param string $bahasa
     * @return false|string|string[]
     */
    function TanggalID($format, $tanggal = "now", $bahasa = "id")
    {
        $en = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
        $id = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Januari", "Pebruari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember");
        // mengganti kata yang berada pada arrayen dengan arrayid, fr (defaultid)

        if (strpos($format, 'H:i') !== false) {
            $jam = $tanggal->format('H:i');
            if ($jam >= '04:00' && $jam < '10:00') {
                $salam = 'pagi';
            } elseif ($jam >= '10:00' && $jam < '15:00') {
                $salam = 'siang';
            } elseif ($jam >= '15:00' && $jam < '18:00') {
                $salam = 'sore';
            } else {
                $salam = 'malam';
            }

            return str_replace($en, $id, date($format, strtotime($tanggal))) . " " . $salam;
        }

        return str_replace($en, $id, date($format, strtotime($tanggal)));
    }
}

if (!function_exists('formatUang')) {

    /**
     * formatUang
     *
     * @param $angka
     * @return string
     */
    function formatUang($angka): string
    {
        return number_format($angka, 0, ',', '.');
    }
}

if (!function_exists('terbilang')) {

    /**
     * terbilang
     *
     * @param $angka
     * @return string
     */
    function terbilang($angka): string
    {
        $angka = abs($angka);
        $baca = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $terbilang = "";
        if ($angka < 12) {
            $terbilang = " " . $baca[$angka];
        } else if ($angka < 20) {
            $terbilang = terbilang($angka - 10) . " belas";
        } else if ($angka < 100) {
            $terbilang = terbilang($angka / 10) . " puluh" . terbilang($angka % 10);
        } else if ($angka < 200) {
            $terbilang = " seratus" . terbilang($angka - 100);
        } else if ($angka < 1000) {
            $terbilang = terbilang($angka / 100) . " ratus" . terbilang($angka % 100);
        } else if ($angka < 2000) {
            $terbilang = " seribu" . terbilang($angka - 1000);
        } else if ($angka < 1000000) {
            $terbilang = terbilang($angka / 1000) . " ribu" . terbilang($angka % 1000);
        } else if ($angka < 1000000000) {
            $terbilang = terbilang($angka / 1000000) . " juta" . terbilang($angka % 1000000);
        }

        return $terbilang;
    }
}