<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TipoViviendaTableSeeder::class);
        $this->call(EstadoCivilTableSeeder::class);
        $this->call(ProfesionTableSeeder::class);
        $this->call(NacionalidadTableSeeder::class);
        $this->call(RolTableSeeder::class);
        $this->call(ExtensionTableSeeder::class);
        $this->call(PersonaTableSeeder::class);
        $this->call(UsersTableSeeder::class); 
        $this->call(AfpTableSeeder::class);
        $this->call(TipoContratoTableSeeder::class);        
        //$this->call(ActividadEconomicaTableSeeder::class);
        $this->call(TipoAmortizacionTableSeeder::class);
        $this->call(TipoCreditoTableSeeder::class);
        $this->call(DestinoCreditoTableSeeder::class);
        $this->call(TipoGarantiaTableSeeder::class);
        $this->call(TipoMonedaTableSeeder::class);
        $this->call(TipoPeriodoPagoTableSeeder::class);
        $this->call(FormaPagoTableSeeder::class);
        //$this->call(CreditoTableSeeder::class);
        //$this->call(GarantiaTableSeeder::class);
        //$this->call(BienesHogarTableSeeder::class);
        //$this->call(InmuebleTableSeeder::class);
        //$this->call(VehiculoTableSeeder::class);
        $this->call(EntidadBancariaTableSeeder::class);
        $this->call(TipoDepositoTableSeeder::class);
        //$this->call(DepositoBancarioTableSeeder::class);
        //$this->call(CuentasPorPagarTableSeeder::class);
        //$this->call(PrestamoBancarioTableSeeder::class);
        //$this->call(CuentasDocumentosCobrarTableSeeder::class);
        //$this->call(ManoObraMensualTableSeeder::class);
       // $this->call(VentasTableSeeder::class);
        //$this->call(MaquinariaEquipoTableSeeder::class);
        //$this->call(GastosOperativosComercializacionTableSeeder::class);
        //$this->call(GastosFamiliaresTableSeeder::class);
        //$this->call(InversionesFinancierasTableSeeder::class);
        //$this->call(DepositoBancarioPlazoTableSeeder::class);
        //$this->call(DepartamentoTableSeeder::class);
        $this->call(RequisitosTableSeeder::class);
        $this->call(BuroTableSeeder::class);
        //$this->call(ReporteBuroTableSeeder::class);  
        //$this->call(DireccionTableSeeder::class);
        //$this->call(DatosEmpresaTableSeeder::class);
        //$this->call(CapacidadPagoTableSeeder::class);
        $this->call(AreaTableSeeder::class);
        $this->call(CategoriaFotoTableSeeder::class);
        $this->call(CategoriaArchivoTableSeeder::class);  
        $this->call(CategoriaCroquisTableSeeder::class);
    }
}
