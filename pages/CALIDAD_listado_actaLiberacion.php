<?php
//archivo: pages\CALIDAD_listado_actaLiberacion.php
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
        <h1>Calidad / Listado Actas de Liberación o Rechazo</h1>
        <br>
        <br>
        <h2 class="section-title">Listado de Liberación o Rechazo:</h2>
        <div class="estado-filtros">
            <label> Filtrar por:</label>
            <button class="estado-filtro badge badge-success" onclick="filtrar_listado('aprobado')">Aprobado</button>
            <button class="estado-filtro badge badge-warning" onclick="filtrar_listado('rechazado')">Rechazado</button>
            <button class="estado-filtro badge badge-dark" onclick="filtrar_listado('pendiente')">Pendiente</button>
            <button class="estado-filtro badge" onclick="filtrar_listado('')">Todos</button>
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


    function filtrar_listado(estado) {
        var table = $('#listado').DataTable();
        if (estado === '') {
            // Eliminar todos los filtros
            table.search('').columns().search('').draw();
        } else {
            table.column(1).search(estado).draw(); // Asumiendo que la columna 1 es la de
        }
    }

    function carga_listado() {
        var table = $('#listado').DataTable({
            "ajax": "./backend/acta_liberacion/listado_actaLiberacionBE.php",
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
                            case 'rechazado':
                                return '<span class="badge badge-warning">Rechazado</span>';
                            case 'aprobado':
                                return '<span class="badge badge-success">Aprobado</span>';
                            case 'pendiente':
                                return '<span class="badge badge-dark">Pendiente</span>';
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
                    "data": "version_acta",
                    "title": "Versión"
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
            acciones += '<tr><td VALIGN="TOP">Acciones:</td><td>';

            // Botón para revisar siempre presente
            if (d.estado === "Pendiente Muestreo") {
                acciones += '<button class="accion-btn ingControl" title="WIP Ingresar resultados Acta Muestreo" type="button" id="' + d.id_acta + '" name="resultados_actaMuestreo" onclick="botones(' + d.id_acta + ', this.name, \'laboratorio\')"><i class="fas fa-search"></i> Ingresar resultados</button><a></a>';
            }
            //acciones += '<button class="accion-btn ingControl " title="WIP Generar Documento" id="' + d.id_acta + '" name="generar_documento_actaMuestreo" onclick="botones(this.id, this.name, \'laboratorio\')"><i class="fa fa-file-pdf-o"></i></button><a> </a>';
            if (d.estado === "En proceso de firma") {
                acciones += '<button class="accion-btn ingControl " title="Firmar Acta de Muestreo" id="' + d.id_acta + '" name="firmar_acta_muestreo" onclick="botones(this.id, this.name, \'laboratorio\')"><i class="fa fa-signature"></i> Firmar</button><a> </a>';
            }
            if (d.estado === "Vigente") {
                acciones += '<button class="accion-btn ingControl " title="Ver documento" id="' + d.id_acta + '" name="revisar_acta" onclick="botones(this.id, this.name, \'laboratorio\')"><i class="fa fa-file-pdf-o"></i> Ver documento</button><a> </a>';
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