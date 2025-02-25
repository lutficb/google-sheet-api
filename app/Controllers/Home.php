<?php

namespace App\Controllers;

use App\Models\DataSantriModel;
use Google\Service\PeopleService\Biography;
use TCPDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;
use Predis\Client;

use function PHPSTORM_META\type;

class Home extends BaseController
{
    protected $dataSantriModel;
    protected $redis;

    function __construct()
    {
        $this->dataSantriModel = new DataSantriModel();
        $this->redis = new Client(array(
            'scheme'   => 'tcp',
            'host'     => 'localhost',
            'port'     => 6379,
            'database' => 15
        ));
    }

    public function index(): string
    {
        $data = [
            'title' => 'Rekap Data Wawancara',
        ];
        return view('welcome_message', $data);
    }

    public function checklist()
    {
        // Get data from google sheet
        $peserta = $this->dataSantriModel->fetchDataFromGoogleSheet('1SDi15YgmbSxj2mreg3OYIPm9YJepUnPbtAesWsE0Q9M', 'Sheet1');

        // Get data wawancara santri
        $dataSantri = $this->dataSantriModel->fetchDataFromGoogleSheet('1boWrAxm6N9I91ZpPShnjm8KopWTSsWwjN-okUZzIVbk', 'Form Responses 1');

        // Get data wawancara wali
        $dataWali = $this->dataSantriModel->fetchDataFromGoogleSheet('16LXFhZRbaFbGSxtyRotHY_AUSNMXdXYCe_zcXfxGp-U', 'Form Responses 1');

        // Count length of array
        $pesertaLenght = count($peserta);

        // Get name and NISN
        $checklist = [];
        for ($i = 0; $i <= $pesertaLenght - 1; $i++) {
            $checklist[$i]['nama'] = $peserta[$i]['nama'];
            $checklist[$i]['nisn'] = $peserta[$i]['nisn'];

            $keysantri = array_search($peserta[$i]['nisn'], array_column($dataSantri, 'NISN'));
            ($keysantri) ? $checklist[$i]['santri'] = 'OK' : $checklist[$i]['santri'] = '';

            $keywali = array_search($peserta[$i]['nisn'], array_column($dataWali, 'NISN'));
            ($keywali) ? $checklist[$i]['wali'] = 'OK' : $checklist[$i]['wali'] = '';
        }

        $data = [
            'title' => 'Checklist Pengisian',
            'checklist' => $checklist,
            'length' => count($checklist),
        ];

        return view('checklist', $data);
    }

