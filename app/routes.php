<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Illuminate\Database\Capsule\Manager as DB;

return function (App $app) {
    // $app->options('/{routes:.*}', function (Request $request, Response $response) {
    //     // CORS Pre-Flight OPTIONS Request Handler
    //     return $response;
    // });


    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    $app->get('/get-user-name', function (Request $request, Response $response) {
        $user = DB::table('users')->first();
        $response->getBody()->write(json_encode($user));
        return $response->withHeader('Content-Type', 'application/json');

    });


    $app->get('/health', function ($request, $response) {
        $data = [
            'status' => 'ok',
            'message' => 'API is running',
            'aku_suka' => 'ikan'
        ];

        $user = DB::table('users')->get();

        $payload = array_merge($data, ['user' => $user->toArray()]);

        $response->getBody()->write(json_encode($payload));
        return $response->withHeader('Content-Type', 'application/json');
    });


    //NO 1 
    $app->get('/no_1', function (Request $request, Response $response) {

        $data = [
            "tanggal" => "2023-12-05",
            "total_biaya" => 2000000,
            "status" => "Disetujui",
            "items" => [
                [
                    "nama_item" => "Kertas HVS",
                    "jumlah" => 10,
                    "satuan" => "pak"
                ],
                [
                    "nama_item" => "Tinta Printer",
                    "jumlah" => 5,
                    "satuan" => "kotak"
                ]
            ]
        ];
    
        $response->getBody()->write(json_encode($data));

        return $response->withHeader('Content-Type', 'application/json');
    });

    //NO 2
    $app->get('/no_2', function (Request $request, Response $response) {
        $data = [
            "tanggal" => "2023-12-05",
            "penanggung_jawab" => "Budi",
            "kendaraan" => [
                "plat_nomor" => "B 1234 ABC",
                "rincian_biaya" => [
                    "ganti_oli" => 500000,
                    "ganti_ban" => 3000000
                ]
            ],
            "total_biaya" => 3500000
        ];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    });

    //NO 3

    $app->get('/no_3', function (Request $request, Response $response){
        $data =  ["peserta" => [
            [
                "nama" => "Andi",
                "biaya_tiket" => 1500000
            ],
            [
                "nama" => "Sinta",
                "biaya_tiket" => 1500000
            ]
        ],
        "total_anggaran" => 3000000
    ];
    
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/no_4', function (Request $request, Response $response){
        $pagu_tahunan = 100000000;
        $total_realisasi_sebelumnya = 85000000;
        $pengajuan_baru = 10000000;

        $anggaran_mencukupi = 
            ($total_realisasi_sebelumnya + $pengajuan_baru) <= $pagu_tahunan;

        $data = [
            "pagu_tahunan" => $pagu_tahunan,
            "total_realisasi_sebelumnya" => $total_realisasi_sebelumnya,
            "pengajuan_baru" => $pengajuan_baru,
            "anggaran_mencukupi" => $anggaran_mencukupi
        ];

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    });


    $app->get('/no_5', function (Request $request, Response $response){
            $data = [
            "pembuat_laporan" => "Admin Pusat",
            "tanggal_laporan" => "2024-12-31",
            "divisi" => [
                [
                    "nama_divisi" => "HR",
                    "pengajuan" => "Gathering",
                    "biaya" => 20000000,
                    "status" => "Pending"
                ],
                [
                    "nama_divisi" => "IT",
                    "pengajuan" => "Server",
                    "biaya" => 50000000,
                    "status" => "Approved"
                ]
            ]
        ];

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    });



    


    

    


};
