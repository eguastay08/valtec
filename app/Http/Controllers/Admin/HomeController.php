<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Validator;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Tag;
use App\Models\User;
use App\Models\Banner;
use App\Models\Slider;

class HomeController extends Controller
{
    //
    public function __construct()  
    {
        $this->middleware('auth');
    }

    public function getDashboard()
    {
        $nrocategorias = Categoria::where('oculto',0)->get()->count();
        $nroProductos = Producto::where('oculto',0)->get()->count();
        $nroTags = Tag::where('oculto',0)->get()->count();
        $nroUsers = User::where('oculto',0)->get()->count();
        $nroSliders = Slider::where('oculto',0)->get()->count();
        $nroBanners = Banner::where('oculto',0)->get()->count();

        return view('admin.dashboard', compact('nrocategorias','nroProductos','nroTags', 'nroUsers', 'nroSliders', 'nroBanners'));
    }

    public function get404AdminNotFound()
    {
        return view('admin.404');
    }
}
