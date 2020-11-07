var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
	$('#mAlmacen').addClass("treeview active");
    $('#lEmpleados').addClass("active");	
}

//Función limpiar
function limpiar()
{
	$("#nombre").val("");
	$("apellidos").val("");
	$("#direccion").val("");
	$("#email").val("");
	$("#celular").val("");
	$("#cargo").val("");
	$("#salario").val("");
	$("#comisiones").val("");
	$("#banco").val("");
	$("#cuenta").val("")
	$("#idempleado").val("");
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
					url: '../ajax/empleado.php?op=listar',
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
		url: "../ajax/empleado.php?op=guardaryeditar",
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

function mostrar(idempleado)
{
	$.post("../ajax/empleado.php?op=mostrar",{idempleado : idempleado}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#nombre").val(data.nombre);
		$("#apellidos").val(data.apellidos);
		$("#direccion").val(data.direccion);
		$("#email").val(data.email);
		$("#celular").val(data.celular);
		$("#cargo").val(data.cargo);
		$("#salario").val(data.salario);
		$("#comisiones").val(data.comisiones);
		$("#banco").val(data.banco);
		$("#cuenta").val(data.cuenta);
 		$("#idempleado").val(data.idempleado);
		

 	})
}

//Función para eliminar registros
function eliminar(idempleado)
{
	bootbox.confirm("¿Está Seguro de eliminar el empleado?", function(result){
		if(result)
        {
        	$.post("../ajax/empleado.php?op=eliminar", {idempleado : idempleado}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();