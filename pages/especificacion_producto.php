<?php
//archivo: pages\especificacion_producto.php

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

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
    <!-- Asegúrate de incluir el CSS para estilizar tu formulario aquí -->
    <!-- CSS personalizado específico para esta página -->
    <link rel="stylesheet" href="../assets/css/calidad.css">
    <link rel="stylesheet" href="../assets/css/Botones.css">
</head>

<body>
    <div class="form-container">
        <h1>Calidad / Crear Especificación de Producto</h1>
        <form method="POST" id="formulario_especificacion" name="formulario_especificacion">
            <fieldset>
                <br>
                <br>
                <h2 class="section-title">Especificaciones del producto:</h2>
                <br>
                <div class="form-row">
                    <div class="form-group">
                        <label>Tipo de Producto:</label>
                        <select id="Tipo_Producto" name="Tipo_Producto" class="select-style editable"
                            onchange="verificarOtro('Tipo_Producto', 'otroTipo_Producto')" style="width: 83%" required>
                            <option value="">Selecciona el tipo de producto</option>
                            <?php foreach ($opciones['Tipo_Producto'] as $opcion): ?>
                                <option value="<?php echo htmlspecialchars($opcion); ?>">
                                    <?php echo htmlspecialchars($opcion); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="otroTipo_Producto" id="otroTipo_Producto" class="otro-campo"
                            placeholder="Especificar otro tipo de producto" style="display: none;">
                    </div>
                    <div class="divider"></div> <!-- Esta es la línea divisora -->
                    <div class="form-group">
                        <label>Producto:</label>
                        <input type="text" id="producto" name="producto" placeholder="Ácido Ascórbico" class="editable"
                            required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Unidad de Medida:</label>
                        <select name="tipo_concentracion" id="tipo_concentracion" class="select-style editable"
                            style="width: 83%" required>
                            <option value="" disabled selected>Selecciona estructura a utilizar:</option>
                            <option value="ug/ml">ug/ml</option>
                            <option value="mg/ml">mg/ml</option>
                            <option value="g/ml">g/ml</option>
                            <option value="%/ml">%/ml</option>
                            <option value="UI/ml">UI/ml</option>
                            <option value="%/g">%/g</option>
                            <option value="g">g</option>
                            <option value="mg">mg</option>
                            <option value="ml">ml</option>
                            <option value="UI">UI</option>
                            <option value="na">No aplica</option>
                        </select>
                        <div class="form-row">

                            <input type="text" name="concentracion_param1" class="col"
                                style="display: none;width: 40%;margin-left: 100px;margin-top: 9px; background-color: #f4fac2;">

                            <input type="text" name="concentracion_param1_lbl" class="col" disabled
                                style="display: none;width: 43%;margin-right: 200px;margin-top: 9px;">
                        </div>
                        <br>
                        <div class="form-row">

                            <input type="text" name="concentracion_param2" class="col"
                                style="display: none;width: 40%;margin-left: 100px;margin-top: 9px; background-color: #f4fac2;">

                            <input type="text" name="concentracion_param2_lbl" class="col" disabled
                                style="display: none;width: 43%;margin-right: 200px;margin-top: 9px;">


                        </div>
                        <input type="text" name="concentracion" placeholder="1g / 10ml" style="display: none;">
                    </div>
                    <div class="divider"></div> <!-- Esta es la línea divisora -->
                    <div class="form-group">
                        <label>Forma farmacéutica:</label>
                        <select name="formato" id="formato" class="select-style editable"
                            onchange="verificarOtro('formato', 'otroFormato')" style="width: 83%" required>
                            <option value="">Selecciona una opción</option>
                            <?php foreach ($opciones['Formato'] as $opcion): ?>
                                <option value="<?php echo htmlspecialchars($opcion); ?>">
                                    <?php echo htmlspecialchars($opcion); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="otroFormato" id="otroFormato" class="otro-campo"
                            placeholder="Especificar otro formato" style="display: none;">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Documento:</label>
                        <div class="form-row">
                            <input type="text" name="prefijoDocumento" id="prefijoDocumento" readonly class="col"
                                style="text-align: right; background-color: #e9ecef;width: 80%" readonly>
                            <input type="text" id="documento" name="documento" style="display: none">
                            <input type="number" min="1" max="999" id="numeroProducto" name="numeroProducto"
                                class="editable" placeholder="001" onchange="actualizarDocumento()" required class="col"
                                style="width: 80px;margin-right: 150px;">
                        </div>
                    </div>
                    <div class="divider"></div> <!-- Esta es la línea divisora -->
                    <div class="form-group">
                        <div class="form-group">
                            <label>Código Interno/Mastersoft:</label>
                            <input type="text" id="codigo_interno" name="codigo_interno" class="editable" required>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <h2 class="section-title">Detalles de la Especificación:</h2>
                <br>
                <div class="form-row">
                    <div class="form-group">
                        <label>Fecha edición:</label>
                        <input type="date" id="fechaEdicion" name="fechaEdicion" class="editable"
                            value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div class="divider"></div> <!-- Esta es la línea divisora -->
                    <div class="form-group">
                        <label>Versión:</label>
                        <input type="text" id="version" name="version" value="1" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Vigencia:</label>
                        <select name="periodosVigencia" id="periodosVigencia" class="select-style editable"
                            style="width: 38.5%" required>
                            <option>Selecciona la vigencia de esta especificación:</option>
                            <option value=1>1 año</option>
                            <option value=2>2 años</option>
                            <option value=3>3 años</option>
                            <option value=4>4 años</option>
                            <option value=5>5 años</option>
                        </select>
                    </div>

                    <div class="form-group form-group-hidden">
                        <label>Próxima renovación:</label>
                        <input type="date" name="proximaRenovacion" readonly>
                    </div>

                </div>
                <br>
                <br>
                <h2 class="section-title">Flujo de aprobación:</h2>
                <br>
                <div class="form-row">
                    <div class="form-group">
                        <label>Realizado por:</label>
                        <input type="text" id="usuario_editor" name="usuario_editor"
                            value="<?php echo $_SESSION['nombre']; ?>" style="width: 38.5%" readonly>
                        <input type="text" id="user_editor" name="user_editor"
                            value="<?php echo $_SESSION['usuario']; ?>" style="display: none;">

                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Revisión a cargo de:</label>
                        <select name="usuario_revisor" id="usuario_revisor" class="select-style editable"
                            style="width: 38.5%" required>
                            <option>Selecciona el usuario supervisor:</option>
                            <option value="isumonte" selected>Inger Sumonte Rodríguez - Director Calidad</option>
                            <option value="ccamilla">Constanza Camilla Piña - Coordinador Calidad</option>
                            <option value="cpereira">Catherine Pereira García - Jefe de Producción</option>
                            <option value="lsepulveda">Luis Sepúlveda Miranda - Director Técnico</option>

                            <?php if (isset($_SESSION['usuario']) && in_array($_SESSION['usuario'], ['fabarca212', 'lucianoalonso2000', 'javier2000asr'])): ?>
                                <option value="fabarca212">Felipe Abarca - Developer</option>
                                <option value="lucianoalonso2000">Luciano Abarca - Developer</option>
                                <option value="javier2000asr">Javier Sabando - Developer</option>

                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Aprobación a cargo de:</label>
                        <select name="usuario_aprobador" id="usuario_aprobador" class="select-style editable"
                            style="width: 38.5%" required>
                            <option>Selecciona el usuario aprobador:</option>
                            <option value="isumonte">Inger Sumonte Rodríguez - Director Calidad</option>
                            <option value="ccamilla">Constanza Camilla Piña - Coordinador Calidad</option>
                            <option value="cpereira">Catherine Pereira García - Jefe de Producción</option>
                            <option value="lsepulveda" selected>Luis Sepúlveda Miranda - Director Técnico</option>

                            <?php if (isset($_SESSION['usuario']) && in_array($_SESSION['usuario'], ['fabarca212', 'lucianoalonso2000', 'javier2000asr'])): ?>
                                <option value="fabarca212">Felipe Abarca - Developer</option>
                                <option value="lucianoalonso2000">Luciano Abarca - Developer</option>
                                <option value="javier2000asr">Javier Sabando - Developer</option>

                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </fieldset>
            <br>
            <br>
            <h2 class="section-title">Análisis Físico-Químico:</h2>
            <div id="contenedor_analisisFQ">
                <table id="analisisFQ" class="table table-striped table-bordered" width="100%"></table>
                <!-- Aquí se incluirá la tabla desde carga_tablaFQ()-->
            </div>
            <button type="button" id="boton_agrega_analisisFQ">Agregar Análisis</button>
            <br>
            <br>
            <br>
            <h2 class="section-title">Análisis Microbiológico:</h2>
            <div id="contenedor_analisisMB">
                <table id="analisisMB" class="table table-striped table-bordered" width="100%"></table>
                <!-- Aquí se incluirá la tabla desde carga_tablaMB()-->
            </div>
            <button type="button" id="boton_agrega_analisisMB">Agregar Análisis</button>

            <div class="button-container">
                <button type="button" id="guardar" name="guardar" data-accion='crear'
                    class="botones ingControl">Guardar Especificación</button>
                <button type="button" id="editarGenerarVersion" name="editarGenerarVersion"
                    class="botones ingControl" style="background-color: red; color: white;display: none;">Editar y
                    generar nueva versión</button>
                <input type="text" id="id_producto" name="id_producto" style="display: none;">
                <input type="text" id="id_especificacion" name="id_especificacion" style="display: none;">
            </div>
        </form>
    </div>
