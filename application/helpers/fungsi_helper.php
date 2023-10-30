<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function medium_bulan($bln)
{
    switch ($bln)
    {
        case 1:
            return "Jan";
            break;
        case 2:
            return "Feb";
            break;
        case 3:
            return "Mar";
            break;
        case 4:
            return "Apr";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Jun";
            break;
        case 7:
            return "Jul";
            break;
        case 8:
            return "Ags";
            break;
        case 9:
            return "Sep";
            break;
        case 10:
            return "Okt";
            break;
        case 11:
            return "Nov";
            break;
        case 12:
            return "Des";
            break;
    }
}

function longdate_indo($tanggal)
{
    $ubah = gmdate($tanggal, time()+60*60*8);
    $pecah = explode("-",$ubah);
    $tgl = $pecah[2];
    $bln = $pecah[1];
    $thn = $pecah[0];
    // $bulan = bulan($pecah[1]);

    $nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
    $nama_hari = "";
    if($nama=="Sunday") {$nama_hari="Minggu";}
    else if($nama=="Monday") {$nama_hari="Senin";}
    else if($nama=="Tuesday") {$nama_hari="Selasa";}
    else if($nama=="Wednesday") {$nama_hari="Rabu";}
    else if($nama=="Thursday") {$nama_hari="Kamis";}
    else if($nama=="Friday") {$nama_hari="Jumat";}
    else if($nama=="Saturday") {$nama_hari="Sabtu";}
    $bulan = medium_bulan($bln);
    return $nama_hari.', '.$tgl.' '.$bulan.' '.$thn;
}