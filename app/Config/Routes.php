<?php

use App\Controllers\Home;
use App\Controllers\Redis;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', [Home::class, 'index']);
$routes->get('data-santri', [Home::class, 'getSheetDataSantri']);
$routes->get('detail-santri/(:segment)', [Home::class, 'detailHalamanSantri']);
$routes->get('coba-pdf', [Home::class, 'cobaPdf']);
$routes->get('data-wali', [Home::class, 'getSheetDataWali']);
$routes->get('detail-wali/(:segment)', [Home::class, 'detailHalamanWali']);
$routes->get('checklist', [Home::class, 'checklist']);
$routes->get('cetak-santri/(:segment)', [Home::class, 'cetakDataSantri']);
$routes->get('cetak-wali/(:segment)', [Home::class, 'cetakDataWali']);
$routes->get('pria-ibu', [Home::class, 'getPriaIbu']);
$routes->get('perempuan-ayah', [Home::class, 'getPerempuanAyah']);


$routes->get('fetch-data-santri', [Redis::class, 'index']);
$routes->get('data-santri-redis', [Redis::class, 'cobaRedis']);
$routes->get('delete-data-redis', [Redis::class, 'deleteRedis']);
