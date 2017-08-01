<?php
  crear(); //Creamos el archivo
  //leer();  //Luego lo leemos
 
  //Para crear el archivo
  function crear(){
    $xml = new DomDocument('1.0', 'UTF-8');
    $conceptos = $xml->createElement('conceptos');
    $conceptos = $xml->appendChild($conceptos);
    
    //$biblioteca = $xml->createElement('biblioteca');
    //$biblioteca = $xml->appendChild($biblioteca);
 
    $concepto = $xml->createElement('concepto');
    $concepto = $conceptos->appendChild($concepto);
     
    // Agregar un atributo al concepto
    $concepto->setAttribute('ClaveProdServ', '84111506');
    $concepto->setAttribute('Cantidad', '0');
    $concepto->setAttribute('Unidad', 'ACT');
    $concepto->setAttribute('ClaveUnidad', 'ZZ');
    $concepto->setAttribute('Descripcion', 'Pago');
    $concepto->setAttribute('ValorUnitario', '0');
    $concepto->setAttribute('Importe', '0');
 
   //agregar complementos
    $complemento = $xml->createElement('Complemento');
    $complemento = $xml->appendChild($complemento);

    $pagos = $xml->createElement('Pago10:Pagos');
    $pagos = $complemento->appendChild($pagos);
    //atributos pagos

    $pagos->setAttribute('Version', '1.0');
    $pagos->setAttribute('xsi:schemaLocation', "http://www.sat.gob.mx/Pagos http://www.sat.gob.mx/sitio_internet/cfd/Pagos/Pagos10.xsd");
    
    $pago = $xml->createElement('Pago10:Pago');
    $pago = $pagos->appendChild($pago);
    //atributos pago
    $pagos->setAttribute('FechaPago', '2017-07-26T09:00:00');
    $pagos->setAttribute('FormaDePago', '06');
    $pagos->setAttribute('MonedaP', 'MXN');
    $pagos->setAttribute('Monto', '100');
    $pagos->setAttribute('RfcEmisorCtaOrd', 'XEXX010101000');
    $pagos->setAttribute('CtaOrdenante', '1234567890');

    $doctoRelacionado = $xml->createElement('Pago10:DoctoRelacionado');
    $doctoRelacionado = $pago->appendChild($doctoRelacionado);

    //atributos de doctorelacionado
    $doctoRelacionado->setAttribute('IdDocumento', '10293');
    $doctoRelacionado->setAttribute('MonedaDR', '10293');
    $doctoRelacionado->setAttribute('MetodoDePagoDR', '10293');
    $doctoRelacionado->setAttribute('NumParcialidad', '10293');
    $doctoRelacionado->setAttribute('ImpSaldoAnt', '10293');
    $doctoRelacionado->setAttribute('ImpPagado', '10293');
    $doctoRelacionado->setAttribute('ImpSaldoInsoluto', '10293');

    
    $impuestos = $xml->createElement('pago10:Impuestos');
    $impuestos = $pago->appendChild($impuestos);
    //atriutos impuestos
    $impuestos->setAttribute('TotalInpuestosRetenidos','1203');

    $retenciones = $xml->createElement('Retenciones');
    $retenciones = $pago->appendChild($retenciones);
    $retencion = $xml->createElement('Retencion');
    $retencion = $retenciones->appendChild($retencion);
    //atrubutos retenciones
    $retencion->setAttribute('Impuesto','023');
    $retencion->setAttribute('Importe','102');


    $xml->formatOutput = true;
    $el_xml = $xml->saveXML();
    $xml->save('libros.xml');
 
    //Mostramos el XML puro
    echo "<p><b>El XML ha sido creado.... Mostrando en texto plano:</b></p>".
         htmlentities($el_xml)."<br/><hr>";
  }
 
  /*Para leerlo
  function leer(){
    echo "<p><b>Ahora mostrandolo con estilo</b></p>";
    $xml = simplexml_load_file('libros.xml');
    $salida ="";
    foreach($xml->libro as $item){
      $salida .=
        "<b>Autor:</b> " . $item->autor . "<br/>".
        "<b>Título:</b> " . $item->titulo . "<br/>".
        "<b>Ano:</b> " . $item->anio . "<br/>".
        "<b>Editorial:</b> " . $item->editorial . "<br/><hr/>";
    }
    echo $salida;
  }*/
?>