<?php
session_start();
require_once "/home/recciusc/conexiones/config_reccius.php";
// Verificar si la variable de sesión "usuario" no está establecida o está vacía.
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
    // Redirigir al usuario a la página de inicio de sesión.
    header("Location: login.html");
    exit;
}
$query = "SELECT categoria, nombre_opcion FROM calidad_opciones_desplegables ORDER BY categoria, CASE WHEN nombre_opcion = 'Otro' THEN 1 ELSE 0 END, nombre_opcion";
$result = mysqli_query($link, $query);

$opciones = [];
while ($row = mysqli_fetch_assoc($result)) {
    $opciones[$row['categoria']][] = $row['nombre_opcion'];
}

date_default_timezone_set('America/Santiago');
$fechaActual = new DateTime();
$fechaLimite = new DateTime('+30 days');

// Formatear las fechas para la consulta
$fechaActualFormato = $fechaActual->format('Y-m-d');
$fechaLimiteFormato = $fechaLimite->format('Y-m-d');

// Consulta SQL para obtener feriados entre las fechas
$queryDate = "SELECT fecha FROM feriados_chile WHERE fecha BETWEEN '$fechaActualFormato' AND '$fechaLimiteFormato'";
$resultDate = mysqli_query($link, $queryDate);

// Construir el arreglo de feriados
$feriados = [];
while ($row = mysqli_fetch_assoc($resultDate)) {
    $feriados[] = $row['fecha'];
}
function agregarDiasHabiles($fecha, $diasHabiles, $feriados)
{
    $contadorDias = 0;

    while ($contadorDias < $diasHabiles) {
        $fecha->modify('+1 day'); // Agregar un día

        // Si es un fin de semana o un feriado, no contar este día
        if ($fecha->format('N') < 6 && !in_array($fecha->format('Y-m-d'), $feriados)) {
            $contadorDias++;
        }
    }

    return $fecha;
}

// Calcular 10 días hábiles desde la fecha actual
$fechaEntregaEstimada = agregarDiasHabiles($fechaActual, 10, $feriados);

// Formatear para uso en HTML
$fechaEntregaEstimadaFormato = $fechaEntregaEstimada->format('Y-m-d');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/calidad.css?version=<?php echo time(); ?>">
</head>

