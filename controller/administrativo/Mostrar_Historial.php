<?php
include_once('../../model/administrativo/Mostrar_Historial.php');
$idc = $_GET["idc"];
echo $idc . '<br>';

//manda a hacer la consulta
$base = new Historial();
$base->conexion();
$asociados = $base->historialAsoc($idc);
$general = $base->historialGen($idc);

//pone la ventana
include('../../view/administrativo/Historico_Certificaciones.html');

//muestra la tabla
echo '<div class="table">
                    <table>
					<div class="header_table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Precio general</th>
                                <th>Precio socio/asociado</th>
                            </tr>
                        </thead>
                        <tbody>';

//muestra los datos de la tabla
for ($i=0; $i<count($asociados); $i ++){
    echo '<tr>';
    $fecha = date('d-m-y', strtotime($asociados[$i]["FechaH"]));
    echo '<th>'. $fecha. '</th>';
    echo '<th>' . $general[$i]["PrecioH"] . '</th>';
    echo '<th>' . $asociados[$i]["PrecioH"] . '</th>';
}

//pone el final de la tabla
echo '</tr>
                          </tbody>
                    </div>
                </table>
                </div>
            </section>
          </div>
        </article>
      </div>
    </div>
  </main>
  </div>
</body>';
?>