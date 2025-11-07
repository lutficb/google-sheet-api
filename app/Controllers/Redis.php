<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataSantriModel;
use Exception;
use Predis\Client;

use function PHPSTORM_META\type;

class Redis extends BaseController
{
    protected $dataModel;
    protected $redis;

    public function __construct()
    {
        $this->dataModel = new DataSantriModel();
        $this->redis = new Client(array(
            'scheme'   => 'tcp',
            'host'     => 'localhost',
            'port'     => 6379,
            'database' => 15
        ));
    }

    public function index()
    {
        // Try store data from google sheet to redis dcache
        try {
            // get data from google sheet and save to redis
            $dataSantri = $this->dataModel->fetchDataFromGoogleSheet('1boWrAxm6N9I91ZpPShnjm8KopWTSsWwjN-okUZzIVbk', '2026/2027');

            // Get data santri from Google Sheet
            $dataWali = $this->dataModel->fetchDataFromGoogleSheet('16LXFhZRbaFbGSxtyRotHY_AUSNMXdXYCe_zcXfxGp-U', '2026/2027');

            // get total santri and add to redis
            $totalSantri = count($dataSantri);
            $this->redis->set('Total Santri', $totalSantri);

            // get total wali and add to redis
            $totalWali = count($dataWali);
            $this->redis->set('Total Wali', $totalWali);

            // Add data santri to Hash redis using json
            for ($i = 0; $i < $totalSantri; $i++) {
                $json = json_encode($dataSantri[$i]);
                $this->redis->hset('santri', $i + 1, $json);
            }

            // Add data wali to Hash redis using json
            for ($j = 0; $j < $totalWali; $j++) {
                $jsonw = json_encode($dataWali[$j]);
                $this->redis->hset('wali', $j + 1, $jsonw);
            }

            // dd($this->redis->hget('santri', 98));

            // If success saving to redis
            print_r('Cache berhasil disetting');
        } catch (Exception $e) {
            // If error then print teh error
            die($e->getMessage());
        }
    }

    public function cobaRedis()
    {
        try {
            $totalSantri = $this->redis->get('Total Wali');

            $santri = [];
            for ($n = 0; $n < $totalSantri; $n++) {
                $user = $this->redis->hget('wali', $n + 1);
                $json = json_decode($user);
                $santri[$n] = (array)$json;
            }

            // dd($santri);

            // dd($santriList);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function deleteRedis()
    {
        try {
            $this->redis->del('santri');
            $this->redis->del('Total Santri');
            $this->redis->del('wali');
            $this->redis->del('Total Wali');

            echo 'Data di redis berhasil dihapus';
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
