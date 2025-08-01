<?php
session_start();

// Verificar si la variable de sesión "usuario" no está establecida o está vacía.
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
    // Redirigir al usuario a la página de inicio de sesión.
    header("Location: login.html");
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="../assets/css/Listados.css">
    
</head>

<body>
    <div class="form-container">
        <h1>Calidad / Listado Actas de Muestreo</h1>
        <br>
        <br>
        <h2 class="section-title">Listado de Actas de Muestreo:</h2>
        <div class="estado-filtros">
            <label> Filtrar por:</label>
            <button class="estado-filtro badge badge-success" onclick="filtrar_listado('Vigente','estado')">Vigente</button>
            <button class="estado-filtro badge badge-warning" onclick="filtrar_listado('En Proceso de firma','estado')">En Proceso de Firma</button>
            <button class="estado-filtro badge badge-warning" onclick="filtrar_listado('Pendiente Muestreo','estado')">Pendiente Muestreo</button>
            <button class="estado-filtro badge badge-dark" onclick="filtrar_listado('Especificación obsoleta','estado')">Especificación obsoleta</button>
            <button class="estado-filtro badge badge-dark" onclick="filtrar_listado('Expirado','estado')">Expirado</button>
            <button class="estado-filtro badge" onclick="filtrar_listado('','estado')">Todos</button>
        </div>
        <div class="estado-filtros">
            <label> Tipo de Producto </label>
            <button class="estado-filtro badge badge-producto-terminado" onclick="filtrar_listado('Producto Terminado', 'tipo_producto')">Producto Terminado</button>
            <button class="estado-filtro badge badge-material-envase" onclick="filtrar_listado('Material Envase y Empaque', 'tipo_producto')">Material Envase y Empaque</button>
            <button class="estado-filtro badge badge-materia-prima" onclick="filtrar_listado('Materia Prima', 'tipo_producto')">Materia Prima</button>
            <button class="estado-filtro badge badge-insumo" onclick="filtrar_listado('Insumo', 'tipo_producto')">Insumo</button>
            
        </div>
        <div class="estado-filtros">
            <label> </label>
            <button class="estado-filtro badge" onclick="limpiar_filtros()">Limpiar Filtros</button>
        </div>
        <br>
        <br>
        <div id="contenedor_listado">
            <table id="listado" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th></th> <!-- Columna vacía para botones o checkboxes -->
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Los datos dinámicos de la tabla se insertarán aquí -->
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
<script>
    // Ahora puedes usar la sintaxis import


    function filtrar_listado(valor, filtro) {
        var table = $('#listado').DataTable();
        
        // Remover clase active de todos los filtros del mismo tipo
        if(filtro == "estado") {
            $('.estado-filtros').first().find('.estado-filtro').removeClass('active');
        } else if(filtro == "tipo_producto") {
            $('.estado-filtros').eq(1).find('.estado-filtro').removeClass('active');
        }
        
        if(filtro=="estado"){
            if (valor === '') {
                // Eliminar todos los filtros
                table.search('').columns().search('').draw();
            } else {
                table.column(1).search(valor).draw();
                // Agregar clase active al botón clickeado
                event.target.classList.add('active');
            }
        }else if(filtro=="tipo_producto"){
            if (valor === '') {
                // Eliminar todos los filtros
                table.search('').columns().search('').draw();
            } else {
                table.column(6).search(valor).draw();
                // Agregar clase active al botón clickeado
                event.target.classList.add('active');
            }
        }
        
        // Actualizar estado del botón "Limpiar Filtros"
        actualizarBotonLimpiarFiltros();
    }
    
    function limpiar_filtros() {
        var table = $('#listado').DataTable();
        // Eliminar todos los filtros de DataTable
        table.search('').columns().search('').draw();
        
        // Remover clase active de todos los filtros
        $('.estado-filtro').removeClass('active');
        
        // Actualizar estado del botón "Limpiar Filtros"
        actualizarBotonLimpiarFiltros();
    }
    
    function actualizarBotonLimpiarFiltros() {
        var hayFiltrosActivos = $('.estado-filtro.active').length > 0;
        var botonLimpiar = $('button[onclick*="limpiar_filtros"]');
        
        if (hayFiltrosActivos) {
            botonLimpiar.addClass('limpiar-filtros-activo');
        } else {
            botonLimpiar.removeClass('limpiar-filtros-activo');
        }
    }
    function carga_listado() {
        var usuarioActual = "<?php echo $_SESSION['usuario']; ?>";
        var table = $('#listado').DataTable({
            "ajax": "./backend/acta_muestreo/listado_acta_muestreoBE.php",
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
            "columns": [{
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": '<i class="fas fa-search-plus"></i>',
                    "width": "20px"
                },
                {
                    "data": "estado",
                    "title": "Estado",
                    "width": "160px",
                    "render": function(data, type, row) {
                        switch (data) {
                            case 'Pendiente Muestreo':
                                return '<span class="badge badge-warning">Pendiente Muestreo</span>';
                            case 'Vigente':
                                return '<span class="badge badge-success">Vigente</span>';
                            case 'Especificación obsoleta':
                                return '<span class="badge badge-dark">Expirado</span>';
                            case 'Expirado':
                                return '<span class="badge badge-dark">Expirado</span>';
                            case 'Pendiente de Aprobación':
                                return '<span class="badge badge-warning">Pendiente de Aprobación</span>';
                            case 'Pendiente de Revisión':
                                return '<span class="badge badge-warning">Pendiente de Revisión</span>';
                            case 'Pendiente Muestreo':
                                return '<span class="badge badge-warning">Pendiente Muestreo</span>';
                            case 'En proceso de firma':
                                return '<span class="badge badge-warning">En proceso de firma</span>';
                            default:
                                return '<span class="badge">' + data + '</span>';
                        }
                    }
                },
                {
                    "data": "numero_acta",
                    "title": "N° Acta",
                    "width": "170px"
                },
                {
                    "data": "fecha_muestreo",
                    "title": "Fecha documento",
                    "width": "65px"
                },
                {
                    "data": "lote",
                    "title": "Lote"
                },
                {
                    "data": "producto",
                    "title": "Producto"
                },
                {
                    "data": "tipo_producto",
                    "title": "Tipo producto"
                },
                {
                    title: 'Responsable',
                    data: 'responsable',
                    defaultContent: '', // Puedes cambiar esto si deseas poner contenido por defecto
                    visible: false // Esto oculta la columna
                },
                {
                    title: 'Muestreador',
                    data: 'muestreador',
                    defaultContent: '', // Puedes cambiar esto si deseas poner contenido por defecto
                    visible: false // Esto oculta la columna
                },
                {
                    title: 'Verificador',
                    data: 'verificador',
                    defaultContent: '', // Puedes cambiar esto si deseas poner contenido por defecto
                    visible: false // Esto oculta la columna
                },
                {
                    title: 'id_acta',
                    data: 'id_acta',
                    defaultContent: '', // Puedes cambiar esto si deseas poner contenido por defecto
                    visible: false // Esto oculta la columna
                }
                ,
                {
                    "data": "producto",
                    "title": "Producto_filtrado",
                    visible: false,
                    "render": function(data, type, row) {
                        if (data) {
                            // Si data no es null ni undefined, realiza la normalización
                            return data.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                        } else {
                            // Si data es null o undefined, retorna una cadena vacía o un valor por defecto
                            return '';
                        }
                    }
                }
            ],

        });

        // Event listener para el botón de detalles
        $('#listado tbody').on('click', 'td.details-control', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // Esta fila ya está abierta - ciérrala
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Abre esta filaQ
                row.child(format(row.data())).show(); // Aquí llamas a la función que formatea el contenido expandido
                tr.addClass('shown');
            }
        });

        // Función para formatear el contenido expandido
        function format(d) {
            // `d` es el objeto de datos original para la fila
            var acciones = '<table background-color="#F6F6F6" color="#FFF" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';

            // Mostrar la fecha y motivo de rechazo si el estado es "rechazado"
            if (d.estado === "rechazado") {
                acciones += '<tr><td>Fecha Rechazo:</td><td>' + (d.fecha_rechazo || 'N/A') + '</td></tr>';
                acciones += '<tr><td>Motivo Rechazo:</td><td>' + (d.motivo_rechazo || 'N/A') + '</td></tr>';
                acciones += '<tr><td></td></tr>';
            }

            // Mostrar siempre la sección de Acciones
            acciones += '<tr><td VALIGN="TOP">Acciones:</td><td>';

            // Botón para "Ingresar resultados" si el estado es "Pendiente Muestreo"
            if (d.estado === "Pendiente Muestreo") {
                acciones += '<button class="accion-btn ingControl" title="WIP Ingresar resultados Acta Muestreo" type="button" id="' + d.id_acta + '" name="resultados_actaMuestreo" onclick="botones(' + d.id_acta + ', this.name, \'laboratorio\')"><i class="fas fa-search"></i> Ingresar resultados</button><a></a>';
            }

            // Botón para "Firmar Acta de Muestreo" si está en proceso de firma
            if (d.estado === "En proceso de firma") {
                if (d.cantidad_firmas == 1 && d.user_firma2 == usuarioActual) {
                    acciones += '<button class="accion-btn ingControl" title="Firmar Acta de Muestreo" id="' + d.id_acta + '" name="firmar_acta_muestreo" onclick="botones(this.id, this.name, \'laboratorio\')"><i class="fa fa-signature"></i> Firmar</button><a></a>';
                }
                if (d.cantidad_firmas == 2 && d.user_firma3 == usuarioActual) {
                    acciones += '<button class="accion-btn ingControl" title="Firmar Acta de Muestreo" id="' + d.id_acta + '" name="firmar_acta_muestreo" onclick="botones(this.id, this.name, \'laboratorio\')"><i class="fa fa-signature"></i> Firmar</button><a></a>';
                }
            }

            // Botón para "Ver documento" si el estado es "Vigente" o "rechazado"
            if (d.estado === "Vigente" || d.estado === "rechazado") {
                acciones += '<button class="accion-btn ingControl" title="Ver documento" id="' + d.id_acta + '" name="revisar_acta" onclick="botones(this.id, this.name, \'laboratorio\')"><i class="fa fa-file-pdf-o"></i> Ver documento</button><a></a>';
            }

            acciones += '</td></tr></table>';
            return acciones;
        }




        // Verificar si hay una alerta en la sesión y mostrarla
        <?php if (isset($_SESSION['alerta'])) { ?>
            alert('<?php echo $_SESSION['alerta']; ?>');
            <?php unset($_SESSION['alerta']); ?>
        <?php } ?>

        // Si se acaba de insertar una nueva especificación, establecer el valor del buscador de DataTables
        <?php if (isset($_SESSION['nuevo_id'])) { ?>
            var buscar = '<?php echo $_SESSION['nuevo_id']; ?>';
            console.log('se intentará filtrar por id: ', buscar);
            table.columns(10).search(buscar).draw();
            //table.search(buscar).draw();
            <?php unset($_SESSION['nuevo_id']); ?>
        <?php } ?>
    }
</script>