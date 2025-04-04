<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Acces\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests, ValidatesRequests;
    public function __construct()
    {
        $genre = \DB::select("SELECT genres.nama, COUNT(*) as 'count' FROM `listfilms`
        INNER JOIN `genres` ON genres.id = listfilms.genre_id
        GROUP BY nama;");
        $jenis = \DB::select("SELECT jenis.nama, COUNT(*) as 'count' FROM `listfilms`
        INNER JOIN `jenis` ON jenis.id = listfilms.jenis_id
        GROUP BY nama;");
        // dd($genre);
        view()->share([
            'genre_grafik' => $genre,
            'jenis_grafik' => $jenis
        ]);
    }
}
