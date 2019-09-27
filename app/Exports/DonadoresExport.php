<?php

namespace App\Exports;

use App\Models\Donador;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
//use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class DonadoresExport implements FromQuery, WithHeadings, WithColumnFormatting, WithMapping, WithEvents
{
    use Exportable;

    public function __construct($params){
        $this->params = $params;
    }

    public function registerEvents(): array{
        return [
            AfterSheet::class => function (AfterSheet $event){
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(5);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(39);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(19);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(23);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(7);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(9);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(14);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(13);
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(22);
                $event->sheet->getDelegate()->getColumnDimension('J')->setWidth(19);
                $event->sheet->getDelegate()->getColumnDimension('K')->setWidth(16);
            },
        ];
    }

    /*public function drawings(){
        $drawing = new Drawing();
        $drawing->setName('Logo');
        //$drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('images/LOGOS-01.jpg'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('A1');

        $drawing2 = new Drawing();
        $drawing2->setName('Other image');
        //$drawing2->setDescription('This is a second image');
        $drawing2->setPath(public_path('images/LOGOS-03.jpg'));
        $drawing2->setHeight(90);
        $drawing2->setCoordinates('K1');

        return [$drawing, $drawing2];
    }*/

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
