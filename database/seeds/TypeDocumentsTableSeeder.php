<?php

use Illuminate\Database\Seeder;

class TypeDocumentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('type_documents')->delete();
        
        \DB::table('type_documents')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => '00',
            'name' => 'Otros (especificar)',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'code' => '01',
                'name' => 'Factura',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'code' => '02',
                'name' => 'Recibo por Honorarios',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'code' => '03',
                'name' => 'Boleta de Venta',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'code' => '04',
                'name' => 'Liquidación de compra',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'code' => '05',
                'name' => 'Boleto de compañía de aviación comercial por el servicio de transporte aéreo de pasajeros',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'code' => '06',
                'name' => 'Carta de porte aéreo por el servicio de transporte de carga aérea',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'code' => '07',
                'name' => 'Nota de crédito',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'code' => '08',
                'name' => 'Nota de débito',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'code' => '09',
                'name' => 'Guía de remisión - Remitente',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'code' => '10',
                'name' => 'Recibo por Arrendamiento',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'code' => '11',
                'name' => 'Póliza emitida por las Bolsas de Valores, Bolsas de Productos o Agentes de Intermediación por operaciones realizadas en las Bolsas de Valores o Productos o fuera de las mismas, autorizadas po',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'code' => '12',
                'name' => 'Ticket o cinta emitido por máquina registradora',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'code' => '13',
                'name' => 'Documento emitido por bancos, instituciones financieras, crediticias y de seguros que se encuentren bajo el control de la Superintendencia de Banca y Seguros',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'code' => '14',
                'name' => 'Recibo por servicios públicos de suministro de energía eléctrica, agua, teléfono, telex y telegráficos y otros servicios complementarios que se incluyan en el recibo de servicio público',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'code' => '15',
                'name' => 'Boleto emitido por las empresas de transporte público urbano de pasajeros',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'code' => '16',
                'name' => 'Boleto de viaje emitido por las empresas de transporte público interprovincial de pasajeros dentro del país',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'code' => '17',
                'name' => 'Documento emitido por la Iglesia Católica por el arrendamiento de bienes inmuebles',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'code' => '18',
                'name' => 'Documento emitido por las Administradoras Privadas de Fondo de Pensiones que se encuentran bajo la supervisión de la Superintendencia de Administradoras Privadas de Fondos de Pensiones',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'code' => '19',
                'name' => 'Boleto o entrada por atracciones y espectáculos públicos',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'code' => '20',
                'name' => 'Comprobante de Retención',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'code' => '21',
                'name' => 'Conocimiento de embarque por el servicio de transporte de carga marítima',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'code' => '22',
                'name' => 'Comprobante por Operaciones No Habituales',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'code' => '23',
                'name' => 'Pólizas de Adjudicación emitidas con ocasión del remate o adjudicación de bienes por venta forzada, por los martilleros o las entidades que rematen o subasten bienes por cuenta de terceros',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'code' => '24',
                'name' => 'Certificado de pago de regalías emitidas por PERUPETRO S.A',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'code' => '25',
            'name' => 'Documento de Atribución (Ley del Impuesto General a las Ventas e Impuesto Selectivo al Consumo, Art. 19º, último párrafo, R.S. N° 022-98-SUNAT).',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'code' => '26',
                'name' => 'Recibo por el Pago de la Tarifa por Uso de Agua Superficial con fines agrarios y por el pago de la Cuota para la ejecución de una determinada obra o actividad acordada por la Asamblea General',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'code' => '27',
                'name' => 'Seguro Complementario de Trabajo de Riesgo',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'code' => '28',
                'name' => 'Tarifa Unificada de Uso de Aeropuerto',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'code' => '29',
                'name' => 'Documentos emitidos por la COFOPRI en calidad de oferta de venta de terrenos, los correspondientes a las subastas públicas y a la retribución de los servicios que presta',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'code' => '30',
                'name' => 'Documentos emitidos por las empresas que desempeñan el rol adquirente en los sistemas de pago mediante tarjetas de crédito y débito',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'code' => '31',
                'name' => 'Guía de Remisión - Transportista',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'code' => '32',
                'name' => 'Documentos emitidos por las empresas recaudadoras de la denominada Garantía de Red Principal a la que hace referencia el numeral 7.6 del artículo 7° de la Ley N° 27133 – Ley de Promoción del ',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'code' => '34',
                'name' => 'Documento del Operador',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'code' => '35',
                'name' => 'Documento del Partícipe',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'code' => '36',
                'name' => 'Recibo de Distribución de Gas Natural',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'code' => '37',
                'name' => 'Documentos que emitan los concesionarios del servicio de revisiones técnicas vehiculares, por la prestación de dicho servicio',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'code' => '50',
                'name' => 'Declaración Única de Aduanas - Importación definitiva                 ',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'code' => '52',
                'name' => 'Despacho Simplificado - Importación Simplificada                        ',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'code' => '53',
                'name' => 'Declaración de Mensajería o Courier                                         ',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'code' => '54',
                'name' => 'Liquidación de Cobranza                                                     ',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'code' => '87',
                'name' => 'Nota de Crédito Especial',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'code' => '88',
                'name' => 'Nota de Débito Especial',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'code' => '91',
                'name' => 'Comprobante de No Domiciliado                                                 ',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'code' => '96',
                'name' => 'Exceso de crédito fiscal por retiro de bienes                           ',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'code' => '97',
                'name' => 'Nota de Crédito - No Domiciliado',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'code' => '98',
                'name' => 'Nota de Débito - No Domiciliado',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'code' => '99',
                'name' => 'Otros -Consolidado de Boletas de Venta',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'id' => 49,
                'code' => '100',
                'name' => 'Letra',
                'created_at' => '2020-09-26 18:55:58',
                'updated_at' => '2020-09-26 18:55:58',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}