<body>
    <div class="form-container">
        <h1>CALIDAD / Preparación solicitud Análisis Externo</h1>
        <form id="formulario_analisis_externo" name="formulario_analisis_externo">
            <fieldset>
                <legend>I. Análisis:</legend>
                <br>
                <div class="form-row">
                    <div class="form-group">
                        <label>N° Registro:</label>
                        <input required id="numero_registro" class="form-control mx-0 w-90" name="numero_registro" type="text" placeholder="DCAL-CC-ENE-001">
                    </div>
                    <div class="divider"></div> <!-- Esta es la línea divisora -->
                    <div class="form-group">
                        <label>Versión:</label>
                        <input id="version" name="version" type="text" class="form-control mx-0 w-90" value="1" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>N° Solicitud:</label>
                        <input required id="numero_solicitud" class="form-control mx-0 w-90" name="numero_solicitud" type="text" placeholder="SAEPT-0101001-00">
                    </div>
                    <div class="divider"></div> <!-- Esta es la línea divisora -->
                    <div class="form-group">
                        <label>Fecha registro:</label>
                        <input name="fecha_registro" class="form-control mx-0 w-90 datepicker" id="fecha_registro" placeholder="dd/mm/aaaa" type="text" value="<?php echo date('d/m/Y'); ?>">
                    </div>
                </div>
            </fieldset>
            <br />
            <fieldset>
                <legend>II. Especificaciones del producto:</legend>
                <br>
                <div class="form-row">
                    <div class="form-group">
                        <label>Tipo de Producto:</label>
                        <input class="form-control mx-0 w-90" id="tipo_producto" name="tipo_producto" type="text" placeholder="Producto Terminado">
                    </div>
                    <div class="divider"></div> <!-- Esta es la línea divisora -->
                    <div class="form-group">
                        <label>Código Producto:</label>
                        <input class="form-control mx-0 w-90" id="codigo_producto" name="codigo_producto" type="text" placeholder="12345">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Producto:</label>
                        <input class="form-control mx-0 w-90" id="producto" name="producto" type="text" placeholder="Ácido Ascórbico">
                    </div>
                    <div class="divider"></div> <!-- Esta es la línea divisora -->
                    <div class="form-group">
                        <label>Concentración:</label>
                        <input class="form-control mx-0 w-90" name="concentracion" id="concentracion" type="text" placeholder="1g / 10 ml">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Formato:</label>
                        <input class="form-control mx-0 w-90" name="formato" id="formato" type="text" placeholder="Ampolla">
                    </div>
                    <div class="divider"></div> <!-- Esta es la línea divisora -->
                    <div class="form-group">
                        <label>Elaborado por:</label>
                        <input class="form-control mx-0 w-90" name="elaboradoPor" id="elaboradoPor" type="text" placeholder="Reccius">
                    </div>
                </div>
            </fieldset>
            <br />
            <fieldset>
                <legend>III. Identificación de la muestra:</legend>
                <br>
                <div class="form-row">
                    <div class="form-group">
                        <label>Nro Lote:</label>
                        <input required class="form-control mx-0 w-90 editable" name="lote" id="lote" type="text" placeholder="RM-000000/00">
                    </div>
                    <div class="divider"></div> <!-- Esta es la línea divisora -->
                    <div class="form-group">
                        <label>Tamaño Lote:</label>
                        <input required class="form-control mx-0 w-90 editable" name="tamano_lote" id="tamano_lote" type="number" placeholder="20">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Fecha Elaboración:</label>
                        <input required class="form-control mx-0 w-90 datepicker editable" name="fecha_elaboracion" id="fecha_elaboracion" value="<?php echo date('d/m/Y'); ?>" placeholder="dd/mm/aaaa" type="text">
                    </div>
                    <div class="divider"></div> <!-- Esta es la línea divisora -->
                    <div class="form-group">
                        <label>Fecha Vencimiento:</label>
                        <input required class="form-control mx-0 w-90 datepicker editable" name="fecha_vencimiento" id="fecha_vencimiento" placeholder="dd/mm/aaaa" type="text">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Tipo Analisis:</label>
                        <input required class="form-control mx-0 w-90 editable" name="tipo_analisis" id="tipo_analisis" type="text" value="Análisis de rutina">
                    </div>
                    <div class="divider"></div>
                    <div class="form-group">
                        <label>Condiciones Almacenamiento:</label>
                        <textarea required class="form-control mx-0 w-90 border rounded-sm editable" style="field-sizing: content;" name="condicion_almacenamiento" id="condicion_almacenamiento" rows="2" placeholder="..."></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Cantidad Muestra:</label>
                        <input required class="form-control mx-0 w-90 editable" name="tamano_muestra" id="tamano_muestra" type="text" placeholder="...">
                    </div>
                    <div class="divider"></div> <!-- Esta es la línea divisora -->
                    <div class="form-group">
                        <label>Cantidad Contra-muestra:</label>
                        <input required class="form-control mx-0 w-90 editable" name="tamano_contramuestra" id="tamano_contramuestra" type="text" placeholder="...">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Registro ISP:</label>
                        <input required class="form-control mx-0 w-90 editable" name="registro_isp" id="registro_isp" type="text" value="N°2988/18. RF XIII 06/18. 1A, 2B, 2C, 3A, 3D, 4">
                    </div>
                    <div class="divider"></div> <!-- Esta es la línea divisora -->
                    <div class="form-group">
                        <label>Muestreado según POS:</label>
                        <input required class="form-control mx-0 w-90 editable" name="numero_pos" id="numero_pos" type="text" placeholder="...">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Responsable Muestreo:</label>
                        <select required name="muestreado_por" id="muestreado_por" class="select-style mx-0 form__select w-90 editable">
                            <option>Selecciona el usuario:</option>
                            <option value="mgodoy" selected>Macarena Godoy - Supervisor Calidad</option>
                            <option value="isumonte">Inger Sumonte Rodríguez - Director Calidad</option>
                            <option value="lcaques">Lynnda Caques Segovia - Coordinador Calidad</option>
                            <option value="cpereira">Catherine Pereira García - Jefe de Producción</option>
                            <option value="lsepulveda">Luis Sepúlveda Miranda - Director Técnico</option>
                            <option value="fabarca212">Felipe Abarca</option>
                            <option value="lucianoalonso2000">Luciano Abarca</option>
                            <option value="javier2000asr">Javier Sabando</option>
                        </select>
                    </div>
                    <div class="divider"></div> <!-- Esta es la línea divisora -->
                    <div class="form-group">
                        <label>Verificador Muestreo:</label>
                        <select required name="am_verificado_por" id="am_verificado_por" class="select-style mx-0 form__select w-90 editable">
                            <option>Selecciona el usuario:</option>
                            <option value="mgodoy">Macarena Godoy - Supervisor Calidad</option>
                            <option value="isumonte">Inger Sumonte Rodríguez - Director Calidad</option>
                            <option value="lcaques" selected>Lynnda Caques Segovia - Coordinador Calidad</option>
                            <option value="cpereira">Catherine Pereira García - Jefe de Producción</option>
                            <option value="lsepulveda">Luis Sepúlveda Miranda - Director Técnico</option>
                            <option value="fabarca212">Felipe Abarca</option>
                            <option value="lucianoalonso2000">Luciano Abarca</option>
                            <option value="javier2000asr">Javier Sabando</option>
                        </select>
                    </div>
                </div>
            </fieldset>
            <br />
            <div id="informacion_faltante">
                <fieldset>
                    <legend>IV. Solicitud de Análisis Externo:</legend>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Laboratorio Analista:</label>
                            <select required name="laboratorio" id="laboratorio" class="highlight select-style mx-0 form__select w-90" onchange="verificarOtro('laboratorio', 'otro_laboratorio')" style="width: 90%" required>
                            </select>
                            <input type="text" name="otro_laboratorio" id="otro_laboratorio" placeholder="Especificar otro laboratorio" class="highlight form-control mx-0 w-90" style="display: none" />
                        </div>
                        <div class="divider"></div>
                        <!-- Esta es la línea divisora -->
                        <div class="form-group">
                            <label>Fecha Solicitud:</label>
                            <input name="fecha_solicitud" class="highlight form-control mx-0 w-90 datepicker" id="fecha_solicitud" placeholder="dd/mm/aaaa" type="text" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Análisis según:</label>
                            <input name="analisis_segun" id="analisis_segun" class="highlight form-control mx-0 w-90" type="text" required placeholder="Cotización" />
                        </div>
                        <div class="divider"></div>
                        <!-- Esta es la línea divisora -->
                        <div class="form-group">
                            <label>Fecha Cotización:</label>
                            <input name="fecha_cotizacion" id="fecha_cotizacion" placeholder="dd/mm/aaaa" type="text" required class="highlight form-control mx-0 w-90 datepicker" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="estandar_segun">Estándar Provisto por:</label>
                            <select required id="estandar_segun" name="estandar_segun" class="highlight select-style mx-0 form__select w-90" style="width: 82.5%">
                                <option value="reccius">Reccius</option>
                                <option value="cequc">CEQUC</option>
                                <option value="pharmaisa">Pharma ISA</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                        <div class="divider"></div>
                        <!-- Esta es la línea divisora -->
                        <div class="form-group">
                            <label>Adjunta Hoja de seguridad</label>
                            <input name="hds_otro" id="hds_otro" type="text" required class="highlight form-control mx-0 w-90" placeholder="No" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Fecha Entrega Estimada <em>(10 días hábiles)</em>:</label>
                            <input name="fecha_entrega_estimada" id="fecha_entrega_estimada" placeholder="dd/mm/aaaa" type="text" required value="<?php echo $fechaEntregaEstimadaFormato; ?>" class="highlight form-control mx-0 w-90 datepicker" />
                        </div>
                        <div class="divider"></div>
                        <!-- Esta es la línea divisora -->
                        <div class="form-group">
                            <label>N° Documento:</label>
                            <input name="numero_documento" id="numero_documento" class="highlight form-control mx-0 w-90" type="text" required placeholder="123456" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Observaciones:</label>
                            <textarea name="observaciones" id="observaciones" class="highlight form-control mx-0 w-90 border rounded-sm" rows="4" placeholder="..."></textarea>
                        </div>
                        <div class="divider"></div>
                        <!-- Esta es la línea divisora -->
                        <div class="form-group"></div>
                    </div>
                </fieldset>
                <br />
                <fieldset>
                    <legend>V. Análisis:</legend>
                    <br />
                    <div class="form-row">
                        <div class="form-group">
                            <label>Especificación de producto:</label>
                            <input name="numero_especificacion" id="numero_especificacion" type="text" placeholder="Numero de especificacion" class="form-control mx-0 w-90" />
                        </div>
                        <div class="divider"></div>
                        <!-- Esta es la línea divisora -->
                        <div class="form-group">
                            <label>Versión:</label>
                            <input name="version_especificacion" id="version_especificacion" type="text" placeholder="06-07-2023" class="form-control mx-0 w-90" />
                        </div>
                    </div>
                </fieldset>
                <br />
                <fieldset>
                    <legend>VI. Flujo de Aprobación:</legend>
                    <br />
                    <br />
                    <div class="form-row">
                        <div class="form-group">
                            <label>Usuario Solicitante:</label>
                            <input class="form-control mx-0 w-100" type="text" id="usuario_editor" name="usuario_editor" value="<?php echo $_SESSION['nombre']; ?>" readonly />
                            <input type="text" id="user_editor" name="user_editor" value="<?php echo $_SESSION['usuario']; ?>" style="display: none" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Revisión a cargo de:</label>
                            <select name="revisado_por" id="revisado_por" class="select-style mx-0 form__select w-100 highlight" required>
                                <option>Selecciona el usuario supervisor:</option>
                                <option value="isumonte">Inger Sumonte Rodríguez - Director Calidad</option>
                                <option value="lcaques" selected>Lynnda Caques Segovia - Coordinador Calidad</option>
                                <option value="cpereira">Catherine Pereira García - Jefe de Producción</option>
                                <option value="lsepulveda">Luis Sepúlveda Miranda - Director Técnico</option>
                                <option value="fabarca212">Felipe Abarca</option>
                                <option value="lucianoalonso2000">Luciano Abarca</option>
                                <option value="javier2000asr">Javier Sabando</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="alert alert-warning mx-3 text-center p-2 m-0" id="alert_warning" style="display: none;"></div>

            <div class="button-container">
               <!-- <button class="botones" id="upload-pdf" style="display: none;">
                    Guardar como PDF</button> -->
                <button type="submit" id="guardar" name="guardar" class="botones">
                    Guardar Solicitud</button>

                <button type="button" id="editarGenerarVersion" name="editarGenerarVersion" class="botones" style="background-color: red; color: white;">
                    Editar solicitud</button>
            </div>
            <div class="actions-container">
                <input type="text" id="id_producto" name="id_producto" style="display: none;">
                <input type="text" id="id_especificacion" name="id_especificacion" style="display: none;">
            </div>
        </form>
    </div>
