<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Area;
use App\Models\SoftwarePredeterminado;
use App\Models\SoftwareEspecializado;
use App\Models\DetalleSoftware;
use App\Models\TipoLicencia;
use App\Models\TipoArea;
use App\Models\Subentidad;

use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use phpDocumentor\Reflection\Types\This;

class Requerimiento extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $codigo, $numpc,$software,$año,$version,$tipolc,$descripcion;
    public $precio,$observacion,$cotizacion,$cantidad,$nombresf,$id_software;
    public $abrirmodal=false;
    public $totalpc,$tipoarea,$buscar;
    public $creararea=true;
    public $verarea=true;
    public $versoftware=false;
    public $verreq=false;
    public $id_subentidad;
    protected $listeners = ['eliminararea','eliminarsoftware'];

    protected $rulesArea=[
        'tipoarea'=>'required',
        'codigo'=>'required',
        'numpc'=>'required|integer',
    ];
    protected $rulesSoftware=[
        'software'=>'required',
        'año'=>'required|integer',
        'version'=>'required',
        'tipolc'=>'required',
        'descripcion'=>'required',
    ];
    protected $rulesRequerimiento=[
        'precio'=>'required|numeric|between:0.01,9999999.99',
        'id_software'=>'required',
    ];
    protected $msjError=[
        'tipoarea.required'=>'El campo Tipo de Area es obligatorio',
        'codigo.required'=>'El campo Codigo es obligatorio',
        'numpc.required'=>'El campo Numero de PCs es obligtorio',
        'numpc.integer'=>'El campo Numero de PCs debe ser numérico',
        'software.required'=>'Debe indicar el Nombre del Software',
        'año.required'=>'El campo Año es obligatorio',
        'año.integer'=>'El campo Año debe ser numérico',
        'version.required'=>'El campo Versión es obligatorio',
        'tipolc.required'=>'El campo Tipo de Licencia es obligatorio',
        'descripcion.required'=>'El campo Descripcion es obligatorio',
        'precio.required'=>'El campo Precio Referencial es obligatorio',
        'precio.numeric'=>'El campo Precio Referencial debe ser numérico',
        'precio.between'=>'El campo Precio Referencial debe ser un precio válido',
        'id_software.required'=>'Debe seleccionar un Software.'
    ];

    public function mount()
    {
        $this->id_subentidad=request('id');
    }

    public function render()
    {
        $this->totalpc=Area::where('subentidad_id',$this->id_subentidad)->sum('num_pc');;
        $areas=Area::where('subentidad_id',$this->id_subentidad)->get();
        $sftpredeterminado=SoftwarePredeterminado::all();
        $sftespecializado=SoftwareEspecializado::where('nombre','like','%'.$this->buscar.'%')->orderBy('id', 'desc')->paginate(10);
        
        $requerimientos=DetalleSoftware::where('subentidad_id',$this->id_subentidad)->get();
        $tipolicencias=TipoLicencia::all();
        $tipoareas=TipoArea::all();
        return view('livewire.requerimiento.view',compact('areas','sftpredeterminado','sftespecializado','requerimientos','tipolicencias','tipoareas'));
    }

    public function limpiar()
    {
        $this->codigo=null;
        $this->numpc=null;
        $this->software=null;
        $this->año=null;
        $this->version=null;
        $this->tipolc=null;
        $this->descripcion=null;
        $this->precio=null;
        $this->observacion=null;
        $this->cotizacion=null;
        $this->nombresf=null;
        $this->id_software=null;
        $this->tipoarea=1;
    }

    public function creararea()
    {
        $this->abrirmodal=true;
        $this->creararea=true;
    }
    
    public function crearsoftware()
    {
        $this->abrirmodal=true;
        $this->creararea=false;
    }
    public function area()
    {
        $this->verarea=true;
        $this->versoftware=false;
        $this->verreq=false;
    }
    public function software()
    {
        $this->verarea=false;
        $this->versoftware=true;
        $this->verreq=false;
    }

    public function requerimiento()
    {
        $this->verarea=false;
        $this->versoftware=false;
        $this->verreq=true;
    }
    
    public function cancel()
    {
        $this->abrirmodal=false;
        $this->limpiar();
    }

    public function seleccion($id)
    {
        $sfe = SoftwareEspecializado::find($id);
        $this->nombresf=$sfe->nombre;
        $this->id_software=$id;
        $this->creararea=false;
    }

    public function storeArea()
    {
        
        if($this->creararea){
            $this->validate($this->rulesArea,$this->msjError);
            if(Area::where('codigo',$this->codigo)->where('subentidad_id',$this->id_subentidad)->doesntExist()){
                $creado = Area::create([
                    'codigo' => $this->codigo,
                    'num_pc' => $this->numpc,
                    'tipo_id' => $this->tipoarea,
                    'subentidad_id' => $this->id_subentidad
                ]);
                
                if (isset($creado)) {
                    if(!(DetalleSoftware::where('subentidad_id',$this->id_subentidad)->doesntExist())){
                        DetalleSoftware::where('subentidad_id',$this->id_subentidad)->update(['cantidad' => ($this->totalpc+$this->numpc)]);
                    }
                    
                    $datos = [
                        'modo' => 'bg-success',
                        'mensaje' => 'Registro creada satisfactoriamente.'
                    ];
                    $this->limpiar();
                    $this->abrirmodal = false;
                } else {
                    $datos = [
                        'modo' => 'bg-danger',
                        'mensaje' => 'Error! No se creo el registro.'
                    ];
                }

            }else{
                $datos = [
                    'modo' => 'bg-warning',
                    'mensaje' => 'El area ya se encuetra Registrado.'
                ];

            }
        }else{
            $this->validate($this->rulesSoftware,$this->msjError);
            $sfcreado = SoftwareEspecializado::create([
                'nombre' => $this->software,
                'año' => $this->año,
                'version' => $this->version,
                'caracteristicas' => $this->descripcion,
                'tipo_licencia_id'=> $this->tipolc
            ]);
            if (isset($sfcreado)) {
                $datos = [
                    'modo' => 'bg-success',
                    'mensaje' => 'Registro creada satisfactoriamente.'
                ];
                $this->limpiar();
                $this->abrirmodal = false;
            } else {
                $datos = [
                    'modo' => 'bg-danger',
                    'mensaje' => 'Error! No se creo el registro.'
                ];
            }
                        
        }
        
        $this->emit('alertaArea', $datos);
    }

    public function registrar()
    {
        $this->validate($this->rulesRequerimiento,$this->msjError);
        if(DetalleSoftware::where('sft_especializado_id',$this->id_software)->where('subentidad_id',$this->id_subentidad)->doesntExist()){
            if (is_null($this->cotizacion)) {
                $url = null;
            } else {
                $archivo = $this->cotizacion->store('public/cotizaciones');
                $url = Storage::url($archivo);
            }
            $creado = DetalleSoftware::create([
                'precio_referencial' => $this->precio,
                'cotizacion' => $url,
                'observacion' => $this->observacion,
                'cantidad' => $this->totalpc,
                'sft_especializado_id' => $this->id_software,
                'subentidad_id' => $this->id_subentidad
            ]);
            if (isset($creado)) {
                $datos = [
                    'modo' => 'bg-success',
                    'mensaje' => 'Registro creada satisfactoriamente.'
                ];
                $this->limpiar();
            } else {
                $datos = [
                    'modo' => 'bg-danger',
                    'mensaje' => 'Error! No se creo el registro.'
                ];
            }
        }else{
            $datos = [
                'modo' => 'bg-warning',
                'mensaje' => 'El software ya esta registrado en el Requerimiento.'
            ];
            $this->limpiar();
        }
        
        $this->emit('alertaArea', $datos);

    }

    public function eliminararea($idarea)
    {
        if(DetalleSoftware::where('subentidad_id',$this->id_subentidad)->doesntExist())
        {
            Area::destroy($idarea);
            $datos = [
                'modo' => 'bg-success',
                'mensaje' => 'Se elimino el registro del sistema.'
            ];
            
        }else{
            $dtoarea=Area::where('id',$idarea)->first();
            Area::destroy($idarea);
            if (($this->totalpc-$dtoarea->num_pc)==0) {
                DetalleSoftware::where('subentidad_id',$this->id_subentidad)->delete();
                $datos = [
                    'modo' => 'bg-success',
                    'mensaje' => 'Se elimino el registro del sistema.'
                ];
            } else {
                
                DetalleSoftware::where('subentidad_id',$this->id_subentidad)->update(['cantidad' => ($this->totalpc-$dtoarea->num_pc)]);
                
                $datos = [
                    'modo' => 'bg-success',
                    'mensaje' => 'Se elimino el registro del sistema.'
                ];
            }
            
            
        }
        $this->emit('alertaArea', $datos);
    }

    public function eliminarsoftware($idsoftware)
    {
        DetalleSoftware::destroy($idsoftware);
        $datos = [
            'modo' => 'bg-success',
            'mensaje' => 'Se elimino el Software del Requerimiento.'
        ];
        $this->emit('alertaArea', $datos);
    }

    public function vistoBueno($id){
        Subentidad::where('id',$id)->update(['estado' => 1]);
        $this->creararea=true;
        $datos = [
            'modo' => 'bg-success',
            'mensaje' => 'Se dio Visto Bueno al Requerimiento'
        ];
        $this->emit('alertaArea', $datos);
    }

}