</body>

</html>
<script>
    var tablaFQ, contadorFilasFQ = 0;
    var tablaMB, contadorFilasMB = 0;
    var opcionesDesplegables = <?php echo json_encode($opciones); ?>;

    function carga_tabla(tipoAnalisis, id = null, datosAnalisis = null) {
        var tabla;
        var contadorFilas = 0;
        var selectorTabla = '#analisis' + tipoAnalisis;
        var botonAgregar = '#boton_agrega_analisis' + tipoAnalisis;
        var accionesVisibles = (id === null);

        // Configuración inicial de DataTable
        tabla = new DataTable(selectorTabla, {
            "paging": false,
            "info": false,
            "searching": false,
            "lengthChange": false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
            },
            columns: [{
                title: 'Análisis'
            },
            {
                title: 'Metodología'
            },
            {
                title: 'Criterio de Aceptación'
            },
            {
                title: 'Acciones',
                visible: accionesVisibles
            }
            ]
        });
        $(botonAgregar).on('click', function () {
            var filaNueva = [
                crearSelectHtml('Analisis' + tipoAnalisis, contadorFilas, 'descripcion_analisis', tipoAnalisis).replace('<select', '<select style="background-color: rgb(244, 250, 194)"'),
                crearSelectHtml('metodologia', contadorFilas, 'metodologia', tipoAnalisis).replace('<select', '<select style="background-color: rgb(244, 250, 194)"'),
                '<textarea rows="4" cols="50" name="analisis' + tipoAnalisis + '[' + contadorFilas +
                '][criterio]" required style="background-color: rgb(244, 250, 194) !important;"></textarea>',
                '<button type="button" class="btn-eliminar">Eliminar</button>'
            ];
            tabla.row.add(filaNueva);
            tabla.draw();
            contadorFilas++;
        });
        if (id === null) { // Creación de una nueva especificación
            $(botonAgregar).show();
        } else { // Edición de una especificación existente
            datosAnalisis.forEach(function (analisis, index) {
                var fila = [
                    crearSelectHtml('Analisis' + tipoAnalisis, index, 'descripcion_analisis', tipoAnalisis,
                        analisis.descripcion_analisis),
                    crearSelectHtml('metodologia', index, 'metodologia', tipoAnalisis, analisis.metodologia),
                    '<textarea rows="4" cols="50" name="analisis' + tipoAnalisis + '[' + index +
                    '][criterio]" readonly>' + analisis.criterios_aceptacion + '</textarea>',
                    '<button type="button" class="btn-eliminar">Eliminar</button>'
                ];
                tabla.row.add(fila).draw(false);
                contadorFilas++;
            });
            $(botonAgregar).hide();
        }

        // Manejo del botón eliminar en la tabla
        $(selectorTabla).on('click', '.btn-eliminar', function () {
            tabla.row($(this).parents('tr')).remove().draw();
        });
    }

    function crearSelectHtml(categoria, contador, campo, tipoAnalisis, valorSeleccionado = '') {
        var opciones = opcionesDesplegables[categoria];
        var htmlSelect = '<select name="analisis' + tipoAnalisis + '[' + contador + '][' + campo +
            ']" class="select-style" onchange="manejarOtro(this, \'' + tipoAnalisis + '\', ' + contador + ', \'' + campo +
            '\')" required>';
        htmlSelect += '<option value="">Selecciona una opción</option>';

        for (var i = 0; i < opciones.length; i++) {
            var selected = opciones[i] === valorSeleccionado ? ' selected' : '';
            htmlSelect += '<option value="' + opciones[i] + '"' + selected + '>' + opciones[i] + '</option>';
        }

        htmlSelect += '</select>';
        return htmlSelect;
    }


    function manejarOtro(selectElement, tipoAnalisis, contador, campo) {
        var valorSeleccionado = selectElement.value;
        var idCampoOtro = 'analisis' + tipoAnalisis + '[' + contador + '][otro' + campo + ']';

        // Eliminar campo de texto para "Otro" si ya existe
        if ($('#' + idCampoOtro).length > 0) {
            $('#' + idCampoOtro).remove();
        }

        if (valorSeleccionado === 'Otro') {
            // Crear y mostrar campo de texto para "Otro"
            var inputOtro = '<input type="text" id="' + idCampoOtro + '" name="' + idCampoOtro +
                '" placeholder="Especificar otr@ ' + campo + '" style="display: inline-block; margin-left: 10px;">';
            $(selectElement).after(inputOtro);
        }
    }


    $('#analisisFQ').on('click', '.btn-eliminar', function () {
        tablaFQ = $('#analisisFQ').DataTable();
        tablaFQ.row($(this).parents('tr')).remove().draw();
    });

    function carga_tablaMB(id = null, accion = null) {
        var tablaMB;
        var contadorFilasMB = 0;

        if (id === null) {
            tablaMB = new DataTable('#analisisMB', {
                "paging": false,
                "info": false,
                "searching": false,
                "lengthChange": false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
                },
                columns: [{
                    title: 'Análisis'
                },
                {
                    title: 'Metodología'
                },
                {
                    title: 'Criterio de Aceptación'
                },
                {
                    title: 'Acciones'
                }
                ]
            });

            $('#boton_agrega_analisisMB').on('click', function () {
                var filaNueva = [
                    crearSelectHtml('AnalisisMB', contadorFilasMB, 'descripcion_analisis', 'MB'),
                    crearSelectHtml('metodologia', contadorFilasMB, 'metodologia', 'MB'),
                    '<textarea rows="4" cols="50" name="analisisMB[' + contadorFilasMB +
                    '][criterio]" required></textarea>',
                    '<button type="button" class="btn-eliminar">Eliminar</button>'
                ];
                tablaMB.row.add(filaNueva).draw(false);
                contadorFilasMB++;
            });
        } else if (accion === 'editar') {
            // Cargar la tabla con datos para la edición
            tablaMB = new DataTable('#analisisMB', {
                "ajax": './backend/calidad/listado_analisis_por_especificacion.php?id=' + id +
                    '&analisis=analisis_MB',
                "columns": [{
                    "data": "descripcion_analisis",
                    "title": "Análisis"
                },
                {
                    "data": "metodologia",
                    "title": "Metodología"
                },
                {
                    "data": "criterios_aceptacion",
                    "title": "Criterio aceptación"
                }
                    //,
                    // {
                    //    "data": null,
                    //     "defaultContent": '<button type="button" class="btn-eliminar">Eliminar</button>',
                    //     "title": "Acciones"
                    // }
                ],
                "paging": false,
                "info": false,
                "searching": false,
                "lengthChange": false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
                }
            });

            // Evento para el botón eliminar en la tabla de edición
            $('#analisisMB').on('click', '.btn-eliminar', function () {
                tablaMB.row($(this).parents('tr')).remove().draw();
            });

            // Ocultar el botón de agregar análisis, si es necesario
            $("#boton_agrega_analisisMB").hide();
        }
    }

    // Asegúrate de llamar a carga_tablaMB con los parámetros adecuados donde corresponda.

    $('#analisisMB').on('click', '.btn-eliminar', function () {
        tablaMB = $('#analisisMB').DataTable();
        tablaMB.row($(this).parents('tr')).remove().draw();
    });

    function calcularProximaRenovacion() {
        var fechaEdicion = $('#fechaEdicion').val();
        var añosVigencia = $('#periodosVigencia').val();
        var proximaRenovacionContainer = $('#proximaRenovacion').closest('.form-group');

        if (fechaEdicion && añosVigencia) {
            var fechaEdicionDate = new Date(fechaEdicion);
            fechaEdicionDate.setFullYear(fechaEdicionDate.getFullYear() + parseInt(añosVigencia));
            $('#proximaRenovacion').val(fechaEdicionDate.toISOString().split('T')[0]);
            proximaRenovacionContainer.show();
        } else {
            proximaRenovacionContainer.hide();
        }
    }

    $('#periodosVigencia').on('change', calcularProximaRenovacion);

    document.getElementById('guardar').addEventListener('click', function (e) {
        if (!validarFormulario()) {
            e.preventDefault(); // Previene el envío del formulario si la validación falla
            $.notify("Revisa que los datos estén correctamente ingresados", "warn");
        } else {
            guardar();
            $.notify("Especificacion guardada con exito", "success");
        }
    });

    function validarFormulario() {
        var valido = true;
        var mensaje = '';
        var accion = $('#guardar').data('accion');
        console.log("acción:", accion);
        // Lista de campos comunes a validar
        var camposComunes = [{
            id: 'codigo_interno',
            nombre: 'Código Interno'
        },
        {
            id: 'version',
            nombre: 'Versión'
        },
        {
            id: 'periodosVigencia',
            nombre: 'Vigencia'
        },
        {
            id: 'fechaEdicion',
            nombre: 'Fecha edición'
        }
        ];

        // Campos específicos para la acción 'crear'
        var camposCrear = [{
            id: 'Tipo_Producto',
            nombre: 'Tipo de Producto'
        },
        {
            id: 'producto',
            nombre: 'Producto'
        },
        {
            id: 'formato',
            nombre: 'Formato'
        },
        {
            id: 'tipo_concentracion',
            nombre: 'Concentración',
            condicion: () => $('#tipo_concentracion').val() !== 'na'
        },
        {
            id: 'numeroProducto',
            nombre: 'Número de Producto'
        }

        ];

        // Función para validar campos
        function validarCampos(campos) {

            campos.forEach(function (campo) {
                var campoElemento = $(`#${campo.id}`);
                if (campoElemento.length && (!campo.condicion || campo.condicion())) {
                    var valorCampo = campoElemento.val();
                    if (!valorCampo || !valorCampo.trim()) {
                        mensaje += `El campo "${campo.nombre}" es obligatorio.\n`;
                        valido = false;
                    }
                }
                console.log('Campo actual:', campo, 'resultado: ', valido);
            });
        }


        // Validar campos comunes
        validarCampos(camposComunes);

        // Validar campos específicos según la acción
        if (accion === 'crear') {
            validarCampos(camposCrear);
        }

        // Validación de análisis
        function validarAnalisis(selector, tipoAnalisis) {
            // Verificar si la tabla tiene filas válidas (excluyendo la fila de 'dataTables_empty')
            if ($(selector).find('tbody tr td.dataTables_empty').length === 0) {
                $(selector).find('tbody tr').each(function (index, element) {
                    // Buscar los selectores específicos para Tipo y Metodología
                    var tipo = $(this).find('select[name*="[descripcion_analisis]"]').val();
                    var metodologia = $(this).find('select[name*="[metodologia]"]').val();
                    var criterio = $(this).find('textarea[name*="[criterio]"]').val();

                    // Depuración adicional
                    console.log(`Fila ${index + 1}:`);
                    console.log('Elemento select Tipo:', $(this).find('select[name*="[descripcion_analisis]"]'));
                    console.log('Elemento select Metodología:', $(this).find('select[name*="[metodologia]"]'));
                    console.log('Tipo:', tipo, 'Metodología:', metodologia, 'Criterio:', criterio);

                    // Validar si algún campo está vacío o tiene un valor inválido
                    if (!tipo || !metodologia || !criterio.trim()) {
                        mensaje += `Todos los campos de Análisis ${tipoAnalisis} son obligatorios en cada fila.\n`;
                        valido = false;
                    }
                });
            } else {
                console.log(`No se encontraron filas válidas en la tabla de ${tipoAnalisis}`);
            }
        }



        // Validar análisis si existen <---- revisar
        validarAnalisis('#analisisFQ', 'Físico-Químicos');
        validarAnalisis('#analisisMB', 'Microbiológicos');

        if (!valido) {
            alert(mensaje);
        }

        return valido;
    }


    function actualizarDocumento() {
        var prefijo = document.getElementById('prefijoDocumento').value;
        var numero = document.getElementById('numeroProducto').value;
        document.getElementById('documento').value = prefijo + numero;
    }

    $('#numeroProducto').on('change', function () {
        actualizarDocumento();
    });

    $('#prefijoDocumento').on('change', function () {
        actualizarDocumento();
    });

    function cargarDatosEspecificacion(id) {
        $.ajax({
            url: './backend/calidad/listado_analisis_por_especificacion.php',
            type: 'GET',
            data: {
                id: id
            },
            success: function (response) {
                procesarDatosEspecificacion(response);

                // Ocultar los botones "Agregar análisis"
                $('#boton_agrega_analisisFQ').hide();
                $('#boton_agrega_analisisMB').hide();

                // Ocultar el botón "Guardar especificación"
                $('#guardar').hide();
                $('#editarGenerarVersion').show();
                // Quitar la clase 'editable' y agregar la clase 'no-editable' a los select
                $('select').removeClass('editable').addClass('no-editable');

                // Quitar la clase 'editable' y agregar la clase 'no-editable' a los input
                $('input').removeClass('editable').addClass('no-editable');
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud: ", status, error);
            }
        });
    }


    function procesarDatosEspecificacion(response) {
        if (!response || !response.productos || !Array.isArray(response.productos)) {
            console.error('Los datos recibidos no son válidos:', response);
            return;
        }

        response.productos.forEach(function (producto) {
            poblarYDeshabilitarCamposProducto(producto);

            // Suponiendo que quieres la primera especificación (ajusta según sea necesario)
            let especificaciones = Object.values(producto.especificaciones || {});
            if (especificaciones.length > 0) {
                let especificacion = especificaciones[0]; // Primera especificación
                let idEspecificacion = especificacion.id; // ID de la especificación

                let analisisFQ = especificacion.analisis.filter(a => a.tipo_analisis === 'analisis_FQ');
                let analisisMB = especificacion.analisis.filter(a => a.tipo_analisis === 'analisis_MB');

                carga_tabla('FQ', idEspecificacion, analisisFQ);
                carga_tabla('MB', idEspecificacion, analisisMB);
            }
        });
    }

    function poblarYDeshabilitarCamposProducto(producto) {

        $('#id_producto').val(producto.id_producto);
        $('#Tipo_Producto').val(producto.tipo_producto).prop('disabled', true);

        $('input[name="producto"]').val(producto.nombre_producto).prop('disabled', true);
        $('input[name="concentracion"]').val(producto.concentracion).prop('disabled', true).show();
        $('#tipo_concentracion').hide();
        $('#formato').val(producto.formato).prop('disabled', true);
        console.log(producto.tipo_producto);
        switch (producto.tipo_producto) {
            case 'Material Envase y Empaque':
                $('input[name="prefijoDocumento"]').val('DCAL-CC-EMEE-');
                break;
            case 'Materia Prima':
                $('input[name="prefijoDocumento"]').val('DCAL-CC-EMP-');
                break;
            case 'Producto Terminado':
                $('input[name="prefijoDocumento"]').val('DCAL-CC-EPT-');
                break;
            case 'Insumo':
                $('input[name="prefijoDocumento"]').val('DCAL-CC-EINS-');
                break;
        }
        $('input[name="numeroProducto"]').val(producto.identificador_producto);
        $('input[name="documento"]').val(producto.documento_producto).prop('readonly', true).show();
        $('input[name="prefijoDocumento"]').hide();
        document.getElementById('numeroProducto').required = false;
        $('input[name="numeroProducto"]').hide();
        let especificacion = Object.values(producto.especificaciones)[0];
        if (especificacion) {
            // Suponiendo que 'fecha_expiracion', 'version', y 'vigencia' están en la especificación
            $('#id_especificacion').val(especificacion.id_especificacion);
            $('#fechaEdicion').val(especificacion.fecha_edicion).prop('readonly', true);
            $('input[name="version"]').val(especificacion.version).prop('readonly',
                true); // Asegúrate de que 'version' exista en tus datos
            $('#periodosVigencia').val(especificacion.vigencia).prop('disabled',
                true); // Asegúrate de que 'vigencia' exista en tus datos
            $('#usuario_editor').val(especificacion.nombre).prop('readonly', true);
            $('#usuario_revisor').val(especificacion.revisado_por).prop('readonly', true);
            $('#usuario_aprobador').val(especificacion.aprobado_por).prop('readonly', true);
            $('#codigo_interno').val(especificacion.codigo_mastersoft).prop('disabled', true);
        }
        //console.log(producto.tipo_producto);
    }

    function mostrarAnalisisFQ(analisis) {
        if ($.fn.DataTable.isDataTable('#analisisFQ')) {
            $('#analisisFQ').DataTable().clear().rows.add(analisis).draw();
        } else {
            $('#analisisFQ').DataTable({
                data: analisis,
                columns: [{
                    title: 'Análisis',
                    data: 'descripcion_analisis'
                },
                {
                    title: 'Metodología',
                    data: 'metodologia'
                },
                {
                    title: 'Criterio aceptación',
                    data: 'criterios_aceptacion'
                },
                {
                    title: 'Acciones',
                    data: null,
                    defaultContent: '', // Puedes cambiar esto si deseas poner contenido por defecto
                    visible: false // Esto oculta la columna
                }
                    // Agrega aquí más columnas si es necesario
                ],
                paging: false,
                info: false,
                searching: false,
                lengthChange: false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
                }
            });
        }
    }

    function mostrarAnalisisMB(analisis) {
        if ($.fn.DataTable.isDataTable('#analisisMB')) {
            $('#analisisMB').DataTable().clear().rows.add(analisis).draw();
        } else {
            $('#analisisMB').DataTable({
                data: analisis,
                columns: [{
                    title: 'Análisis',
                    data: 'descripcion_analisis'
                },
                {
                    title: 'Metodología',
                    data: 'metodologia'
                },
                {
                    title: 'Criterio aceptación',
                    data: 'criterios_aceptacion'
                },
                {
                    title: 'Acciones',
                    data: null,
                    defaultContent: '', // Puedes cambiar esto si deseas poner contenido por defecto
                    visible: false // Esto oculta la columna
                }
                ],
                paging: false,
                info: false,
                searching: false,
                lengthChange: false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
                }
            });
        }
    }

    $('#editarGenerarVersion').click(function () {
        // Resto del código para habilitar edición del formulario...
        $('#guardar').attr('data-accion', 'modificar');
        $('#guardar').show();
        $('#editarGenerarVersion').hide();
        $('input[name="fechaEdicion"]').prop('readonly', false).val(new Date().toISOString().split('T')[0]);
        $('#periodosVigencia').prop('disabled', false).prop('required', true);
        $.notify("Edicion iniciada", "warn");
        // Incrementar la versión en 1 y mantenerla no editable
        var versionActual = parseInt($('input[name="version"]').val()) || 0;
        $('input[name="version"]').val(versionActual + 1);

        // Hacer visible la columna de acciones en ambas tablas

        $('#boton_agrega_analisisFQ').show();
        $('#boton_agrega_analisisMB').show();
        var tablaFQ = $('#analisisFQ').DataTable();
        var tablaMB = $('#analisisMB').DataTable();

        tablaFQ.column(-1).visible(true); // Asumiendo que la columna de acciones es la última
        tablaMB.column(-1).visible(true);

        // Habilitar la adición y eliminación de análisis
        habilitarEdicionAnalisis(tablaFQ);
        habilitarEdicionAnalisis(tablaMB);

        $('#usuario_editor').val("<?php echo $_SESSION['nombre']; ?>").prop('readonly', false);
        $('#usuario_revisor').prop('readonly', false);
        $('#usuario_aprobador').prop('readonly', false);
        $('#codigo_interno').prop('disabled', false);

        // Cambiar el color de fondo de los td en las tablas FQ y MB
        $('#analisisFQ tbody td textarea').css('background-color', 'rgb(244, 250, 194)');
        $('#analisisFQ tbody td select.select-style').css('background-color', 'rgb(244, 250, 194)');
        $('#analisisMB tbody td select.select-style').css('background-color', 'rgb(244, 250, 194)');
        $('#analisisMB tbody td textarea').css('background-color', 'rgb(244, 250, 194)');
        // Agregar la clase 'editable' a todos los input y select
        $('input').removeClass('no-editable').addClass('editable');
        $('select').removeClass('no-editable').addClass('editable');
    });

    function habilitarEdicionAnalisis(tabla) {
        // Asegúrate de que 'tabla' es una instancia válida de DataTable
        if (tabla instanceof $.fn.dataTable.Api) {
            // Obtiene el ID del elemento de tabla y muestra el botón correspondiente
            var tablaId = $(tabla.table().node()).attr('id');
            $(tabla.table().body()).find('textarea').prop('readonly', false);
            $('#boton_agrega_analisis' + tablaId).show();

            // Habilitar la eliminación de análisis existentes
            $('#' + tablaId).on('click', '.btn-eliminar', function () {
                tabla.row($(this).parents('tr')).remove().draw();
            });
        }
    }


    function guardar() {

        var numeroProducto = $('#numeroProducto').val();
        $('#numeroProducto').val(`${numeroProducto}`.padStart(3, '0'));
        var datosFormulario = $('#formulario_especificacion').serialize();
        $.ajax({
            url: 'backend/calidad/especificacion_productoBE.php',
            type: 'POST',
            data: datosFormulario,
            success: function (data) {
                var respuesta = JSON.parse(data);
                if (respuesta.exito) {
                    $('#dynamic-content').load('listado_especificaciones_producto.php', function (response,
                        status, xhr) {
                        if (status == "error") {
                            console.log("Error al cargar el formulario: " + xhr.status + " " + xhr
                                .statusText);
                        } else {
                            console.log('Listado cargado correctamente cargado exitosamente.');
                            carga_listado_especificacionProducto();
                            console.log(respuesta.mensaje); // Manejar el error
                            //table.columns(9).search(buscarId).draw();
                        }
                    });
                } else {
                    console.log(respuesta.mensaje); // Manejar el error
                    $.notify(respuesta.mensaje, "warn")
                    if (respuesta.mensaje == "Sesión no iniciada. Por favor, inicie sesión para continuar.") {
                        setTimeout(function () {
                            window.location.href = './backend/login/logoutBE.php';
                        }, 2000);
                    }
                }
            },
            error: function (xhr, status, error) {
                console.log("Error AJAX: " + error);
            }
        });
    }

    function validateForm() {
        let allValid = [];

        // Lista de IDs a validar
        const fields = [
            'Tipo_Producto',
            'producto',
            'tipo_concentracion',
            'formato',
            'numeroProducto',
            'fechaEdicion',
            'periodosVigencia',
            'usuario_revisor',
            'usuario_aprobador',
            'codigo_interno'
        ];

        fields.forEach(function (fieldId) {
            let field = document.getElementById(fieldId);

            if (field) {
                if (!field.value.trim()) {
                    allValid.push(fieldId);
                    field.classList.add('border');
                    field.classList.add('border-warning');
                } else {
                    field.classList.remove('border');
                    field.classList.remove('border-warning');
                }
            }
        });

        return allValid;
    }
    $('#Tipo_Producto').on('change', function () {
        var tipoProducto = $(this).val();
        var prefijo = '';

        switch (tipoProducto) {
            case 'Material Envase y Empaque':
                prefijo = 'DCAL-CC-EMEE-';
                break;
            case 'Materia Prima':
                prefijo = 'DCAL-CC-EMP-';
                break;
            case 'Producto Terminado':
                prefijo = 'DCAL-CC-EPT-';
                break;
            case 'Insumo':
                prefijo = 'DCAL-CC-EINS-';
                break;
        }

        $('#prefijoDocumento').val(prefijo);
    });


    function verificarOtro(selectId, inputId) {
        var select = document.getElementById(selectId);
        var input = document.getElementById(inputId);
        if (select.value === 'Otro') {
            input.style.display = 'block';
        } else {
            input.style.display = 'none';
            input.value = ''; // Limpiar el campo si "Otro" no está seleccionado
        }
    }



    function actualizarCampos() {
        //$('#guardar').data('accion', 'modificar');
        var seleccion = $('#tipo_concentracion').val();
        var campos = ['concentracion_param1', 'concentracion_param2', 'concentracion_param1_lbl',
            'concentracion_param2_lbl'];

        // Ocultar todos los campos primero
        campos.forEach(function (campo) {
            $('input[name=' + campo + ']').hide();
        });

        // Mostrar y actualizar campos según la selección
        if (['ug/ml', 'mg/ml', 'g/ml', '%/ml', 'UI/ml', '%/g'].includes(seleccion)) {
            $('input[name=concentracion_param1]').val('').show();
            $('input[name=concentracion_param2]').val('').show();
            $('input[name=concentracion_param1_lbl]').val(seleccion.split('/')[0]).show();
            $('input[name=concentracion_param2_lbl]').val(seleccion.split('/')[1]).show();

        } else if (['mg', 'g', 'ml', 'UI'].includes(seleccion)) {
            $('input[name=concentracion_param1]').val('').show();
            $('input[name=concentracion_param1_lbl]').val(seleccion).show();
        }
    }

    function actualizarConcentracion() {
        var param1 = $('input[name=concentracion_param1]').val();
        var param2 = $('input[name=concentracion_param2]').val();
        var tipo = $('#tipo_concentracion').val();

        var concentracion = '';
        if (tipo === 'na') { // Caso "No Aplica"
            concentracion = ''; // La concentración se establece en vacío
        } else if (['ug/ml', 'mg/ml', 'g/ml', '%/ml', 'UI/ml', '%/g'].includes(tipo)) {
            concentracion = param1 + tipo.split('/')[0] + ' / ' + param2 + tipo.split('/')[1];
        } else {
            concentracion = param1 + tipo;
        }
        $('input[name=concentracion]').val(concentracion);
    }


    // Evento change para el select
    $('#tipo_concentracion').change(function () {
        actualizarCampos();
        actualizarConcentracion();
    });

    // Evento change para los inputs de parámetros
    $('input[name=concentracion_param1], input[name=concentracion_param2]').change(actualizarConcentracion);
</script>