</body>

</html>
<script>
    //document.querySelectorAll('input, select, textarea').forEach((el)=>console.log({id:el.id, type: el.type}))
    /**
     * Sets values to the given inputs.
     *
     * @param {Array<{id: string, val: string, isDisabled: boolean}>} arr - Array of objects with 'id' (string), 'val' (string) and 'isDisabled' (boolean) properties.
     * @return {void}
     */

    function setValuesToInputs(arr) {
        for (let el of arr) {
            const {
                id,
                val,
                isDisabled
            } = el;
            var elem = $('#' + id);

            if (isDisabled) {
                console.log('Elemento ' + id + ' deshabilitado');
                elem.prop('disabled', true);
            }

            if (elem.hasClass('datepicker')) {
                var formattedDate = moment(val).format('DD/MM/YYYY');
                elem.val(formattedDate);
            } else {
                elem.val(val);
            }


        }
    }

    informacionFaltante();

    function informacionFaltante() {
        if (QA_solicitud_analisis_editing) {
            $("#guardar").show();
        } else {
            $("#editarGenerarVersion").hide();
            $("#informacion_faltante").remove();
        }
    }

    var idAnalisisExterno = <?php echo json_encode($_POST['analisisExterno'] ?? ''); ?>;
    var idEspecificacion = <?php echo json_encode($_POST['especificacion'] ?? ''); ?>;
    var accion = <?php echo json_encode($_POST['accion'] ?? ''); ?>;

    function cargarDatosEspecificacion() {
        var data = {
            idEspecificacion: idEspecificacion,
            id_analisis_externo: idAnalisisExterno,
            accion: accion
        };

        $.ajax({
            url: './backend/laboratorio/cargaEsp_solicitudBE.php',
            type: 'GET',
            data,
            success: function(response) {
                if (QA_solicitud_analisis_editing) {
                    procesarDatosActaUpdate(response);
                } else {
                    procesarDatosActa(response);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud: ", status, error);
            }
        });
    }
    cargarDatosEspecificacion();

    $('#fecha_elaboracion').datepicker({
        format: 'dd/mm/yyyy', // Formato de fecha
    });

    var newVersion = 1;

    function procesarDatosActa(response) {
        if (response && response.productos && response.productos.length > 0) {
            var producto = response.productos[0];
            var newNumeroRegistro = response.total_analisis + 1
            var numeroSaept = response.total_analisis_producto + 1
            var now = new Date();
            $('#version').val(1);
            $('#numero_registro').val(`DCAL-CC-SEPT-${
                newNumeroRegistro > 99 ? '' : 
                newNumeroRegistro > 9 ? '0' : 
                '00'
            }` + newNumeroRegistro).prop('readonly', true);
            $('#numero_solicitud').val(`SAEPT-${
                now.getFullYear().toString().substr(-2) +
                (now.getMonth() + 1 > 9 ? 
                    now.getMonth() +  1 : 
                    '0' + (now.getMonth() + 1))
                .toString()
            }${
                numeroSaept < 10 ? '00' + numeroSaept : 
                numeroSaept < 100 ? '0' + numeroSaept : 
                numeroSaept
            }-01`).prop('readonly', true);

            setValuesToInputs([{
                    id: 'id_producto',
                    val: producto.id_producto,
                    isDisabled: false
                },
                {
                    id: 'tipo_producto',
                    val: producto.tipo_producto,
                    isDisabled: true
                },
                {
                    id: 'codigo_producto',
                    val: producto.identificador_producto,
                    isDisabled: true
                },
                {
                    id: 'producto',
                    val: producto.nombre_producto,
                    isDisabled: true
                },
                {
                    id: 'concentracion',
                    val: producto.concentracion,
                    isDisabled: true
                },
                {
                    id: 'formato',
                    val: producto.formato,
                    isDisabled: true
                },
                {
                    id: 'elaboradoPor',
                    val: producto.elaborado_por,
                    isDisabled: true
                }
            ])

            var especificaciones = Object.values(producto.especificaciones);
            if (especificaciones.length > 0) {
                var especificacion = especificaciones[0];
                $('#id_especificacion').val(especificacion.id_especificacion);
                $('#version_especificacion').val(especificacion.version);
            }
        } else {
            console.error("No se recibieron datos válidos: ", response);
        }
    }

    var guardarYFirmarSolicitud = false

    function procesarDatosActaUpdate(response) {

        if (response && response.analisis) {

            newVersion = response.count_analisis_externo + 1
            var analisis = response.analisis;
            var primerProducto = response.productos[0];

            //Todo : Volver a validar cuando se pueda editar ||| en caso de que los datos este de 4 al 6 hacer la seccion de "nuevo analisis" y añadir nueva version

            if (analisis.estado == "Pendiente Acta de Muestreo") {
                //!elimina del punto 4 al 6
                $("#informacion_faltante").remove();
            } else {
                if (analisis.estado !== "Pendiente completar análisis") {
                    //! Deja generar nueva version
                    $("#upload-pdf").show();
                } else {
                    //! llenar del 4 al 6 y firmar
                    $("#editarGenerarVersion").hide();
                    $("#guardar").text("GUARDAR Y FIRMAR SOLICITUD");
                    guardarYFirmarSolicitud = true
                    $('.highlight').css('background-color', '#f4fac2');
                }
            }

            //* I. Análisis:
            $("#version").val(analisis.version);
            var arrToSetAnalisis = [{
                    id: 'numero_registro',
                    val: analisis.numero_registro,
                    isDisabled: true
                }, {
                    id: 'numero_solicitud',
                    val: analisis.numero_solicitud,
                    isDisabled: true
                }, {
                    id: 'fecha_registro',
                    val: analisis.fecha_registro,
                    isDisabled: true
                }
                //
            ]
            //* II. Especificaciones
            var arrToSetEspecificaciones = [{
                    id: 'id_producto',
                    val: analisis.prod_identificador_producto,
                    isDisabled: false
                },
                {
                    id: 'tipo_producto',
                    val: analisis.prod_tipo_producto,
                    isDisabled: true
                },
                {
                    id: 'codigo_producto',
                    val: analisis.prod_identificador_producto,
                    isDisabled: true
                },
                {
                    id: 'producto',
                    val: analisis.prod_nombre_producto,
                    isDisabled: true
                },
                {
                    id: 'formato',
                    val: analisis.prod_formato,
                    isDisabled: true
                },
                {
                    id: 'concentracion',
                    val: analisis.prod_concentracion,
                    isDisabled: true
                },
                {
                    id: 'elaboradoPor',
                    val: analisis.prod_elaborado_por,
                    isDisabled: true
                }
            ];
            //* III. Identificación
            var arrToSetIdentificacion = [{
                    id: 'lote',
                    val: analisis.lote,
                    isDisabled: true
                },
                {
                    id: 'tamano_lote',
                    val: analisis.tamano_lote,
                    isDisabled: true
                },
                {
                    id: 'fecha_elaboracion',
                    val: analisis.fecha_elaboracion,
                    isDisabled: true
                },
                {
                    id: 'fecha_vencimiento',
                    val: analisis.fecha_vencimiento,
                    isDisabled: true
                },
                {
                    id: 'tipo_analisis',
                    val: analisis.tipo_analisis,
                    isDisabled: true
                },
                {
                    id: 'condicion_almacenamiento',
                    val: analisis.condicion_almacenamiento,
                    isDisabled: true
                },
                {
                    id: 'tamano_muestra',
                    val: analisis.tamano_muestra,
                    isDisabled: true
                },
                {
                    id: 'tamano_contramuestra',
                    val: analisis.tamano_contramuestra,
                    isDisabled: true
                },
                {
                    id: 'registro_isp',
                    val: analisis.registro_isp,
                    isDisabled: true
                },
                {
                    id: 'numero_pos',
                    val: analisis.numero_pos,
                    isDisabled: true
                },
                {
                    id: 'muestreado_por',
                    val: analisis.muestreado_por,
                    isDisabled: true
                },
                {
                    id: 'am_verificado_por',
                    val: analisis.am_verificado_por,
                    isDisabled: true
                }
            ];
            //* IV. Solicitud de Análisis Externo
            var arrToSetAdditionalInfo = [];
            if (analisis.laboratorio) {
                arrToSetAdditionalInfo = [{
                        id: 'analisis_segun',
                        val: analisis.analisis_segun,
                        isDisabled: true
                    },
                    {
                        id: 'estandar_segun',
                        val: analisis.estandar_segun,
                        isDisabled: true
                    },
                    {
                        id: 'fecha_cotizacion',
                        val: analisis.fecha_cotizacion,
                        isDisabled: true
                    },
                    {
                        id: 'fecha_entrega_estimada',
                        val: analisis.fecha_entrega_estimada,
                        isDisabled: true
                    },
                    {
                        id: 'fecha_solicitud',
                        val: analisis.fecha_solicitud,
                        isDisabled: true
                    },
                    {
                        id: 'hds_otro',
                        val: analisis.hds_otro,
                        isDisabled: true
                    },
                    {
                        id: 'laboratorio',
                        val: analisis.laboratorio,
                        isDisabled: true
                    },
                    {
                        id: 'numero_documento',
                        val: analisis.numero_documento,
                        isDisabled: true
                    },
                    {
                        id: 'observaciones',
                        val: analisis.observaciones,
                        isDisabled: true
                    },
                ]
            }
            
            var laboratorioOptions = '<option value="">Selecciona un Laboratorio</option>';
            response.laboratorios.forEach(lab => {
                laboratorioOptions += `<option value="${lab.name}">${lab.name}</option>`;
            });
            laboratorioOptions += `<option value="Otro">Otro</option>`;
            $('#laboratorio').html(laboratorioOptions);



            $('#id_especificacion').val(analisis.id_especificacion);
            $('#version_especificacion').val(analisis.version_especificacion).prop('disabled', true);
            //* V. Análisis
            $('#numero_especificacion').val(primerProducto.documento_producto).prop('disabled', true);

            var arrToSet = [...arrToSetAnalisis, ...arrToSetEspecificaciones, ...arrToSetIdentificacion, ...arrToSetAdditionalInfo];

            setValuesToInputs(arrToSet)

        } else {
            console.error("No se recibieron datos válidos: ", response);
        }
    }

    function verificarOtro(selectId, inputId) {
        var select = document.getElementById(selectId);
        var input = document.getElementById(inputId);
        if (select.value === 'Otro') {
            input.style.display = 'block';
            input.required = true; 
        } else {
            input.style.display = 'none';
            input.required = false; 
            input.value = '';
        }
    }

    function validateTextRequiredInputs(formData) {
        var formObject = {};
        formData.forEach(function(value, key) {
            formObject[key] = value;
            console.log(key, ' = ', value);
        });
    }


    $(document).ready(function() {

        function editarGenerarVersion(event) {

        }

        $('#editarGenerarVersion').on('click', function(event) {
            event.preventDefault();
            console.log("Editar Generar Version");

            $("#guardar").show();
            $("#editarGenerarVersion").hide();
            $("#version").val(newVersion);

            var informacionFaltanteArr = []


            if ($("#informacion_faltante").length > 0) {
                informacionFaltanteArr = [
                    'analisis_segun',
                    'estandar_segun',
                    'fecha_cotizacion',
                    'fecha_entrega_estimada',
                    'fecha_solicitud',
                    'hds_otro',
                    'laboratorio',
                    'numero_documento',
                    'observaciones'
                ].forEach(element => {
                    $("#" + element).prop('disabled', false);
                });
            } else {
                [
                    // I. Analisis:
                    'numero_registro',
                    'numero_solicitud',
                    'fecha_registro',
                    // III. Identificacion de la muestra:
                    'lote',
                    'tamano_lote',
                    'fecha_elaboracion',
                    'fecha_vencimiento',
                    'tipo_analisis',
                    'condicion_almacenamiento',
                    'tamano_muestra',
                    'tamano_contramuestra',
                    'registro_isp',
                    'numero_pos',
                    'muestreado_por',
                    'am_verificado_por'
                ].forEach(element => {
                    $("#" + element).prop('disabled', false);
                });
            }

        });

        $('#formulario_analisis_externo').on('submit', formSubmit);

        function formSubmit(event) {
            event.preventDefault();
            $('.datepicker').each(function() {
                var dateValue = $(this).val();
                if (dateValue) {
                    var formattedDate = moment(dateValue, 'DD/MM/YYYY').format('YYYY-MM-DD');
                    $(this).val(formattedDate);
                }
            });

            validateTextRequiredInputs(new FormData(this));
            var datosFormulario = $(this).serialize();

            if ($("#informacion_faltante").length > 0 && $("#version").val() != newVersion) {
                // Si el informacion_faltante no fue eliminada, entonces agregamos el id del analisis externo
                // para que en el backend sepa que tiene que hacer un "update" de los datos faltantes
                datosFormulario += '&id=' + idAnalisisExterno;
            }

            if($('#laboratorio').val() === 'Otro')
            {
                if($('#otro_laboratorio').val() == '') {
                    $.notify('Tiene que escribir el nombre del nuevo laboratorio', 'warn');
                    return;
                }
            }

            fetch('../pages/backend/laboratorio/LABORATORIO_preparacion_solicitudBE.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: datosFormulario
            }).then(function(data) {
        
        $('#dynamic-content').load('LABORATORIO_listado_solicitudes.php', function (response, status, xhr) {
          
                obtenNotificaciones();
                carga_listado();
                console.log('Formulario cargado exitosamente.'); // Confirmar que la carga fue exitosa
            
            $('#loading-spinner').hide();
            $('#dynamic-content').show();
        });
       
    }).catch(function(error) {
                console.log("Error: " + error);
            })

            $('.datepicker').each(function() {
                var isoDate = $(this).val();
                if (isoDate) {
                    var originalDate = moment(isoDate, 'YYYY-MM-DD').format('DD/MM/YYYY');
                    $(this).val(originalDate);
                }
            });
        }

        $('input[type="text"].datepicker').datepicker({
            format: 'dd/mm/yyyy', // Formato global de fecha
            language: 'es',
            autoclose: true,
            todayHighlight: true,
            startDate: new Date()
        });
        console.log('especificacion :<?php echo json_encode($_POST['especificacion'] ?? ''); ?>');

    });

    $(document).ready(function() {
        document.getElementById('upload-pdf').addEventListener('click', function(event) {
            event.preventDefault();
            var {
                jsPDF
            } = window.jspdf;
            var pdf = new jsPDF('p', 'mm', 'a4');

            var elementToExport = document.querySelector('.form-container');
            var buttonContainer = document.querySelector('.button-container');
            var formControls = document.querySelectorAll('.form-control'); // Selecciona todos los controles del formulario

            if (!elementToExport) {
                console.error('El elemento no está en el DOM.');
                return;
            }

            // Almacenar estilos originales
            var originalStyles = [];
            formControls.forEach(control => {
                originalStyles.push({
                    element: control,
                    background: control.style.background,
                    padding: control.style.padding
                });

                // Aplicar nuevos estilos
                control.style.background = 'transparent';
                control.style.padding = '5px'; // Ejemplo de menos padding
            });

            // Asegurarse de que el elemento esté visible
            elementToExport.style.border = 'none';
            elementToExport.style.boxShadow = 'none';
            buttonContainer.style.display = 'none';

            html2canvas(elementToExport, {
                    scale: 2
                }).then(canvas => {
                    var imgData = canvas.toDataURL('image/jpeg', 1.0);
                    var imgWidth = 210; // A4 width in mm
                    var pageHeight = 297; // A4 height in mm
                    var imgHeight = canvas.height * imgWidth / canvas.width;
                    let heightLeft = imgHeight;
                    let position = 0;

                    pdf.addImage(imgData, 'JPEG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;

                    while (heightLeft >= 0) {
                        position = heightLeft - imgHeight;
                        pdf.addPage();
                        pdf.addImage(imgData, 'JPEG', 0, position, imgWidth, imgHeight);
                        heightLeft -= pageHeight;
                    }

                    var blob = pdf.output('blob');

                    var formData = new FormData();
                    formData.append('certificado', blob, 'documento.pdf');
                    formData.append('type', 'solicitud');
                    formData.append('id_solicitud', idAnalisisExterno);
                    return fetch('./backend/calidad/add_documentos.php', {
                        method: 'POST',
                        body: formData
                    });
                }).then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        $.notify("PDF subido con éxito", "success");
                    } else {
                        $.notify("Error al subir el PDF: " + data.message, "error");
                    }
                })
                .catch(error => {
                    console.error('Error al subir el PDF:', error);
                    $.notify("Error al subir el PDF", "error");
                })
                .finally(() => {
                    // Restaurar estilos originales
                    originalStyles.forEach(style => {
                        style.element.style.background = style.background;
                        style.element.style.padding = style.padding;
                    });
                    buttonContainer.style.display = 'flex';
                });
        });
    });
</script>