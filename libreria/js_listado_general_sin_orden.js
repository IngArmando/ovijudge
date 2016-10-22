				function msj_eliminar(){
		return confirm("Esta seguro de eliminar este registro?");
	}
			$(function() {
				var orientar='portrait';
			   var table = $('#data_table').DataTable( {
				  autoClose: true,
					scrollX: true,
					lengthChange: false,
					lengthMenu: [
					
						[ 10, 25, 50, -1 ],
						[ '10 filas', '25 filas', '50 filas', 'Mostrar todo']
					],
					language:{
						'decimal':        '',
						'emptyTable':     'No hay datos disponibles en la tabla',
						'info':           'Mostrando _START_ a _END_ de _TOTAL_ entradas',
						'infoEmpty':      'Mostrando 0 a 0 de 0 entradas',
						'infoFiltered':   '(filtrado para _MAX_ total entradas)',
						'infoPostFix':    '',
						'thousands':      ',',
						'lengthMenu':     'Mostrar _MENU_ entradas',
						'loadingRecords': 'Cargando...',
						'processing':     'Procesando...',
						'search':         'Buscar:',
						'zeroRecords':    'No hay registros que mostrar',
						'paginate': {
							'first':      'Primero',
							'last':       'Ultimo',
							'next':       'Siguiente',
							'previous':   'Anterior'
						},
						'aria': {
							'sortAscending':  ': Activar para ordenar la columna de manera ascendente',
							'sortDescending': ': Activar para ordenar la columna de manera descendente'
						},

					buttons: {
						copyTitle: 'Datos copiados',
						copyKeys: 'Usa tu teclado para seleccionar un comando de copiado',
						   copySuccess: {
								1: 'Copiado una fila al protapapeles',
								_: 'Copiado %d filas al portapapeles'
							}
					}
				},
					    buttons: [
						{extend: 'copy', text: 'Copiar', exportOptions: {columns: ':visible'} },
					    { extend: 'print', text: 'Imprimir', exportOptions: {columns: ':visible'} },
					    { extend: 'colvis', text: 'Ocultar campos' },
					    {
								extend: 'collection',
								text: 'Exportar',
								
								buttons: [ 
									{text: 'Vertical', action:function ( ){
										
										if(this.text()=='Vertical'){
											this.text('Horizontal');
											orientar='landscape';
											
										}else{
											this.text('Vertical');
											orientar='portrait';
										}
									}
									},
									{ extend: 'csv', text: 'CSV', exportOptions: {columns: ':visible'} },
									{ extend: 'excel', text: 'CALC y EXCEL', exportOptions: {columns: ':visible'} },
									{
										exportOptions: {columns: ':visible'} ,
										extend: 'pdf',
										
										text: 'PDF',
										title:sub_titulo_pdf,
										pageSize:'LETTER',
										
										//message:,

										customize: function ( doc ) {
											//margen entre el logo y el titulo
											doc.content.splice( 0, 0, {
												margin: [ 0, 0, 0, 12 ],
												text:''
												
											} );
											//
											var fecha=new Date();	
											doc['pageOrientation']=orientar;								
											//alert(JSON.stringify(doc));
											doc["header"]=function(){
												return{
													columns:[{

														image:'data:image/png;base64,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',
														width: 435,height: 30,
														
													}],
													margin:[10,10]
												};
											};

											doc["footer"]=function(page,pages){return{columns:[{fontSize: 9,text:'Reporte generado a la fecha: '+fecha.getDate()+'-'+(fecha.getMonth()+1)+'-'+fecha.getFullYear()+' hora: '+fecha.toLocaleTimeString()},{alignment:'right',text:[{text:'Pag. '+page.toString(),italics:true},' de ',{text:pages.toString(),italics:true}]}],margin:[10,0]};};
										}
									 }
								]
						},
						'pageLength'
										
					    
					]
					
				
				});
				
				table.buttons().container()
				.appendTo( '.col-sm-6:eq(0)' );
				

	
			});
