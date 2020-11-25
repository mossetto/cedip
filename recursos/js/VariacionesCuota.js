/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function VariacionesCuota(numeroCuota,valorVariacion)
{
    this.numero_plan= null;
    this.numero_cuota = numeroCuota;
    
    this.variacion = valorVariacion;
    
    this.importe="";
    this.total_abonado="";
    this.estado="";
    
}

function CuotaPlan(plan, cuota, fecha_vencimiento, importe_cuota, variacion_cuota, total, total_abonado, estado)
{
    this.numero_plan= plan;
    this.numero_cuota= cuota;
    this.fecha= fecha_vencimiento;
    this.valor_cuota=importe_cuota;
    this.variacion=variacion_cuota;
    this.importe=total;
    this.capital_abonado=total_abonado;
    this.estado_cuota=estado;
}

