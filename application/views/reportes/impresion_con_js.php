<!DOCTYPE html>
<html>
  <head>
    <meta charset="iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cedip</title>
    <script src="<?php echo base_url()?>recursos/plugins/jspdf/jspdf.js"></script>
    <script>


	function imprimir_historia_clinica()
	{


	    var doc = new jsPDF();
	    var altura_actual= 20;

	    doc.setFontSize(10);
	    doc.text(40, altura_actual, 'Nombre: Mario Olivera');
	    doc.text(120, altura_actual, 'Medico Solicitante: Raul Alfonsin');
	    altura_actual+= 8;
	    doc.text(40, altura_actual, 'Fecha: 10/09/2016');
	    doc.text(120, altura_actual, 'Obra Social: Pami');
	    altura_actual+= 15;
	    doc.text(40, altura_actual, 'Tipo estudio: CORAZON SANGRIENTO');

	    // EXAMEN
	    altura_actual+= 15;
	    doc.text(40, altura_actual, 'El examen: ');
	    
            
            // SOLUCION CREADOR DE SALTO DE LINEA PARA EXAMEN
            var examen = "<?php echo $examen?>";
            var numeroCaracteres = examen.length;
            
            var texto_examen_dividido = examen.split(" "); 
            var cantidad_palabras = texto_examen_dividido.length;
           
            var escribir = "";
            var ultima_escrita ="";
           
            if(numeroCaracteres > 83)
            {
                for(var i=0; i < cantidad_palabras;i++)
                {
                    if((escribir.length + texto_examen_dividido[i].length +1) < 83)
                    {
                        escribir+= texto_examen_dividido[i]+" ";
                    }
                    else
                    {
                        altura_actual+= 10;
                        ultima_escrita=escribir;
                        doc.text(40, altura_actual, escribir);
                        escribir="";
                        i--;
                    }

                }

                if(ultima_escrita != escribir)
                {
                    altura_actual+= 10;
                    doc.text(40, altura_actual, escribir);
                }
            }
            else
            {
                altura_actual+= 10;
                doc.text(40, altura_actual, examen);
            }

	    
            
            

	    // Conclusion
	    altura_actual+= 15;
	    doc.text(40, altura_actual, 'Conclusion: ');
	    
            // SOLUCION CREADOR DE SALTO DE LINEA PARA EXAMEN
            examen = "<?php echo $conclusion?>";
            numeroCaracteres = examen.length;
            
            texto_examen_dividido = examen.split(" "); 
            cantidad_palabras = texto_examen_dividido.length;
           
            escribir = "";
            ultima_escrita ="";
           
            if(numeroCaracteres > 83)
            {
                for(var i=0; i < cantidad_palabras;i++)
                {
                    if((escribir.length + texto_examen_dividido[i].length +1) < 83)
                    {
                        escribir+= texto_examen_dividido[i]+" ";
                    }
                    else
                    {
                        altura_actual+= 10;
                        ultima_escrita=escribir;
                        doc.text(40, altura_actual, escribir);
                        escribir="";
                        i--;
                    }

                }

                if(ultima_escrita != escribir)
                {
                    altura_actual+= 10;
                    doc.text(40, altura_actual, escribir);
                }
            }
            else
            {
                altura_actual+= 10;
                doc.text(40, altura_actual, examen);
            }
	    
	    

	   
	     doc.output('datauri');
	     document.open('data:application/pdf;base64,' + Base64.encode(buffer));
	 }

	 $objeto = new imprimir_historia_clinica();
	</script>
  </head>
  <body >
  </body>
</html>