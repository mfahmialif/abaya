<?php
namespace App\Http\Controllers\Home;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Barang;

class LandingPageController extends Controller
{
    public function index()
    {
        $data = Barang::where('kategori','jadi')->get();
        return view('home.landing-page.index',compact('data'));
    }
}
