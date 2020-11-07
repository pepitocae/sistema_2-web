var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
	$('#mVentas').addClass("treeview active");
    $('#lEntradas').addClass("active");	
}

//Función limpiar
function limpiar()
{
	$("#fecha").val("");
	$("tipo").val("");
	$('#tipo').selectpicker('refresh')
	$("#concepto").val("");
	$("#cliente").val("");
	$("#detalle").val("");
	$("#empleado").val("");
	$("#subtotal").val("");
	$("#iva").val("");
	$("#forma_pago").val("");
	$('#forma_pago').selectpicker('refresh')
	$("#pagado").val("")
	$("#identrada").val("");
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
					url: '../ajax/entrada.php?op=listar',
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
		url: "../ajax/entrada.php?op=guardaryeditar",
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

function mostrar(identrada)
{
	$.post("../ajax/entrada.php?op=mostrar",{identrada : identrada}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#fecha").val(data.fecha);
		$("#tipo").val(data.tipo);
		$("#concepto").val(data.concepto);
		$("#cliente").val(data.cliente);
		$("#detalle").val(data.detalle);
		$("#empleado").val(data.empleado);
		$("#subtotal").val(data.subtotal);
		$("#iva").val(data.iva);
		$("#forma_pago").val(data.forma_pago);
		$("#forma_pago").selectpicker('refresh');
		$("#pagado").val(data.pagado);
 		$("#identrada").val(data.identrada);
		

 	})
}

//Función para eliminar registros
function eliminar(identrada)
{
	bootbox.confirm("¿Está Seguro de eliminar el ingreso?", function(result){
		if(result)
        {
        	$.post("../ajax/entrada.php?op=eliminar", {identrada : identrada}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();