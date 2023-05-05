<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Estilo;
use App\Services\Admin\{
	Cssparser
};

class EstiloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()  
    {
        $this->middleware('auth');
        $this->middleware('can:admin.estilos.index');

    }

    public function index()
    {
        //
        $estilos = Estilo::get_Estilos();

        return view('admin.modules.estilos', compact('estilos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return redirect('/admin/404');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->ajax()):
            return redirect('/admin/estilos');
        endif;
        // // $cssfile = '{{asset("assets/css/style.css")}}';
        // $parser = new \Sabberworm\CSS\Parser(file_get_contents("{{asset('assets/css/style.css')}}"));

        // var_dump($cssfile);

        // $file = file_get_contents("assets/css/style.css");
        // return $file;exit;
        $css = new CSSParser();

        $file = "assets/css/custom-styles.css";

        $index = $css->ParseCSS('');
        // $css = new CSSParser();
        // // Read the css
        // $data = file_get_contents('assets/css/style.css');
        // // Add the css data to the parser
        // $cssIndex = $css->ParseCSS($data);
        // // Print out the more effective css
        // echo "<pre>";
        // echo $css->GetCSS($cssIndex);
        // echo "</pre>";
        
        foreach($request->valor as $k => $y)
        {
            $value = $y[0];
            $estilo = Estilo::find($k);
            $elemento = $estilo->elemento;
            $propiedad = $estilo->propiedad;
            // $settings = "'".$elemento."{\nfont-family: Helvetica;\n}";
            // $parser = new \Sabberworm\CSS\Parser(file_get_contents("assets/css/style.css"));
            // $cssDocument = $parser->parse($settings);

            // print $cssDocument->render();
            $data = [
                "valor" => $value,
                 "usuario_modifica" => $request->usuario,
                 "fecha_modifica" => now()
            ];
            
            $estilo->update($data);

            $css->AddProperty($index, 'screen',$elemento, $propiedad,$value.' !important');
        }

        $output = $css->GetCSS($index);
        
        if(file_put_contents($file,$output)):
            return response()->json(['msg'=>'sucess', 'code' => '200', 'url'=>url('/admin/estilos')]);
        else:
            return response()->json(['errors'=>$validator->errors(), 'code' => '425']);
        endif;

        //  if(file_put_contents($file,$output, FILE_APPEND)):
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return redirect('/admin/404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return redirect('/admin/404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        return redirect('/admin/404');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return redirect('/admin/404');
    }
}
