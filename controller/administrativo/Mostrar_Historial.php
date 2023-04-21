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

echo '<!-- llama al archivo que genera el excel -->
          <script languaje="javascript">
            function generar() {
              location.href = "../../controller/administrativo/Excel_Historico.php?idc='.$idc.'";
            }
          </script>

          <div class="boton_registrar">
            <button class="btn-medium btn" onclick="generar()">Descargar Excel</button>
          </div>';

//muestra la tabla
echo '<div >
                    <table>
					<div class="table">
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
</body>';
?>