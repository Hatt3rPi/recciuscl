<?php
//archivo: pages\CALIDAD_documento_analisisExterno.php
session_start();

if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ingreso de resultados</title>
    <link rel="stylesheet" href="../assets/css/DocumentoAna.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="../assets/css/Modal.css">
    <link rel="stylesheet" href="../assets/css/Botones.css">
</head>

<body>
    <div id="form-container" class="form-container formpadding" style="margin: 0 auto;">
        <div id="Maincontainer">
            <!-- Header -->
            <div id="header-container"
                style="width: 100%; display: flex; justify-content: space-between; align-items: center;">

                <!-- Logo a la izquierda -->
                <div class="header-left" style="flex: 1;">
                    <img src="../assets/images/logo_reccius_medicina_especializada.png" alt="Logo Reccius"
                        style="height: 69px;">
                    <!-- Ajusta la altura según sea necesario -->
                </div>
                <!-- Título Central -->
                <div class="header-center"
                    style="flex: 2; text-align: center; display: flex; flex-direction: column; justify-content: center; align-items: center; font-family: 'Arial', sans-serif; height: 100%;">
                    <p name="pretitulo" id="pretitulo"
                        style="margin: 0; font-size: 11px; font-weight: bold; color: #000;">Solicitud de Análisis
                        Externo
                        Control de Calidad
                        <!-- Pretitulo -->
                    </p>
                    <h1 id="Tipo_Producto" name="Tipo_Producto"
                        style="margin: 0; font-size: 11px; font-weight: normal; color: #000; line-height: 1.2;">
                        <!-- Título del documento -->
                    </h1>
                    <p name="nombre_producto" id="nombre_producto"
                        style="margin: 0; font-size: 11px; font-weight: bold; color: #000;">
                        <!-- Descripción del producto -->
                    </p>
                    <hr style="width:75%; margin-top: 2px; margin-bottom: 1px;">
                    <div style="position: relative; font-size: 11px; font-weight: bold; color: #000; margin-top: 2px;">
                        Dirección de Calidad
                    </div>
                </div>
                <!-- Información Derecha con Tabla -->
                <div class="header-right"
                    style="font-size: 10px; font-family: 'Arial', sans-serif;flex: 2; text-align: right">
                    <table id="panel_informativo" name="panel_informativo"
                        style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
                        <tr>
                            <td>N° Registro:</td>
                            <td name="numero_registro" id="numero_registro"></td>
                        </tr>
                        <tr>
                            <td>N° Versión:</td>
                            <td name="version" id="version"></td>
                        </tr>
                        <tr>
                            <td>N° Solicitud:</td>
                            <td name="numero_solicitud" id="numero_solicitud"></td>
                        </tr>
                        <tr>
                            <td>Fecha :</td>
                            <td id="fecha_registro" name="fecha_registro">

                            </td>
                        </tr>
                    </table>
                </div>

            </div>
            <!-- Body -->
            <form id="section1">
                <table>
                    <tr>
                        <td class="Subtitulos" colspan="4">I. INFORMACIÓN GENERAL</td>
                    </tr>
                    <tr>
                        <td class="titulo">1. Laboratorio Analista:(*)</td>
                        <td><input type="text" id="laboratorio" name="laboratorio" required readonly></td>
                        <td class="titulo titulo-right">Tipo de Analisis:</td>
                        <td><input type="text" id="tipo_analisis" name="tipo_analisis" required readonly></td>

                    </tr>
                    <tr>
                        <td class="titulo">2. Fecha de Solicitud:(*)</td>
                        <td><input type="text" id="fecha_solicitud" name="fecha_solicitud" readonly required></td>

                    </tr>
                    <tr>
                        <td class="titulo">3. Análisis según:(**)</td>
                        <td><input type="text" id="analisis_segun" name="analisis_segun" readonly required></td>
                    </tr>

                    <tr>
                        <td class="titulo">4. Fecha de Cotización:(**)</td>
                        <td><input type="text" id="fecha_cotizacion" name="fecha_cotizacion" readonly required></td>
                        <td class="titulo titulo-right">N° Cotización:</td>
                        <td><input type="text" id="numero_documento" name="numero_documento" readonly required></td>
                    </tr>
                    <tr>
                        <td class="titulo">5. Estandar Provisto por:(**)</td>
                        <td><input type="text" id="estandar_segun" name="estandar_segun" readonly required></td>
                        <!-- <td class="titulo titulo-right">Otro:</td>
                        <td><input type="text" id="estandar_otro" name="estandar_otro"></td> -->
                    </tr>
                    <tr>
                        <td class="titulo">6. Adjunta HDS:(***)</td>
                        <!-- <td><input type="text" id="hds_adjunto" name="hds_adjunto" required></td>
                        <td class="titulo titulo-right">Otro:</td> -->
                        <td><input type="text" id="hds_otro" name="hds_otro" readonly></td>
                    </tr>
                    <tr>
                        <td class="titulo">7. Fecha de Entrega estimada:</td>
                        <td><input type="text" id="fecha_entrega_estimada" name="fecha_entrega_estimada" readonly
                                required></td>
                    </tr>
                    <!-- Continúa agregando más filas según los campos requeridos -->
                </table>

            </form>
            <!-- Sección II: MUESTREO -->
            <form id="section2">
                <table>
                    <tr>
                        <td class="Subtitulos" colspan="4">II. INFORMACIÓN PRODUCTO TERMINADO</td>
                    </tr>
                    <tr>
                        <td class="titulo">1. Nombre producto:</td>
                        <td>
                            <div id="nombre_producto2" name="nombre_producto2" class="editable-div border-dark border"
                                readonly></div>
                        </td>


                        <td class="titulo titulo-right">10. T. de lote:</td>
                        <td><input type="text" id="tamano_lote" name="tamano_lote" required readonly></td>

                    </tr>
                    <tr>
                        <td class="titulo">2. Presentación:</td>
                        <td><input type="text" id="formato" name="formato" required readonly></td>
                        <td class="titulo titulo-right">11. Fecha Elab.:</td>
                        <td><input type="text" id="fecha_elaboracion" name="fecha_elaboracion" readonly required></td>

                    </tr>
                    <tr>
                        <td class="titulo">3. Serie o lote:</td>
                        <td><input type="text" id="lote" name="lote" readonly required></td>
                        <td class="titulo titulo-right">12. Fecha Vence:</td>
                        <td><input type="text" id="fecha_vencimiento" name="fecha_vencimiento" readonly required></td>

                    </tr>
                    <tr>
                        <td class="titulo">4. Código interno:</td>
                        <td><input type="text" id="codigo_mastersoft" name="codigo_mastersoft" readonly required></td>

                        <td class="titulo titulo-right">13. Muestra:</td>
                        <td><input type="text" id="tamano_muestra" name="tamano_muestra" readonly required></td>
                    </tr>
                    <tr>
                        <td class="titulo">5. Muestreado según POS:</td>
                        <td><input type="text" id="numero_pos" name="numero_pos" readonly required></td>
                        <td class="titulo titulo-right">14. Cta.muestra</td>
                        <td><input type="text" id="tamano_contramuestra" name="tamano_contramuestra" readonly></td>
                    </tr>
                    <tr>
                        <td class="titulo">6. Fabricante:</td>
                        <td><input type="text" id="elaborado_por" name="elaborado_por" readonly required></td>
                        <!-- <td class="titulo titulo-right">Otro:</td>
                        <td><input type="text" id="otro3" name="otro3"></td> -->
                    </tr>
                    <tr>
                        <td class="titulo">7. Muestreado por:</td>
                        <td><input type="text" id="muestreado_por" name="muestreado_por" readonly required></td>


                    </tr>
                    <tr>

                        <td class="titulo">8. Condic. almacenamiento</td>
                        <td>
                            <div id="condicion_almacenamiento" name="condicion_almacenamiento"
                                class="editable-div border-dark border" readonly></div>
                        </td>

                        <td class="titulo titulo-right">Observaciones:</td>
                        <td>
                            <div id="observaciones" name="observaciones" class="editable-div border-dark border"
                                readonly required></div>
                        </td>

                    </tr>
                    <tr>

                        <td class="titulo">9. Registro I.S.P:</td>
                        <td>
                            <div id="registro_isp" name="registro_isp" class="editable-div border-dark border" readonly
                                required></div>
                        </td>


                    </tr>
                    <!-- Continúa agregando más filas según los campos requeridos -->
                </table>

            </form>
            <!--height: 0;-->
            <form id="section4" <?php
            $etapa = $_POST['etapa'];
            if ($etapa == '0') {
                echo 'style="visibility: hidden;"';
            }
            ?>>
                <table>
                    <tr>
                        <td class="Subtitulos" colspan="4">III. DATOS DEL ANÁLISIS SOLICITADO</td>
                    </tr>
                    <tr>
                        <td class="titulo">1. Numero de análisis:</td>
                        <td>
                            <input type="text" class="<?php
                            $etapa = $_POST['etapa'];
                            $result = $_POST['resultados'];
                            if ($etapa == '1' && $result == 'true') {
                                echo '';
                            } else {
                                echo 'input-highlight';
                            }
                            ?>" id="laboratorio_nro_analisis" name="laboratorio_nro_analisis" editable required>
                        </td>
                        <td class="titulo titulo-right">2. Certificado de análisis:</td>
                        <td>
                            <label for="certificado_de_analisis_externo" id="certificado_de_analisis_externo_label"
                                class="label__like-input <?php
                                $etapa = $_POST['etapa'];
                                $result = $_POST['resultados'];
                                if ($etapa == '1' && $result == 'true') {
                                    echo '';
                                } else {
                                    echo 'input-highlight';
                                }
                                ?>">
                                <span>
                                    <img src="../assets/images/especificaciones.svg" height="20px" width="20px"
                                        alt="file image">
                                </span> &nbsp Seleccione un archivo
                            </label>
                            <input type="file" accept="application/pdf" id="certificado_de_analisis_externo"
                                name="certificado_de_analisis_externo" required style="display: none;">
                        </td>
                    </tr>
                    <tr>
                        <td class="titulo">3. Fecha de Entrega:</td>
                        <td>
                            <input type="text" id="fecha_entrega" name="fecha_entrega" class="datepicker <?php
                            $etapa = $_POST['etapa'];
                            $result = $_POST['resultados'];
                            if ($etapa == '1' && $result == 'true') {
                                echo '';
                            } else {
                                echo 'input-highlight';
                            }
                            ?>" placeholder="dd/mm/aaaa" value="<?php echo date('d/m/Y'); ?>" required>
                        </td>
                        <td class="titulo titulo-right">4. Fecha de análisis:</td>
                        <td>
                            <input type="text" id="laboratorio_fecha_analisis" name="laboratorio_fecha_analisis" class="datepicker <?php
                            $etapa = $_POST['etapa'];
                            $result = $_POST['resultados'];
                            if ($etapa == '1' && $result == 'true') {
                                echo '';
                            } else {
                                echo 'input-highlight';
                            }
                            ?>" placeholder="dd/mm/aaaa" value="<?php echo date('d/m/Y'); ?>" required>
                        </td>
                    </tr>
                </table>
            </form>
            <form id="section3">
                <table id="analisis-solicitados">
                    <tr>
                        <td class="Subtitulos" colspan="4">IV. ANÁLISIS SOLICITADOS</td>
                    </tr>
                    <tr class="bordeAbajo">
                        <th class="tabla">Análisis</th>
                        <th class="tabla">Metodología</th>
                        <th class="tabla">Especificación</th>
                        <th class="tabla">Resultados</th>
                        <th class="tabla">Revisión</th>
                    </tr>
                </table>

            </form>
            <!-- Footer -->
            <br>
            <form id="footer-container">
                <div class="footer-containerDIV">
                    <!-- Sección Realizado por -->
                    <div class="firma-section">
                        <div class="firma-box-title">Solicitado por:</div>
                        <div class="firma-boxes">
                            <p id='solicitado_por_name' name='solicitado_por_name' class="bold"></p>
                            <p id="cargo_solicitador" name="cargo_solicitador" class="bold">
                            </p>
                            <div class="signature">
                                <!-- Agregar la imagen aquí -->
                                <img id="solicitado_por_firma"
                                    src="https://customware.fabarca212.workers.dev/assets/firma_null.webp" alt="Firma"
                                    class="firma">

                            </div>
                        </div>
                        <div class="date-container">
                            <div id='fecha_firma1' name='fecha_firma1' class="date" style="display: none;">Fecha:
                                dd/mm/yyyy</div>
                            <p id='mensaje_firma1' name='mensaje_firma1' class="text-bottom" style="display: none;">
                                Firmado digitalmente</p>
                            <p id='user_firma1' name='user_firma1' style="display: none;" style="display: none;"></p>
                        </div>
                    </div>
                    <!-- Sección Realizado por -->
                    <div class="firma-section">
                        <div class="firma-box-title">Revisado por:</div>
                        <div class="firma-boxes">
                            <p id='revisado_por_name' name='revisado_por_name' class="bold">
                            </p>
                            <p id="cargo_revisador" name="cargo_revisador" class="bold">
                            </p>
                            <div class="signature">
                                <!-- Agregar la imagen aquí -->
                                <img id="revisado_por_firma"
                                    src="https://customware.fabarca212.workers.dev/assets/firma_null.webp" alt="Firma"
                                    class="firma">

                            </div>
                        </div>
                        <div class="date-container">
                            <div id='fecha_firma2' name='fecha_firma2' class="date" style="display: none;">Fecha:
                                dd/mm/yyyy</div>
                            <p id='mensaje_firma2' name='mensaje_firma2' class="text-bottom" style="display: none;">
                                Firmado digitalmente</p>
                            <p id='user_firma1' name='user_firma1' style="display: none;" style="display: none;"></p>
                        </div>
                    </div>

                </div>

                <footer class="TextoBajo">
                    <p class="ParrafoBajo">
                        (*) Campo Obligatorio<br>
                        (**) Llenar según lista desplegable<br>
                        (***) Hoja de Seguridad<br>
                        La información contenida en esta solicitud de análisis se considerará como respaldo sanitario
                        válido. El certificado de análisis solo debe disponer de la información vertida en esta
                        solicitud.
                        La información contenida en esta solicitud es de carácter CONFIDENCIAL y es considerada SECRETO
                        INDUSTRIAL.
                    </p>
                </footer>
            </form>
        </div>


