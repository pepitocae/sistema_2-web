var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
	$('#mCompras').addClass("treeview active");
    $('#lSalidas').addClass("active");	
}

//Función limpiar
function limpiar()
{
	$("#fecha").val("");
	$("tipo").val("");
	$('#tipo').selectpicker('refresh')
	$("#concepto").val("");
	$("#marca").val("");
	$("#modelo").val("");
	$("#proveedor").val("");
	$("#empleado").val("");
	$("#detalle").val("");
	$("#forma_pago").val("");
	$('#forma_pago').selectpicker('refresh')
	$("#pagado").val("")
	$("#idsalida").val("");
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"lengthMenu": [ 5, 10, 25, 75, 100],//mostramos el menú de registros a revisar
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/salida.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"language": {
            "lengthMenu": "Mostrar : _MENU_ registros",
            "buttons": {
            "copyTitle": "Tabla Copiada",
            "copySuccess": {
                    _: '%d líneas copiadas',
                    1: '1 línea copiada'
                }
            }
        },
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/salida.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idsalida)
{
	$.post("../ajax/salida.php?op=mostrar",{idsalida : idsalida}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#fecha").val(data.fecha);
		$("#tipo").val(data.tipo);
		$("#concepto").val(data.concepto);
		$("#marca").val(data.marca);
		$("#modelo").val(data.modelo);
		$("#proveedor").val(data.proveedor);
		$("#empleado").val(data.empleado);
		$("#detalle").val(data.detalle);
		$("#forma_pago").val(data.forma_pago);
		$('#forma_pago').selectpicker('refresh')
		$("#pagado").val(data.pagado);
 		$("#idsalida").val(data.idsalida);
		

 	})
}

//Función para eliminar registros
function eliminar(idsalida)
{
	bootbox.confirm("¿Está Seguro de eliminar el gasto?", function(result){
		if(result)
        {
        	$.post("../ajax/salida.php?op=eliminar", {idsalida : idsalida}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();