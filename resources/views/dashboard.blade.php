@extends('general')

@section('content')

        <style>
            .doc-section-title::before {
                background: none;
            }
            .topTable{
                /* margin-top: 20em */
            }
        </style>
        

        <!-- Modal Barcode -->
        <div class="modal fade" id="modalBarcode" tabindex="-1" role="dialog" aria-labelledby="modalBarcodeLabel" aria-hidden="true" style="top: 100px;">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="barcodeContainer" class="containerBarcode"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <!-- <button type="button" class="btn btn-primary">Descargar PDF</button> -->
                    <!-- <button type="button" onclick="$('.containerBarcode').print();" class="btn btn-primary">Imprimir</button> -->
                </div>
            </div>
            </div>
        </div>

        <hr>

        <script>
            $(document).ready( function () {
                show(false, '0', true);
            });
        </script>
        

      <script type="text/javascript">


        function barcodeRender(id) {
            console.log('Try get from '+id);
            $.ajax({
                url: 'barcodeById',
                type: 'POST',
                data: {id: id},
                success: function(result) {
                    $('#modalBarcode').modal('show');
                    $("#barcodeContainer").html(result);
                }
            });
        }

        /* API REST */
        function show(forceEdit, id, allFree) {
            if(forceEdit != true)
            {
                console.log('Getting New');
                var table = $.ajax({
                    url: '{{route("dashboard.show", 1)}}'.replace('1', id),
                    type: 'GET',
                    data: {allFree: allFree, 'id': id},
                    success: function(result) {
                        $("#listHR"+id).dataTable().fnDestroy();
                        $('#listHR'+id).DataTable( {
                            language: {
                                "processing": "Procesando...",
                                "lengthMenu": "Mostrar: _MENU_",
                                "zeroRecords": "No se encontraron resultados",
                                "emptyTable": "Ningún dato disponible en esta tabla",
                                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                                "search": "Buscar:",
                                "infoThousands": ",",
                                "loadingRecords": "Cargando...",
                                "paginate": {
                                    "first": "Primero",
                                    "last": "Último",
                                    "next": "Siguiente",
                                    "previous": "Anterior"
                                },
                                "aria": {
                                    "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                                    "sortDescending": ": Activar para ordenar la columna de manera descendente"
                                },
                                "buttons": {
                                    "copy": "Copiar",
                                    "colvis": "Visibilidad",
                                    "collection": "Colección",
                                    "colvisRestore": "Restaurar visibilidad",
                                    "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                                    "copySuccess": {
                                        "1": "Copiada 1 fila al portapapeles",
                                        "_": "Copiadas %d fila al portapapeles"
                                    },
                                    "copyTitle": "Copiar al portapapeles",
                                    "csv": "CSV",
                                    "excel": "Excel",
                                    "pageLength": {
                                        "-1": "Mostrar todas las filas",
                                        "1": "Mostrar 1 fila",
                                        "_": "Mostrar %d filas"
                                    },
                                    "pdf": "PDF",
                                    "print": "Imprimir"
                                },
                                "autoFill": {
                                    "cancel": "Cancelar",
                                    "fill": "Rellene todas las celdas con <i>%d<\/i>",
                                    "fillHorizontal": "Rellenar celdas horizontalmente",
                                    "fillVertical": "Rellenar celdas verticalmentemente"
                                },
                                "decimal": ",",
                                "searchBuilder": {
                                    "add": "Añadir condición",
                                    "button": {
                                        "0": "Constructor de búsqueda",
                                        "_": "Constructor de búsqueda (%d)"
                                    },
                                    "clearAll": "Borrar todo",
                                    "condition": "Condición",
                                    "conditions": {
                                        "date": {
                                            "after": "Despues",
                                            "before": "Antes",
                                            "between": "Entre",
                                            "empty": "Vacío",
                                            "equals": "Igual a",
                                            "notBetween": "No entre",
                                            "notEmpty": "No Vacio",
                                            "not": "Diferente de"
                                        },
                                        "number": {
                                            "between": "Entre",
                                            "empty": "Vacio",
                                            "equals": "Igual a",
                                            "gt": "Mayor a",
                                            "gte": "Mayor o igual a",
                                            "lt": "Menor que",
                                            "lte": "Menor o igual que",
                                            "notBetween": "No entre",
                                            "notEmpty": "No vacío",
                                            "not": "Diferente de"
                                        },
                                        "string": {
                                            "contains": "Contiene",
                                            "empty": "Vacío",
                                            "endsWith": "Termina en",
                                            "equals": "Igual a",
                                            "notEmpty": "No Vacio",
                                            "startsWith": "Empieza con",
                                            "not": "Diferente de"
                                        },
                                        "array": {
                                            "not": "Diferente de",
                                            "equals": "Igual",
                                            "empty": "Vacío",
                                            "contains": "Contiene",
                                            "notEmpty": "No Vacío",
                                            "without": "Sin"
                                        }
                                    },
                                    "data": "Data",
                                    "deleteTitle": "Eliminar regla de filtrado",
                                    "leftTitle": "Criterios anulados",
                                    "logicAnd": "Y",
                                    "logicOr": "O",
                                    "rightTitle": "Criterios de sangría",
                                    "title": {
                                        "0": "Constructor de búsqueda",
                                        "_": "Constructor de búsqueda (%d)"
                                    },
                                    "value": "Valor"
                                },
                                "searchPanes": {
                                    "clearMessage": "Borrar todo",
                                    "collapse": {
                                        "0": "Paneles de búsqueda",
                                        "_": "Paneles de búsqueda (%d)"
                                    },
                                    "count": "{total}",
                                    "countFiltered": "{shown} ({total})",
                                    "emptyPanes": "Sin paneles de búsqueda",
                                    "loadMessage": "Cargando paneles de búsqueda",
                                    "title": "Filtros Activos - %d"
                                },
                                "select": {
                                    "1": "%d fila seleccionada",
                                    "_": "%d filas seleccionadas",
                                    "cells": {
                                        "1": "1 celda seleccionada",
                                        "_": "$d celdas seleccionadas"
                                    },
                                    "columns": {
                                        "1": "1 columna seleccionada",
                                        "_": "%d columnas seleccionadas"
                                    }
                                },
                                "thousands": ".",
                                "datetime": {
                                    "previous": "Anterior",
                                    "next": "Proximo",
                                    "hours": "Horas",
                                    "minutes": "Minutos",
                                    "seconds": "Segundos",
                                    "unknown": "-",
                                    "amPm": [
                                        "am",
                                        "pm"
                                    ]
                                },
                                "editor": {
                                    "close": "Cerrar",
                                    "create": {
                                        "button": "Nuevo",
                                        "title": "Crear Nuevo Registro",
                                        "submit": "Crear"
                                    },
                                    "edit": {
                                        "button": "Editar",
                                        "title": "Editar Registro",
                                        "submit": "Actualizar"
                                    },
                                    "remove": {
                                        "button": "Eliminar",
                                        "title": "Eliminar Registro",
                                        "submit": "Eliminar",
                                        "confirm": {
                                            "_": "¿Está seguro que desea eliminar %d filas?",
                                            "1": "¿Está seguro que desea eliminar 1 fila?"
                                        }
                                    },
                                    "error": {
                                        "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                                    },
                                    "multi": {
                                        "title": "Múltiples Valores",
                                        "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
                                        "restore": "Deshacer Cambios",
                                        "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
                                    }
                                },
                                "info": "Mostrando de _START_ a _END_ de _TOTAL_ registros"
                            },
                            "createdRow": function( row, data, dataIndex){

                                $.ajax({
                                    url: '{{route("dashboard.show", 1)}}'.replace('1', id),
                                    type: 'GET',
                                    data: {subquery: true, 'id': id, 'hr': data["id"]},
                                    success: function(result) {
                                        console.log('Result: '+result);
                                        if( result > 0){
                                            $(row).addClass('yellow');
                                        }else{
                                            $('#btncheck_'+data["id"]).hide();
                                        }
                                    }
                                });

                                if(data["Salida"]=="Salida Segura")
                                {
                                    console.log(data["Salida"]);
                                    $(row).addClass('green');
                                }

                            },
                            data: JSON.parse(result),
                            columns: [

                                { data: 'business'},
                                { data: 'management'},
                                { data: 'transport'},
                                { data: 'fnamelname'},
                                { data: 'document'},
                                /* { data: 'email'},
                                { data: 'telephone'}, */
                                {
                                    render: function (data, type, row) {
                                        if(row["Sum"] <= 1) {
                                            return '<button onclick="barcodeRender(\'' +row["id"]+ '\')" type="button" class="btn btn-raised btn-raised-info p-1">Barras</button>';
                                        }else{
                                            if(id != 0) {
                                                return '<button onclick="barcodeRender(\'' +row["id"]+ '\')" type="button" class="btn btn-raised btn-raised-info p-1">Barras</button>\
                                                <button id="btncheck_'+row["id"]+'" onclick="forceExit(\'' +row["id"]+ '\', '+id+')" type="button" class="btn btn-raised btn-raised-danger p-1 mt-2">Marcar Salida</button>';
                                            }else{
                                                return '<button onclick="barcodeRender(\'' +row["id"]+ '\')" type="button" class="btn btn-raised btn-raised-info p-1">Barras</button>';
                                            }
                                        }
                                    }
                                }
                            ]
                        });
                    }
                });
            }
        }

        function forceExit(id, placeId) {
            $.ajax({
              url: '{{route("dashboard.edit", 1)}}'.replace('1', id),
              type: 'GET',
              data: {id: id, placeId: placeId},
              success: function(result) {
                if(result > 0) {
                  alert('Estado cambiado correctamente.');
                  /* Refresh every table of pages */
                  /* show(false, placeId, true); */ location.reload();
                }
              }
          });
        }

      </script>

@endsection

@section('scripts')
    <style type="text/css">
        .table th { padding: 0; }
        .dataTables_wrapper .myfilter .dataTables_filter{float:left; margin-left: 10px;}
        .dataTables_filter { margin-left: 0 !important; }
        table {
            table-layout: fixed;
            width: 100%; 
        }
    </style>
@endsection