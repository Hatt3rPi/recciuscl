<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especificación Producto Terminado</title>
    <link rel="stylesheet" href="../test/testings.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</head>

<body>
    <div id="form-container">
        <div id="Maincontainer">
            <!-- Asegúrate de tener un contenedor para el header con display flex -->
            <div id="header" class="header"
                style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 2px solid #000;">

                <!-- Logo e Información Izquierda -->
                <div class="header-left" style="flex: 1;">
                    <img src="../assets/images/logo_reccius_medicina_especializada.png" alt="Logo"
                        style="height: 50px;" />
                    <!-- Ajusta el tamaño según sea necesario -->
                    <br>
                    <div class="sub-info" style="font-size: 0.75em;">
                        Producto de recetario magistral <br>
                        Res. Ex. N° 2988/2018 <br>
                        RF XII 001/18: 1A, 1B, 2A, 2C, 3A, 3B, 3D, 4 y homeopático
                    </div>
                </div>
                <!-- Título Central -->
                <div class="header-center"
                    style="flex: 2; text-align: center; display: flex; flex-direction: column; justify-content: center; align-items: center; font-family: 'Arial', sans-serif; height: 100%;">
                    <br>
                    <br>
                    <h1 style="margin: 0; font-size: 16px; font-weight: bold; color: #000; line-height: 1.2;">
                        Especificación</h1>
                    <h1 id="Tipo_Producto" name="Tipo_Producto" style="margin: 0; font-size: 16px; font-weight: bold; color: #000; line-height: 1.2;"></h1>
                    <p name="producto" id="producto" style="margin: 0; font-size: 22px; font-weight: bold; color: #000; margin-top: 5px;"></p>
                    <hr style="width:75%;">
                    <div style="position: relative; font-size: 18px; font-weight: bold; color: #000; margin-top: 2px;">
                        Dirección de Calidad

                    </div>
                </div>





                <!-- Información Derecha con Tabla -->
                <div class="header-right" style="flex: 1; font-size: 0.75em;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="border: 1px solid black; padding: 2px;">Doc No:</td>
                            <td style="border: 1px solid black; padding: 2px;">CAL-CPF-007</td>
                            <td style="border: 1px solid black; padding: 2px;">Elab. por:</td>
                            <td style="border: 1px solid black; padding: 2px;">QF DCA.LSR</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding: 2px;">Edición:</td>
                            <td style="border: 1px solid black; padding: 2px;">24/07/2023</td>
                            <td style="border: 1px solid black; padding: 2px;">Rev.Por:</td>
                            <td style="border: 1px solid black; padding: 2px;">QF DTS.CPG</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding: 2px;">Versión:</td>
                            <td style="border: 1px solid black; padding: 2px;">005</td>
                            <td style="border: 1px solid black; padding: 2px;">Aut.Por:</td>
                            <td style="border: 1px solid black; padding: 2px;">QF DTL.ISM</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding: 2px;">Vigencia:</td>
                            <td style="border: 1px solid black; padding: 2px;">5 Años</td>
                            <td style="border: 1px solid black; padding: 2px;">Página:</td>
                            <td style="border: 1px solid black; padding: 2px;">1 de 2</td>
                        </tr>
                    </table>
                    <div class="sub-info" style="margin-top: 10px; font-size: 14px;">

                        RF XII 001/18: 1A, 1B, 2A, 2C, 3A, 3B, 3D, 4 y homeopático
                    </div>
                </div>



            </div>

            <div id="content" class="content">
                <!-- Resto del contenido del cuerpo igual al HTML original -->
                <div class="table-section">
                    <div class="document-title" style="text-align: center;">
                        <h2 style="font-size: 22px; margin-bottom: 0; text-decoration: underline;">ESPECIFICACIONES DE
                            PRODUCTO TERMINADO</h2>
                        <h3 style="font-size: 18px; margin-top: 0;">ÁCIDO ASCÓRBICO 1G 10ML AMPOLLA</h3>
                    </div>
                    <div class="analysis-section" style="font-size: 20px; font-weight: bold; margin-top: 20px;">
                        I. Análisis Generales
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Análisis</th>
                                <th>Metodología</th>
                                <th>Criterio de Aceptación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Apariencia</td>
                                <td>Interno</td>
                                <td class="criteria">Solución límpida, transparente, de color ligeramente amarillo,
                                    inolora,
                                    sin
                                    partículas extrañas visibles en suspensión y contenida en una ampolla de vidrio
                                    ámbar.
                                </td>
                            </tr>
                            <!-- Repite las filas según sea necesario para cada criterio de análisis -->
                            <tr>
                                <td>Identificación</td>
                                <td>USP</td>
                                <td>(A) La coloración azul se vuelve apreciablemente transparente o desaparece dentro de
                                    3
                                    minutos.
                                    <br> (B) ...
                                </td>
                            </tr>
                            <!-- Más filas según el contenido de tu documento -->
                        </tbody>
                        <tbody>
                            <!-- Fila de Apariencia ya incluida -->

                            <!-- Fila de Identificación ya incluida -->

                            <!-- Fila de Valoración -->
                            <tr>
                                <td>Valoración</td>
                                <td>USP</td>
                                <td>10 g / 100ml (90 - 110%)</td>
                            </tr>

                            <!-- Fila de pH -->
                            <tr>
                                <td>pH</td>
                                <td>USP</td>
                                <td>5,5 - 7,0</td>
                            </tr>

                            <!-- Fila de Densidad -->
                            <tr>
                                <td>Densidad</td>
                                <td>Interno</td>
                                <td>1,0 - 1,1 g/mL</td>
                            </tr>

                            <!-- Fila de Osmolaridad -->
                            <tr>
                                <td>Osmolaridad</td>
                                <td>Interno</td>
                                <td>900 - 1100 Osm/Kg</td>
                            </tr>

                            <!-- Fila de Límite de Oxalato -->
                            <tr>
                                <td>Límite de Oxalato</td>
                                <td>USP</td>
                                <td>No se produce turbidez en 1 minuto</td>
                            </tr>

                            <!-- Fila de Volumen extraíble -->
                            <tr>
                                <td>Volumen extraíble</td>
                                <td>USP</td>
                                <td>No menor al declarado (10ml)</td>
                            </tr>

                            <!-- Fila de Material Sub particulado -->
                            <tr>
                                <td>Material Sub particulado</td>
                                <td>USP</td>
                                <td>Obturación: >10um: 6000 y >25um: 600 por ampolla Microscopía: >10um: 3000 y >25um:
                                    300
                                    por
                                    ampolla</td>
                            </tr>

                            <!-- Fila de Material Particulado -->
                            <tr>
                                <td>Material Particulado</td>
                                <td>USP</td>
                                <td>Ausente</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="footer" id="footer">
                <!-- Sección realizada por -->
                <div class="footer-section">
                    <div class="footer-box-title">Realizado por:</div>
                    <div class="footer-box">
                        <p class="bold">QF. Ingar Surname Rodríguez</p>
                        <p class="bold">Director de Calidad</p>
                        <div class="signature">[Espacio para la firma]</div>
                        <p>Firmado digitalmente</p>
                    </div>
                    <div class="date">Fecha: 24/07/2023</div>
                </div>

                <!-- Sección revisada por -->
                <div class="footer-section">
                    <div class="footer-box-title">Revisado por:</div>
                    <div class="footer-box">
                        <p class="bold">QF. Cathrine Pereira García</p>
                        <p class="bold">Jefe de Producción</p>
                        <div class="signature">Ausente por Licencia</div>
                        <p>Firmado digitalmente</p>
                    </div>
                    <div class="date">Fecha: 24/07/2023</div>
                </div>

                <!-- Sección aprobada por -->
                <div class="footer-section">
                    <div class="footer-box-title">Aprobado por:</div>
                    <div class="footer-box">
                        <p class="bold">QF. Luis Sepúlveda Miranda</p>
                        <p class="bold">Director Técnico</p>
                        <div class="signature">[Espacio para la firma]</div>
                        <p>Firmado digitalmente</p>
                    </div>
                    <div class="date">Fecha: 24/07/2023</div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div id="Additionalcontainer">
            <div id="additionalheader" class="header"
                style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 2px solid #000;">

                <!-- Logo e Información Izquierda -->
                <div class="header-left" style="flex: 1;">
                    <img src="../assets/images/logo_reccius_medicina_especializada.png" alt="Logo"
                        style="height: 50px;" />
                    <!-- Ajusta el tamaño según sea necesario -->
                    <br>
                    <div class="sub-info" style="font-size: 0.75em;">
                        Producto de recetario magistral <br>
                        Res. Ex. N° 2988/2018 <br>
                        RF XII 001/18: 1A, 1B, 2A, 2C, 3A, 3B, 3D, 4 y homeopático
                    </div>
                </div>
                <!-- Título Central -->
                <div class="header-center"
                    style="flex: 2; text-align: center; display: flex; flex-direction: column; justify-content: center; align-items: center; font-family: 'Arial', sans-serif; height: 100%;">
                    <h1 style="margin: 0; font-size: 16px; font-weight: bold; color: #000; line-height: 1.2;">
                        Especificación
                        Producto Terminado</h1>
                    <p style="margin: 0; font-size: 22px; font-weight: bold; color: #000; margin-top: 5px;">Ácido
                        Ascórbico
                        1g
                        10ml Amp</p>
                    <hr style="width:75%;">
                    <div style="position: relative; font-size: 18px; font-weight: bold; color: #000; margin-top: 2px;">
                        Dirección de Calidad

                    </div>
                </div>





                <!-- Información Derecha con Tabla -->
                <div class="header-right" style="flex: 1; font-size: 0.75em;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="border: 1px solid black; padding: 2px;">Doc No:</td>
                            <td style="border: 1px solid black; padding: 2px;">CAL-CPF-007</td>
                            <td style="border: 1px solid black; padding: 2px;">Elab. por:</td>
                            <td style="border: 1px solid black; padding: 2px;">QF DCA.LSR</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding: 2px;">Edición:</td>
                            <td style="border: 1px solid black; padding: 2px;">24/07/2023</td>
                            <td style="border: 1px solid black; padding: 2px;">Rev.Por:</td>
                            <td style="border: 1px solid black; padding: 2px;">QF DTS.CPG</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding: 2px;">Versión:</td>
                            <td style="border: 1px solid black; padding: 2px;">005</td>
                            <td style="border: 1px solid black; padding: 2px;">Aut.Por:</td>
                            <td style="border: 1px solid black; padding: 2px;">QF DTL.ISM</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding: 2px;">Vigencia:</td>
                            <td style="border: 1px solid black; padding: 2px;">5 Años</td>
                            <td style="border: 1px solid black; padding: 2px;">Página:</td>
                            <td style="border: 1px solid black; padding: 2px;">1 de 2</td>
                        </tr>
                    </table>
                    <div class="sub-info" style="margin-top: 10px; font-size: 14px;">

                        RF XII 001/18: 1A, 1B, 2A, 2C, 3A, 3B, 3D, 4 y homeopático
                    </div>
                </div>



            </div>
            <div class="table-section" id="additionalContent">
                <!-- Título y subtítulo del cuerpo del documento -->
                <div class="document-title" style="text-align: center;">
                    <h2 style="font-size: 22px; margin-bottom: 0; text-decoration: underline;">ESPECIFICACIONES DE
                        PRODUCTO TERMINADO</h2>
                    <h3 style="font-size: 18px; margin-top: 0;">ÁCIDO ASCÓRBICO 1G 10ML AMPOLLA</h3>
                </div>

                <!-- Sección de Análisis Microbiológico -->
                <div class="analysis-section">
                    II. Análisis Microbiológico
                </div>

                <!-- Tabla de Análisis Microbiológico -->
                <table>
                    <thead>
                        <tr>
                            <th>Análisis</th>
                            <th>Metodología</th>
                            <th>Especificación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Fila de Esterilidad -->
                        <tr>
                            <td>Esterilidad</td>
                            <td>USP</td>
                            <td>Esteril</td>
                        </tr>

                        <!-- Fila de Endotoxinas -->
                        <tr>
                            <td>Endotoxinas</td>
                            <td>USP</td>
                            <td>No más de 1,2 UE/mg</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="footer" id="additionalfooter">
                <!-- Sección realizada por -->
                <div class="footer-section">
                    <br>
                    <div class="footer-box-title">Realizado por:</div>
                    <div class="footer-box">
                        <p class="bold">QF. Inger Sumonte Rodríguez</p>
                        <p class="bold">Director de Calidad</p>
                        <div class="signature">[Espacio para la firma]</div>
                        <p>Firmado digitalmente</p>
                    </div>
                    <div class="date">Fecha: 24/07/2023</div>
                    <br>
                </div>

                <!-- Sección revisada por -->
                <div class="footer-section">
                    <div class="footer-box-title">Revisado por:</div>
                    <div class="footer-box">
                        <p class="bold">QF. Cathrine Pereira García</p>
                        <p class="bold">Jefe de Producción</p>
                        <div class="signature">Ausente por Licencia</div>
                        <p>Firmado digitalmente</p>
                    </div>
                    <div class="date">Fecha: 24/07/2023</div>
                </div>

                <!-- Sección aprobada por -->
                <div class="footer-section">
                    <div class="footer-box-title">Aprobado por:</div>
                    <div class="footer-box">
                        <p class="bold">QF. Luis Sepúlveda Miranda</p>
                        <p class="bold">Director Técnico</p>
                        <div class="signature">[Espacio para la firma]</div>
                        <p>Firmado digitalmente</p>
                    </div>
                    <div class="date">Fecha: 24/07/2023</div>
                </div>
            </div>

        </div>
    </div>

    <button id="download-pdf">Descargar PDF</button>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var button = document.getElementById('download-pdf');
            button.addEventListener('click', function () {
                downloadPDF();
            });
        });
    
        function downloadPDF() {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF({
                orientation: 'p',
                unit: 'pt',
                format: 'a4'
            });
    
            // Altura total de la página A4 en puntos
            const pageHeight = 842;
    
            // Calcula las alturas según la proporción 1.5:6:2
            const headerHeight = (1.25 / 9.5) * pageHeight;
            const contentHeight = (6.5 / 9.5) * pageHeight;
            const footerHeight = (1.75 / 9.5) * pageHeight;
            const marginFromBottom = 20; // Margen desde la parte inferior que quieres para el footer
    
            // Función para añadir el header y el footer con margen
            const addHeaderFooter = (pdf, canvasHeader, canvasFooter) => {
                const imgDataHeader = canvasHeader.toDataURL('image/png');
                const imgDataFooter = canvasFooter.toDataURL('image/png');
                pdf.addImage(imgDataHeader, 'PNG', 0, 0, 595, headerHeight);
                // Ajusta la posición del footer para incluir el margen
                pdf.addImage(imgDataFooter, 'PNG', 0, pageHeight - footerHeight - marginFromBottom, 595, footerHeight);
            };
    
            // Captura el header y el footer una sola vez
            Promise.all([
                html2canvas(document.getElementById('header'), { scale: 2 }),
                html2canvas(document.getElementById('footer'), { scale: 2 })
            ]).then(([canvasHeader, canvasFooter]) => {
                // Añade el contenido de la primera página
                html2canvas(document.getElementById('content'), { scale: 2 }).then(canvasContent => {
                    const imgDataContent = canvasContent.toDataURL('image/png');
                    addHeaderFooter(pdf, canvasHeader, canvasFooter);
                    pdf.addImage(imgDataContent, 'PNG', 0, headerHeight, 595, contentHeight);
    
                    // Añade una nueva página para el additionalContent
                    pdf.addPage();
    
                    // Añade el contenido de la segunda página con un escalado menor
                    html2canvas(document.getElementById('additionalContent'), { scale: 2 }).then(canvasAdditionalContent => {
                        const imgDataAdditionalContent = canvasAdditionalContent.toDataURL('image/png');
                        addHeaderFooter(pdf, canvasHeader, canvasFooter);
                        const scaledContentHeight = contentHeight * (canvasAdditionalContent.height / canvasContent.height);
                        pdf.addImage(imgDataAdditionalContent, 'PNG', 0, headerHeight, 595, scaledContentHeight);
    
                        // Guardar el PDF
                        pdf.save('Especificacion_Producto_Terminado.pdf');
                    });
                });
            });
        }
    </script>
    











</body>

</html>