</body>
<div class="button-container" id="button-container">
    <?php
    $etapa = $_POST['etapa'];
    $highlightClass = ($etapa != '0') ? 'input-highlight' : '';

    if ($etapa == '0') {
        echo '  <button class="botones ana" id="upload-pdf">Guardar PDF</button>
                <button class="botones ana" id="download-pdf">Descargar PDF</button>';
    } else {
        echo '  <button class="botones ana" id="revisar" style="display: none;">Revisar</button>
                <button class="botones ana" id="download-pdf" style="display: none;">Descargar PDF</button>';
    }
    ?>

</div>

<div id="notification" class="notification-container notify" style="display: none;">
    <p id="notification-message">Este es un mensaje de notificación.</p>
</div>
<div id="modalLoading" class="modalRechazo" style="display: none">
    <div class="modal-contentRechazo">
        <div class="spinner-border" role="status">
            <span class="sr-only"></span>

        </div>
        <p>Procesando documento</p>
    </div>
</div>

</html>
<script>
    var idAnalisisExterno_acta = null;

    $(document).ready(function () {
        function downloadPDF(save) {
            document.getElementById('modalLoading').style.display = 'block';
            const {
                jsPDF
            } = window.jspdf;

            $('#button-container').hide();

            const pdf = new jsPDF('p', 'mm', [279, 216]);
            const pageHeight = 279;
            const margin = 5;
            let currentY = margin;

            const addSectionToPDF = (sectionId, yOffset = currentY, addNewPage = false) => {
                const elementToExport = document.getElementById(sectionId);

                if (elementToExport) {
                    elementToExport.style.border = 'none';
                    elementToExport.style.boxShadow = 'none';

                    return html2canvas(elementToExport, {
                        scale: 2
                    }).then(canvas => {
                        $.notify("Generando PDF...", "warning");
                        const imgData = canvas.toDataURL('image/jpeg', 1.0);
                        const imgWidth = 216 - 2 * margin;
                        const imgHeight = canvas.height * imgWidth / canvas.width;

                        if (addNewPage) {
                            pdf.addPage();
                            currentY = margin;
                        }

                        pdf.addImage(imgData, 'JPEG', margin, yOffset, imgWidth, imgHeight);
                        currentY = yOffset + imgHeight + margin;
                    });
                } else {
                    return Promise.resolve();
                }
            };

            const distributeHeight = (totalHeight, numberOfSections) => {
                return (totalHeight - (margin * (numberOfSections + 1))) / numberOfSections;
            };

            const availableHeight = pageHeight - (2 * margin + 50);
            const sectionHeight = distributeHeight(availableHeight, 3);

            addSectionToPDF('header-container')
                .then(() => addSectionToPDF('section1', currentY, false, sectionHeight))
                .then(() => addSectionToPDF('section2', currentY, false, sectionHeight))
                .then(() => addSectionToPDF('section4', currentY, false, sectionHeight))
                .then(() => addSectionToPDF('footer-container', pageHeight - 50))
                .then(() => addSectionToPDF('header-container', margin, true))
                .then(() => addSectionToPDF('section3', currentY))
                .then(() => addSectionToPDF('footer-container', pageHeight - 50))
                .then(() => {
                    var nombreProducto = document.getElementById('nombre_producto').textContent.trim();
                    var nombreDocumento = document.getElementById('numero_registro').textContent.trim();
                    if (!save) {
                        pdf.save(`${nombreDocumento} ${nombreProducto}.pdf`);
                        $.notify("PDF generado con éxito", "success");
                        document.getElementById('modalLoading').style.display = 'none';
                        return;
                    }
                    var blob = pdf.output('blob');

                    var formData = new FormData();
                    formData.append('certificado', blob, `${nombreDocumento}_${nombreProducto}.pdf`);
                    formData.append('type', 'solicitud');
                    formData.append('id_solicitud', idAnalisisExterno);

                    fetch('./backend/calidad/add_documentos.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                $.notify("PDF subido con éxito", "success");
                                document.getElementById('modalLoading').style.display = 'none';
                            } else {
                                $.notify("Error al subir el PDF: " + data.message, "error");
                                document.getElementById('modalLoading').style.display = 'none';
                            }
                        })
                        .catch(error => {
                            console.error('Error al subir el PDF:', error);
                            $.notify("Error al subir el PDF", "error");
                            document.getElementById('modalLoading').style.display = 'none';
                        });
                })
                .finally(() => {
                    $('#button-container').show();
                });
        }

        const uploadButton = document.getElementById('upload-pdf');
        if (uploadButton) {
            uploadButton.addEventListener('click', function () {
                downloadPDF(true);
            });
        }

        const downloadButton = document.getElementById('download-pdf');
        if (downloadButton) {
            downloadButton.addEventListener('click', function () {
                downloadPDF(false);
            });
        }
    });

    // Función para mostrar u ocultar la columna de revisión
    function toggleRevisionColumn() {
        // Seleccionar todas las celdas y el encabezado de la columna Revisión
        const revisionCells = document.querySelectorAll('.revision');
        const revisionHeader = document.querySelector('th.revision');

        if (primeravez) {
            // Ocultar las celdas y el encabezado si primeravez es true
            revisionCells.forEach(cell => {
                cell.style.display = 'none';
            });
            if (revisionHeader) {
                revisionHeader.style.display = 'none';
            }
        } else {
            // Mostrar las celdas y el encabezado si primeravez es false
            revisionCells.forEach(cell => {
                cell.style.display = '';
            });
            if (revisionHeader) {
                revisionHeader.style.display = '';
            }
        }
    }

    $(document).ready(function () {
        // Cargar datos iniciales
        loadData();

        $('#certificado_de_analisis_externo').on('change', function () {
            var fileName = $(this).val().split('\\').pop();
            $('#certificado_de_analisis_externo_label').text(fileName);
        });

        $('input[type="text"].datepicker').datepicker({
            format: 'dd/mm/yyyy', // Formato global de fecha
            language: 'es',
            autoclose: true,
            todayHighlight: true
            //,startDate: new Date()
        });
    });
    var usuarioActual = "<?php echo $_SESSION['usuario']; ?>";
    var idAnalisisExterno = <?php echo json_encode($_POST['id'] ?? ''); ?>;

    var datosFirma2 = {};

    function loadData() {
        console.log("Iniciando función loadData()");
        $.ajax({
            url: './backend/analisis/ingresar_resultados_analisis.php',
            type: 'GET',
            data: {
                id_acta: idAnalisisExterno
            },
            dataType: 'json', // Asegúrate de que la respuesta esperada es JSON
            success: function (response) {
                console.log("AJAX Success:", response);

                // Suponiendo que la respuesta tiene dos partes principales
                const analisis = response.analisis; // Datos del análisis externo
                console.log("Datos de 'analisis':", analisis);

                // Poblar la tabla III. ANÁLISIS SOLICITADOS
                const analisisSolicitados = response.analiDatos;
                console.log("Datos de 'analisisSolicitados':", analisisSolicitados);

                const table = $('#analisis-solicitados');
                const highlight = "<?php
                $etapa = $_POST['etapa'];
                if ($etapa == '0') {
                    echo '';
                } else {
                    echo 'input-highlight';
                }
                ?>";
        console.log("Valor de 'highlight':", highlight);

        analisisSolicitados.forEach(function (analisis, index) {
            console.log(`Procesando analisisSolicitados[${index}]:`, analisis);
            const row = `
                    <tr class="bordeAbajo checkLine" data-id="${analisis.anali_id_analisis}">
                        <td class="tituloTabla">${analisis.anali_descripcion_analisis}:</td>
                        <td class="Metod">${analisis.anali_metodologia}</td>
                        <td class="Espec">${analisis.anali_criterios_aceptacion}</td>
                        <td class="resultados editable-div" style="background-color: rgb(244, 250, 194) !important; ${analisis.anali_resultado_laboratorio ? '' : highlight
                }" contenteditable="${analisis.anali_resultado_laboratorio ? 'false' : 'true'}">${analisis.anali_resultado_laboratorio ? analisis.anali_resultado_laboratorio : ''}</td>
                        <td class="revision ${analisis.anali_resultado_laboratorio ? '' : 'input-highlight'}" <?php
                        $etapa = $_POST['etapa'];
                        if ($etapa == '0') {
                            echo 'style="visibility: hidden;height: 0;"';
                        } ?>>
                            <div class="btn-group-vertical " role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check cumple" name="btn-check-${index}" id="btn-check-a-${index}" value="1" autocomplete="off">
                                <label class="btn btn-outline-success verificadores" for="btn-check-a-${index}"><i class="fa-regular fa-circle-check"></i> Cumple</label>
                                <input type="radio" class="btn-check noCumple" name="btn-check-${index}" id="btn-check-b-${index}" value="0" autocomplete="off">
                                <label class="btn btn-outline-danger verificadores" for="btn-check-b-${index}"><i class="fa-regular fa-circle-xmark"></i> No Cumple</label>
                            </div>
                        </td>
                    </tr>`;
            table.append(row);
        });

        if (analisis && analisis.length > 0) {
            console.log("Analisis tiene datos.");
            const primerAnalisis = analisis[0];
            console.log("Datos de 'primerAnalisis':", primerAnalisis);

            idAnalisisExterno_acta = primerAnalisis.id;

            // Actualizar los inputs con los datos del análisis
            // TABLA HEADER
            $('#numero_registro').text(primerAnalisis.numero_registro);
            $('#version').text(primerAnalisis.version);
            $('#numero_solicitud').text(primerAnalisis.numero_solicitud);
            $('#fecha_registro').text(primerAnalisis.fecha_registro);

            // Sumar los resultados de producto en un solo texto
            var productoCompleto =
                (primerAnalisis.prod_nombre_producto != null ? primerAnalisis.prod_nombre_producto : '') + ' ' +
                (primerAnalisis.prod_concentracion != null ? primerAnalisis.prod_concentracion : '') + ' ' +
                (primerAnalisis.prod_formato != null ? primerAnalisis.prod_formato : '');
            console.log("Producto completo:", productoCompleto);

            // Actualizar el elemento con el texto combinado
            $('#nombre_producto').text(productoCompleto);
            $('#nombre_producto2').text(productoCompleto);

            // TÍTULO TABLA
            $('#Tipo_Producto').text(primerAnalisis.prod_tipo_producto);

            // TABLA 1
            $('#laboratorio').val(primerAnalisis.laboratorio);
            $('#fecha_solicitud').val(moment(primerAnalisis.fecha_solicitud, 'YYYY-MM-DD').format('DD/MM/YYYY'));
            $('#analisis_segun').val(primerAnalisis.analisis_segun);
            $('#numero_documento').val(primerAnalisis.numero_documento);
            $('#fecha_cotizacion').val(moment(primerAnalisis.fecha_cotizacion, 'YYYY-MM-DD').format('DD/MM/YYYY'));
            $('#estandar_segun').val(primerAnalisis.estandar_segun);
            $('#codigo_mastersoft').val(primerAnalisis.codigo_mastersoft);

            $('#hds_otro').val(primerAnalisis.hds_otro);
            $('#fecha_entrega_estimada').val(moment(primerAnalisis.fecha_entrega_estimada, 'YYYY-MM-DD').format('DD/MM/YYYY'));

            // TABLA 2
            $('#formato').val(primerAnalisis.prod_formato);
            $('#lote').val(primerAnalisis.lote);
            $('#tamano_lote').val(primerAnalisis.tamano_lote);
            $('#fecha_elaboracion').val(moment(primerAnalisis.fecha_elaboracion, 'YYYY-MM-DD').format('DD/MM/YYYY'));
            $('#fecha_vencimiento').val(moment(primerAnalisis.fecha_vencimiento, 'YYYY-MM-DD').format('DD/MM/YYYY'));
            $('#registro_isp').text(primerAnalisis.registro_isp);
            $('#tamano_muestra').val(primerAnalisis.tamano_muestra);
            $('#condicion_almacenamiento').text(primerAnalisis.condicion_almacenamiento);
            $('#tamano_contramuestra').val(primerAnalisis.tamano_contramuestra);
            $('#elaborado_por').val(primerAnalisis.elaborado_por);
            $('#muestreado_por').val(primerAnalisis.nombre_muestreado_por);
            $('#observaciones').text(primerAnalisis.observaciones);
            $('#numero_pos').val(primerAnalisis.numero_pos);
            $('#codigo_mastersoft').val(primerAnalisis.codigo_mastersoft);

            // Otros campos
            $('#estado').val(primerAnalisis.estado);
            $('#tipo_analisis').val(primerAnalisis.tipo_analisis);

            // III
            if (primerAnalisis.estado !== "Pendiente ingreso resultados") {
                console.log("El estado no es 'Pendiente ingreso resultados'.");
                $("#laboratorio_nro_analisis").val(primerAnalisis.laboratorio_nro_analisis);
                $("#fecha_entrega").val(primerAnalisis.fecha_entrega);
                $("#laboratorio_fecha_analisis").val(primerAnalisis.laboratorio_fecha_analisis);
                $("#certificado_de_analisis_externo_label")
                    .attr("type", "text")
                    .html(`<span>
                        <img src="../assets/images/especificaciones.svg" height="20px" width="20px" alt="file image">
                        </span> &nbsp; 
                        <a href="${primerAnalisis.url_certificado_de_analisis_externo}" target="_blank">Ver Certificado</a>`);

                var resultList = primerAnalisis.resultados_analisis == null ? [] : JSON.parse(primerAnalisis.resultados_analisis.replace(/^"|"$/g, ''));
                console.log('Lista de resultados:', resultList);

                resultList.forEach((res, index) => {
                    console.log(`Procesando resultList[${index}]:`, res);
                    if (res === 1) {
                        $(`#btn-check-a-${index}`).prop('checked', true);
                    } else if (res === 0) {
                        $(`#btn-check-b-${index}`).prop('checked', true);
                    }
                    $(`#btn-check-a-${index}`).prop('disabled', true);
                    $(`#btn-check-b-${index}`).prop('disabled', true);
                });

                $("#laboratorio_nro_analisis").prop("readonly", true);
                $("#certificado_de_analisis_externo_label").prop("readonly", true);
                $("#fecha_entrega").prop("readonly", true);
                $("#laboratorio_fecha_analisis").prop("readonly", true);

                $("#download-pdf").show();
                $("#revisar").hide();

            } else {
                console.log('Estado es "Pendiente ingreso resultados".');
                console.log('No hay certificado disponible.');
                console.log('Comparando primerAnalisis.revisado_por:', primerAnalisis.revisado_por, 'con usuario de sesión:', "<?php echo $_SESSION['usuario'] ?>");

                if (primerAnalisis.revisado_por === "<?php echo $_SESSION['usuario'] ?>") {
                    $("#revisar").show();
                    // Cambiar la clase del input con id="laboratorio"
                    $('#laboratorio_nro_analisis').addClass('input-highlight');     // Agrega la nueva clase
                    $('#certificado_de_analisis_externo_label').addClass('input-highlight');     // Agrega la nueva clase
                    $('#fecha_entrega').addClass('input-highlight');     // Agrega la nueva clase
                    $('#laboratorio_fecha_analisis').addClass('input-highlight');     // Agrega la nueva clase
                }
            }

            if (primerAnalisis.firmas) {
                console.log('Datos de firmas:', primerAnalisis.firmas);
                var soli = primerAnalisis.firmas.solicitado_por;
                var revis = primerAnalisis.firmas.revisado_por;
                console.log('Solicitado por:', soli);
                console.log('Revisado por:', revis);

                if (primerAnalisis.solicitado_por) {
                    $("#fecha_firma1").text(primerAnalisis.fecha_firma_1).show();
                    $("#mensaje_firma1").show();
                    $("#solicitado_por_name").text(soli.nombre).show();
                    $("#cargo_solicitador").text(soli.cargo).show();

                    if (soli.qr_documento) {
                        var qr = soli.qr_documento;
                        console.log('QR del documento (solicitado_por):', qr);
                        fetch(qr).then(resp => resp.blob()).then(blob => new Promise((resolve, _) => {
                            const reader = new FileReader();
                            reader.onloadend = () => resolve(reader.result);
                            reader.readAsDataURL(blob);
                        })).then((data) => {
                            console.log("Datos del QR (solicitado_por):", data);
                            $("#solicitado_por_firma").attr("src", data);
                        });
                    }
                    if (soli.qr_documento === null && soli.foto_firma) {
                        console.log('Usando foto de firma (solicitado_por).');
                        fetch(soli.foto_firma).then(resp => resp.blob()).then(blob => new Promise((resolve, _) => {
                            const reader = new FileReader();
                            reader.onloadend = () => resolve(reader.result);
                            reader.readAsDataURL(blob);
                        })).then((data) => {
                            console.log("Datos de la foto de firma (solicitado_por):", data);
                            $("#solicitado_por_firma").attr("src", data);
                        });
                    }
                }
                if (primerAnalisis.revisado_por && primerAnalisis.laboratorio_fecha_analisis) {
                    $("#fecha_firma2").text(primerAnalisis.fecha_firma_2).show();
                    $("#mensaje_firma2").show();
                    $("#revisado_por_name").text(revis.nombre).show();
                    $("#cargo_revisador").text(revis.cargo).show();

                    if (revis.qr_documento) {
                        console.log('QR del documento (revisado_por):', revis.qr_documento);
                        fetch(revis.qr_documento).then(resp => resp.blob()).then(blob => new Promise((resolve, _) => {
                            const reader = new FileReader();
                            reader.onloadend = () => resolve(reader.result);
                            reader.readAsDataURL(blob);
                        })).then((data) => {
                            console.log("Datos del QR (revisado_por):", data);
                            $("#revisado_por_firma").attr("src", data);
                        });
                    }
                    if (revis.qr_documento === null && revis.foto_firma) {
                        console.log('Usando foto de firma (revisado_por).');
                        fetch(revis.foto_firma).then(resp => resp.blob()).then(blob => new Promise((resolve, _) => {
                            const reader = new FileReader();
                            reader.onloadend = () => resolve(reader.result);
                            reader.readAsDataURL(blob);
                        })).then((data) => {
                            console.log("Datos de la foto de firma (revisado_por):", data);
                            $("#revisado_por_firma").attr("src", data);
                        });
                    }
                } else {
                    var datosFirma2 = {
                        fecha: primerAnalisis.laboratorio_fecha_analisis,
                        nombre: revis.nombre,
                        cargo: revis.cargo,
                        firma: revis.qr_documento ? revis.qr_documento : revis.foto_firma
                    };
                    console.log("Datos para firma 2:", datosFirma2);
                }
            }
        } else {
            console.log("El array 'analisis' está vacío o es indefinido.");
        }

        // Manejo de Acta Muestreo
        const actaMuestreo = response.Acta_Muestreo;
        console.log("Datos de 'Acta_Muestreo':", actaMuestreo);

        if (actaMuestreo && actaMuestreo.length > 0) {
            const ultimaActa = actaMuestreo[0];
            console.log("Última acta de muestreo:", ultimaActa);
            // Poblar campos adicionales de acta de muestreo si es necesario
        }
    },
    error: function(xhr, status, error) {
        console.error('Error en AJAX:', error);
        console.error('Estado:', status);
        console.error('Respuesta completa:', xhr);
        console.error('Respuesta del servidor:', xhr.responseText);
        alert("Error en carga de datos. Revisa la consola para más detalles.");
    }
        });
    }


    $(document).ready(function () {

        function firma2Fn() {
            var now = new Date();
            $("#fecha_firma2").text('<?php echo date("Y-m-d"); ?>').show();
            $("#mensaje_firma2").show();
            $("#revisado_por_name").text(datosFirma2.nombre).show()
            $("#cargo_revisador").text(datosFirma2.cargo).show()

            if (datosFirma2.firma) {
                fetch(datosFirma2.firma).then(resp => resp.blob()).then(blob => new Promise((resolve, _) => {
                    const reader = new FileReader();
                    reader.onloadend = () => resolve(reader.result);
                    reader.readAsDataURL(blob);
                })).then((data) => {
                    console.log("revisado_por.qr_documento", data)
                    $("#revisado_por_firma").attr("src", data);
                })
            }
        }


        $("#revisar").on("click", function () {
            let cumple = true;
            let results = [];
            let resultadoTextos = [];



            $(".checkLine").each(function () {
                $(this).css("background-color", "transparent");
                const resultadoText = $(this).find(".resultados").text().trim();
                const idAnalisis = $(this).data('id');
                const cumpleChecked = $(this).find(".cumple").is(":checked");
                const noCumpleChecked = $(this).find(".noCumple").is(":checked");
                if (cumpleChecked === noCumpleChecked) {
                    cumple = false;
                    $(this).css("background-color", "#ff222d25");
                } else {
                    results.push(cumpleChecked ? 1 : 0);
                }
                const resultado = {
                    resultadoText,
                    idAnalisis
                };
                resultadoTextos.push(resultado);
            });

            if (!cumple) {
                console.log("Hay campos sin revisar.", "warning");
                $.notify("Hay campos sin revisar.", "warning");
                return;
            }

            var laboratorio_nro_analisis = $("#laboratorio_nro_analisis").val();
            var laboratorio_fecha_analisis = $("#laboratorio_fecha_analisis").val();
            var fecha_entrega = $("#fecha_entrega").val();

            if (!laboratorio_nro_analisis || !laboratorio_fecha_analisis || !fecha_entrega) {
                console.log("Todos los campos de la sección IV deben estar llenos.", "warning");
                $.notify("Todos los campos de la sección IV deben estar llenos.", "warning");
                return;
            }

            var certificadoDeAnalisisExterno = $("#certificado_de_analisis_externo")[0].files[0];
            if (!certificadoDeAnalisisExterno) {
                console.log("Debe cargar el certificado de análisis externo.", "warning");
                $.notify("Debe cargar el certificado de análisis externo.", "warning");
                return;
            }

            var formData = new FormData();
            formData.append('certificado_de_analisis_externo', certificadoDeAnalisisExterno);
            formData.append('laboratorio_nro_analisis', laboratorio_nro_analisis);
            formData.append('laboratorio_fecha_analisis', moment(laboratorio_fecha_analisis, 'DD/MM/YYYY').format('YYYY-MM-DD'));
            formData.append('fecha_entrega', moment(fecha_entrega, 'DD/MM/YYYY').format('YYYY-MM-DD'));
            formData.append('resultados_analisis', JSON.stringify(results));
            formData.append('resultado_textos', JSON.stringify(resultadoTextos));

            $("#revisar").hide();
            fetch("./backend/analisis/agnadir_revision.php?id_analisis=" + idAnalisisExterno, {
                method: "POST",
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.exito) {
                        $.notify("Análisis de laboratorio guardado.", "success");
                        firma2Fn();
                        $('#listado_solicitudes_analisis').click();
                    } else {
                        $.notify("Error al guardar: " + data.error, "error");
                        $("#revisar").show();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("Error al revisar los datos.");
                    $("#revisar").show();
                });
        });
    });
</script>