    public function getSheetDataSantri()
    {
        try {
            // Get data santri from Redis
            $totalSantri = $this->redis->get('Total Santri');

            $dataSantri = [];
            for ($n = 0; $n < $totalSantri; $n++) {
                $user = $this->redis->hget('santri', $n + 1);
                $json = json_decode($user);
                $dataSantri[$n] = (array)$json;
            }

            // Count length of array data santri
            $arraylength = count($dataSantri);

            // Data for view
            $data = [
                'title' => 'Data Santri',
                'data' => $dataSantri,
                'long' => $arraylength,
            ];

            return view('data-santri', $data);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getSheetDataWali()
    {
        try {
            // Get data wali from redis
            $totalWali = $this->redis->get('Total Wali');

            $dataWali = [];
            for ($i = 0; $i < $totalWali; $i++) {
                $jsonw = json_decode($this->redis->hget('wali', $i + 1));
                $dataWali[$i] = (array)$jsonw;
            }

            // dd($dataWali);

            // Count length of array data santri
            $arraylength = count($dataWali);

            // Data for view
            $data = [
                'title' => 'Data Wali',
                'data' => $dataWali,
                'long' => $arraylength,
            ];

            // dd($dataSantri);

            return view('data-wali', $data);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function detailHalamanSantri($num)
    {
        // Get data wali from redis
        $totalSantri = $this->redis->get('Total Santri');

        $datSantri = [];
        for ($n = 0; $n < $totalSantri; $n++) {
            $user = $this->redis->hget('santri', $n + 1);
            $json = json_decode($user);
            $dataSantri[$n] = (array)$json;
        }

        // Key search
        $key = array_search($num, array_column($dataSantri, 'NISN'));

        // Get data santri individu
        $dataIndividu = $dataSantri[$key];

        // Count length
        $count = count($dataIndividu);

        // Separate key and value
        $pertanyaan = array_keys($dataIndividu);
        $jawaban = array_values($dataIndividu);

        $biodata = [];
        $isiJawaban = [];

        // Insert data to biodata array
        for ($i = 0; $i <= 7; $i++) {
            $biodata[$pertanyaan[$i]] = $jawaban[$i];
        }

        // Insert data to isiJawaban array
        for ($j = 8; $j <= $count - 1; $j++) {
            $isiJawaban[$pertanyaan[$j]] = $jawaban[$j];
        }

        $data = [
            'title' => 'Detail Santri',
            'biodata' => $biodata,
            'jawaban' => $isiJawaban,
        ];

        return view('detail-santri', $data);
    }

    public function detailHalamanWali($num)
    {
        // Get data wali from redis
        $totalWali = $this->redis->get('Total Wali');

        $dataWali = [];
        for ($i = 0; $i < $totalWali; $i++) {
            $jsonw = json_decode($this->redis->hget('wali', $i + 1));
            $dataWali[$i] = (array)$jsonw;
        }

        // Key search
        $key = array_search($num, array_column($dataWali, 'NISN'));

        // Get data santri individu
        $dataIndividu = $dataWali[$key];

        // dd($dataIndividu);

        // Count length
        $count = count($dataIndividu);

        // Separate key and value
        $pertanyaan = array_keys($dataIndividu);
        $jawaban = array_values($dataIndividu);

        $biodata = [];
        $isiJawaban = [];

        // Insert data to biodata array
        for ($i = 0; $i <= 8; $i++) {
            $biodata[$pertanyaan[$i]] = $jawaban[$i];
        }

        // Insert data to isiJawaban array
        for ($j = 9; $j <= $count - 1; $j++) {
            $isiJawaban[$pertanyaan[$j]] = $jawaban[$j];
        }

        $data = [
            'title' => 'Detail Wali',
            'biodata' => $biodata,
            'jawaban' => $isiJawaban,
        ];

        return view('detail-wali', $data);
    }

    public function cetakDataSantri($nisn)
    {
        // Get data santri from Google Sheet
        $totalSantri = $this->redis->get('Total Santri');

        $datSantri = [];
        for ($n = 0; $n < $totalSantri; $n++) {
            $user = $this->redis->hget('santri', $n + 1);
            $json = json_decode($user);
            $dataSantri[$n] = (array)$json;
        }

        // Key search
        $key = array_search($nisn, array_column($dataSantri, 'NISN'));

        // Get data santri individu
        $dataIndividu = $dataSantri[$key];

        // dd($dataIndividu);

        // Count length
        $count = count($dataIndividu);

        // // Separate key and value
        $pertanyaan = array_keys($dataIndividu);
        $jawaban = array_values($dataIndividu);

        $biodata = [];
        $isiJawaban = [];

        // Insert data to biodata array
        for ($i = 0; $i <= 7; $i++) {
            $biodata[$pertanyaan[$i]] = $jawaban[$i];
        }

        // // Insert data to isiJawaban array
        for ($j = 8; $j <= $count - 1; $j++) {
            $isiJawaban[$pertanyaan[$j]] = $jawaban[$j];
        }

        $data = [
            'title' => 'Santri - ' . $biodata['Nama Lengkap'],
            'biodata' => $biodata,
            'jawaban' => $isiJawaban,
        ];

        // return view('format-santri', $data);

        $html = view('format-santri', $data);
        $filename = $biodata['Nama Lengkap'];

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($filename);
    }

    public function cetakDataWali($nisn)
    {
        // Get data wali from redis
        $totalWali = $this->redis->get('Total Wali');

        $dataWali = [];
        for ($i = 0; $i < $totalWali; $i++) {
            $jsonw = json_decode($this->redis->hget('wali', $i + 1));
            $dataWali[$i] = (array)$jsonw;
        }

        // Key search
        $key = array_search($nisn, array_column($dataWali, 'NISN'));

        // Get data santri individu
        $dataIndividu = $dataWali[$key];

        // dd($dataIndividu);

        // Count length
        $count = count($dataIndividu);

        // // Separate key and value
        $pertanyaan = array_keys($dataIndividu);
        $jawaban = array_values($dataIndividu);

        $biodata = [];
        $isiJawaban = [];

        // Insert data to biodata array
        for ($i = 0; $i <= 8; $i++) {
            $biodata[$pertanyaan[$i]] = $jawaban[$i];
        }

        // // Insert data to isiJawaban array
        for ($j = 9; $j <= $count - 1; $j++) {
            $isiJawaban[$pertanyaan[$j]] = $jawaban[$j];
        }

        $data = [
            'title' => 'Wali - ' . $biodata['Nama Putra/Putri'],
            'biodata' => $biodata,
            'jawaban' => $isiJawaban,
        ];

        // return view('format-santri', $data);

        $html = view('format-wali', $data);
        $filename = 'Wali-' . $biodata['Nama Putra/Putri'];

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($filename);
    }

    public function getPriaIbu()
    {
        // Get data santri
        $dataSantri = $this->dataSantriModel->fetchDataFromGoogleSheet('1boWrAxm6N9I91ZpPShnjm8KopWTSsWwjN-okUZzIVbk', 'Form Responses 1');

        // Get data wali from Google Sheet
        $dataWali = $this->dataSantriModel->fetchDataFromGoogleSheet('16LXFhZRbaFbGSxtyRotHY_AUSNMXdXYCe_zcXfxGp-U', 'Form Responses 1');

        // Get santri that laki-laki
        $key = array_keys(array_column($dataSantri, 'Jenis Kelamin'), 'Laki - Laki');

        // Name and NISN
        $tempResult = [];

        foreach ($key as $k => $v) {
            $tempResult[$k]['Nama'] = $dataSantri[$v]['Nama Lengkap'];
            $tempResult[$k]['NISN'] = $dataSantri[$v]['NISN'];
        }

        // dd($tempResult);

        $finalResult = [];

        foreach ($tempResult as $kn => $vl) {
            $kunci = array_search($tempResult[$kn]['NISN'], array_column($dataWali, 'NISN'));

            $finalResult[$kn]['Nama'] = $dataWali[$kunci]['Nama Putra/Putri'];
            $finalResult[$kn]['Pengisi'] = $dataWali[$kunci]['Status yang mengisi formulir ini dan yang diwawancarai adalah ? (Yang mengisi wajib hadir di lokasi test, Pondok Pesantren Imam Syafi\'i Tulungagung, saat hari pelaksanaan, Ahad, 10 November 2024.'];
        }

        $long = count($finalResult);

        $data = [
            'title' => 'Pria tapi Ibu',
            'data' => $finalResult,
            'long' => $long
        ];

        return view('pria-ibu', $data);
    }

    public function getPerempuanAyah()
    {
        // Get data santri
        $dataSantri = $this->dataSantriModel->fetchDataFromGoogleSheet('1boWrAxm6N9I91ZpPShnjm8KopWTSsWwjN-okUZzIVbk', 'Form Responses 1');

        // Get data wali from Google Sheet
        $dataWali = $this->dataSantriModel->fetchDataFromGoogleSheet('16LXFhZRbaFbGSxtyRotHY_AUSNMXdXYCe_zcXfxGp-U', 'Form Responses 1');

        // Get santri that laki-laki
        $key = array_keys(array_column($dataSantri, 'Jenis Kelamin'), 'Perempuan');

        // Name and NISN
        $tempResult = [];

        foreach ($key as $k => $v) {
            $tempResult[$k]['Nama'] = $dataSantri[$v]['Nama Lengkap'];
            $tempResult[$k]['NISN'] = $dataSantri[$v]['NISN'];
        }

        // dd($tempResult);

        $finalResult = [];

        foreach ($tempResult as $kn => $vl) {
            $kunci = array_search($tempResult[$kn]['NISN'], array_column($dataWali, 'NISN'));

            $finalResult[$kn]['Nama'] = $dataWali[$kunci]['Nama Putra/Putri'];
            $finalResult[$kn]['Pengisi'] = $dataWali[$kunci]['Status yang mengisi formulir ini dan yang diwawancarai adalah ? (Yang mengisi wajib hadir di lokasi test, Pondok Pesantren Imam Syafi\'i Tulungagung, saat hari pelaksanaan, Ahad, 10 November 2024.'];
            $finalResult[$kn]['Status'] = $dataWali[$kunci]['Sebutkan Statusnya'];
        }

        $data = [
            'title' => 'Perempuan tapi Ayah',
            'data' => $finalResult,
            'long' => count($finalResult),
        ];

        return view('perempuan-ayah', $data);
    }
}
