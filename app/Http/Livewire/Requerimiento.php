<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\SoftwarePredeterminado;
use App\Models\SoftwareEspecializado;
use App\Models\DetalleSoftware;
use App\Models\TipoLicencia;
use App\Models\TipoArea;
use App\Models\Subentidad;
use App\Models\DetalleTipoLicencia;
use App\Models\DetallePeriodicidad;
use App\Models\DetalleRequerimiento;

use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use phpDocumentor\Reflection\Types\This;

class Requerimiento extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $codigo, $numpc,$software,$año,$version,$descripcion;
    public $precio,$observacion,$cotizacion,$cantidad,$tipolc,$periodo,$nombresf,$id_software;

    public $licencias,$periodos;
    public $buscar;
    public $verarea=true;
    public $versoftware=false;
    public $verreq=false;
    public $id_subentidad;
    protected $listeners = ['validarequerimiento','quitarsoftware'];

    protected $rulesSubentidad=[
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
        'cantidad'=>'required|numeric',
        'tipolc'=>'required',
        'periodo'=>'required',
        'cotizacion'=>'required',
        'id_software'=>'required',
        
    ];
    protected $msjError=[
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
        'cantidad.required'=>'El campo Cantidad es obligatorio',
        'cantidad.numeric'=>'El campo Cantidad debe ser numérico',
        'tipolc.required'=>'El campo Tipo de Licencia es obligatorio',
        'periodo.required'=>'El campo Periodo es obligatorio',
        'cotizacion.required'=>'La cotizacion es obligatoria',
        'id_software.required'=>'Debe seleccionar un Software del catalogo'
    ];

    public function mount()
    {
        $this->id_subentidad=request('id');
    }

    public function render()
    {
        $subentidad=Subentidad::where('id',$this->id_subentidad)->first();
           
        $sftpredeterminado=SoftwarePredeterminado::all();
        $sftespecializado=SoftwareEspecializado::where('nombre','like','%'.$this->buscar.'%')->orderBy('id', 'desc')->paginate(10);
        $requerimientos=DetalleRequerimiento::where('subentidad_id',$this->id_subentidad)->get();
        $tipolicencias=TipoLicencia::all();
        return view('livewire.requerimiento.view',compact('subentidad','sftpredeterminado','sftespecializado','requerimientos','tipolicencias'));
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
        $this->periodo=null;
        $this->cantidad=null;
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
        $this->limpiar();
    }

    public function seleccion($id)
    {
        $sfe = SoftwareEspecializado::find($id);

        $this->nombresf=$sfe->nombre;
        // $this->licencias=DetalleSoftware::where('sft_especializado_id',$id)->select('tipo_licencia')->distinct()->get();
        // $this->licencias=DetalleSoftware::join('tipo_licencia','det_software.tipo_licencia_id','tipo_licencia.id')->select('tipo_licencia.id','tipo_licencia.tipo')->distinct()->get();
        $this->licencias=DetalleSoftware::where('sft_especializado_id',$id)->get();
        // $this->periodos=DetallePeriodicidad::where('sft_especializado_id',$id)->get();
        $this->id_software=$id;
        $this->creararea=false;
        $datos = [
            'modo' => 'bg-success',
            'mensaje' => 'Software seleccionado.'
        ];
        $this->emit('alertaArea', $datos);
    }
    public function updatedtipolc($idlc)
    {
        $this->periodos=DetalleSoftware::where('sft_especializado_id',$this->id_software)->where('tipo_licencia_id',$idlc)->get();
    }
    

    public function GuardarPc()
    {
        $this->validate($this->rulesSubentidad,$this->msjError);
        // $=Subentidad::where('id',$this->id_subentidad)->value('num_pc');
        if(DetalleRequerimiento::where('subentidad_id',$this->id_subentidad)->doesntExist()){
            Subentidad::where('id', $this->id_subentidad)->update(['num_pc' => $this->numpc]);
            $datos = [
                'modo' => 'bg-success',
                'mensaje' => 'Registro Actualizado con Exito.'
            ];
        }else{
            $datos = [
                'modo' => 'bg-warning',
                'mensaje' => 'No se puede Modificar, Ya existen 
                Requerimientos Registrados.'
            ];
        }
        $this->limpiar();
        $this->emit('alertaArea', $datos);
    }

    public function registrar()
    {
        $this->validate($this->rulesRequerimiento,$this->msjError);
        $numpcregistrado=Subentidad::where('id',$this->id_subentidad)->value('num_pc');
        $iddetsft=DetalleSoftware::where('sft_especializado_id',$this->id_software)->where('tipo_licencia_id',$this->tipolc)->where('periodo_id',$this->periodo )->value('id');
        
        if(DetalleRequerimiento::join('det_software','requerimiento.det_software_id','det_software.id')->where('requerimiento.subentidad_id',$this->id_subentidad)->where('sft_especializado_id',$this->id_software)->where('det_software.tipo_licencia_id',$this->tipolc)->doesntExist()){
            if(($this->cantidad) <= ($numpcregistrado)){

                 // $name = date('d-m-Y_H-i-s') . '_' . $this->cotizacion->getClientOriginalName();
                 // $this->cotizacion->move('cotizaciones', $name);
                 // $url="public/cotizaciones/".$name;
            
                $archivo = $this->cotizacion->store('public/cotizaciones');
                $url = Storage::url($archivo);
                
                $creado = DetalleRequerimiento::create([
                    'precio_referencial' => $this->precio,
                    'cotizacion' => $url,
                    'observacion' => $this->observacion,
                    'cantidad' => $this->cantidad,
                    'subentidad_id' => $this->id_subentidad,
                    'det_software_id' => $iddetsft,
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
                    'mensaje' => 'La cantidad de licencias excede el numero de PCs'
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

    public function quitarsoftware($idrequerimiento)
    {
        $ruta=str_replace('storage','public',DetalleRequerimiento::where('id',$idrequerimiento)->value('cotizacion'));
        Storage::delete($ruta);
        DetalleRequerimiento::destroy($idrequerimiento);
 
        $datos = [
            'modo' => 'bg-success',
            'mensaje' => 'El software se quito de los requerimientos.',
        ];
        $this->emit('alertaArea', $datos);
    }

    public function validarequerimiento($id)
    {

        Subentidad::where('id',$id)->update(['estado' => 1]);
        $this->creararea=true;
        $datos = [
            'modo' => 'bg-success',
            'mensaje' => 'Se dio Visto Bueno al Requerimiento'
        ];
        $this->emit('alertaArea', $datos);
    }

}
