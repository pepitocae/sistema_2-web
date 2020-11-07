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
	$("#idinscrito").val("");
	$("#fecha").val("");
	$("#nombre").val("");
	$("#e_mail").val("");
	$("#telefono").val("");
	$("#area_interes").val("");
	$("#grado_estudios").val("");
	$('#grado_estudios').selectpicker('refresh')
	$("#ingles").val("");
	$('#ingles').selectpicker('refresh')
	$("#zona_interes").val("");
	$("#tipo_vacante").val("");
	$('#tipo_vacante').selectpicker('refresh')
	$("#comentarios").val("");
	$("#sueldo_actual").val("");
	$("#residencia").val("");
	$("#trabajando").val("");
	$("#cv").val("");
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
					url: '../ajax/inscrito.php?op=listar',
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
		url: "../ajax/inscrito.php?op=guardaryeditar",
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

function mostrar(idinscrito)
{
	$.post("../ajax/inscrito.php?op=mostrar",{idinscrito : idinscrito}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#fecha").val(data.fecha);
		$("#nombre").val(data.nombre);
		$("#e_mail").val(data.e_mail);
		$("#telefono").val(data.telefono);
		$("#area_interes").val(data.area_interes);
		$("#grado_estudios").val(data.grado_estudios);
		$("#grado_estudios").selectpicker('refresh');
		$("#ingles").val(data.ingles);
		$("#ingles").selectpicker('refresh');
		$("#zona_interes").val(data.zona_interes);
		$("#tipo_vacante").val(data.tipo_vacante);
		$("#tipo_vacante").selectpicker('refresh');
		$("#comentarios").val(data.comentarios);
		$("#sueldo_actual").val(data.sueldo_actual);
		$("#residencia").val(data.residencia);
		$("#trabajando").val(data.trabajando);
		$("#cv").val(data.cv);
 		$("#idinscrito").val(data.idinscrito);
		

 	})
}

//Función para eliminar registros
function eliminar(idinscrito)
{
	bootbox.confirm("¿Está Seguro de eliminar el inscrito?", function(result){
		if(result)
        {
        	$.post("../ajax/inscrito.php?op=eliminar", {idinscrito : idinscrito}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();