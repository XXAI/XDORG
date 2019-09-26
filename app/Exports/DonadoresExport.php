<?php

namespace App\Exports;

use App\Models\Donador;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class DonadoresExport implements FromQuery, WithHeadings, WithColumnFormatting, WithMapping, ShouldAutoSize
{
    use Exportable;

    public function __construct($params){
        $this->params = $params;
    }

    public function headings(): array{
        return [
            'ID',                       //A
            'Nombre Completo',          //B
            'Fecha de Nacimiento',      //C
            'CURP',                     //D
            'Genero',                   //E
            'Estado',                   //F
            'Ciudad',                   //G
            'Código Postal',            //H
            'Correo Electronico',       //I
            'Télefono de Contacto',     //J
            'Fecha de Registro'         //K
        ];
    }

    public function columnFormats(): array{
        return [
            'C' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH,
            'H' => NumberFormat::FORMAT_TEXT,
            'J' => NumberFormat::FORMAT_TEXT,
            'K' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH,
        ];
    }

    public function map($donador): array{
        return [
            $donador->id,
            $donador->nombre_completo,
            Date::stringToExcel($donador->fecha_nacimiento),
            $donador->curp,
            $donador->genero,
            $donador->estado,
            $donador->ciudad,
            $donador->codigo_postal,
            $donador->email,
            $donador->telefono_contacto,
            Date::stringToExcel($donador->created_at),
        ];
    }

    public function query(){
        $lista_donadores = Donador::query()->conEstado();

        if(isset($this->params['tipo_genero']) && $this->params['tipo_genero']){
            $lista_donadores = $lista_donadores->where('genero',$this->params['tipo_genero']);
        }

        if(isset($this->params['buscar']) && $this->params['buscar']){
            $query_busqueda = $this->params['buscar'];
            $lista_donadores = $lista_donadores->where(function($query)use($query_busqueda){
                $query->where('donadores.nombre','like','%'.$query_busqueda.'%')
                        ->orWhere('a_paterno','like','%'.$query_busqueda.'%')
                        ->orWhere('a_materno','like','%'.$query_busqueda.'%')
                        ->orWhere('ciudad','like','%'.$query_busqueda.'%')
                        ->orWhere('codigo_postal','like','%'.$query_busqueda.'%')
                        ->orWhere('curp','like','%'.$query_busqueda.'%');
            });
        }

        return $lista_donadores;
        //return Donador::query()->conEstado();
    }

}
