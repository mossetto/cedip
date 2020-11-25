	function ImprimirDetalleCuota(fecha,cuota,plan,nombre,cuit,cuota_pura,variacion,importe,total_abonado,estado,vehiculo)
	{
		this.fecha= fecha;
		this.cuota=cuota;
		this.plan=plan;
		this.nombre=nombre;
		this.cuit=cuit;
		this.cuota_pura= cuota_pura;
		this.variacion = variacion;
		this.importe= importe;
		this.total_abonado= total_abonado;
		this.estado= estado;
                this.vehiculo= vehiculo;


                var doc = new jsPDF();
                var altura_actual= 20;
                var separacion_entre = 0;

                doc.setFontSize(16);
                doc.text(20, altura_actual, 'Badino Automotores');
                doc.setFontSize(10);
                doc.text(170, altura_actual, 'Fecha: '+this.fecha);

                doc.setFontSize(9);
                separacion_entre=10;

                altura_actual+=separacion_entre;
                doc.text(20,altura_actual,'Local: Santa Rosa de Rio Primero');
                separacion_entre=5;
                altura_actual+=separacion_entre;
                doc.text(20,altura_actual,'Direccion: Congreso 442');
                altura_actual+=separacion_entre;
                doc.text(20,altura_actual,'Telefono: (03574) 480939 - 15454383 ');
                altura_actual+=separacion_entre;
                doc.text(20,altura_actual,'Correo: info@badinoautomotores.com ');
                altura_actual+=separacion_entre;

                doc.setLineWidth(0.2);
                    doc.line(20, altura_actual, 200, altura_actual);

                    doc.setFontSize(12);
                    separacion_entre=10;
                    altura_actual+=separacion_entre;
                    doc.text(20,altura_actual,'Resumen de cuota '+this.cuota);

                    doc.setFontSize(9);
                    altura_actual+=separacion_entre;

                    separacion_entre=8;

                doc.text(20,altura_actual,'Numero de plan: 1');
                altura_actual+=separacion_entre;
                doc.text(20,altura_actual,'Cliente: '+this.nombre);
                altura_actual+=separacion_entre;
                 doc.text(20,altura_actual,'Cuit: '+this.cuit);
                altura_actual+=separacion_entre;
                doc.text(20,altura_actual,'Vehiculo: '+this.vehiculo);
                altura_actual+=separacion_entre;
                 doc.text(20,altura_actual,'Cuota pura: $'+this.cuota_pura);
                altura_actual+=separacion_entre;
                 doc.text(20,altura_actual,'Variacion: '+this.variacion+"%");
                altura_actual+=separacion_entre;
                 doc.text(20,altura_actual,'Importe: $'+this.importe);
                    altura_actual+=separacion_entre;
                 doc.text(20,altura_actual,'Total Abonado: $'+this.total_abonado);
                altura_actual+=separacion_entre;
                 doc.text(20,altura_actual,'Estado: '+this.estado);
                altura_actual+=separacion_entre;


                 var documento= doc.output('dataurlnewwindow');
	 }