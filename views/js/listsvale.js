function listar_fuas(){
    var url="../../controllers/listfuaController.php";
    var table= $('#fuas').DataTable({    
        
        ajax:url,
        columns:[
                {data:'idfua'},
                {data:'fuaNro'},
                {data:'fuaDateAttentions'},
                {data:'TipoDoc'},
                {data:'Documento'},
                {data:'ApellidoP'},
                {data:'ApellidoM'},
                {data:'Nombre'},
                {data:'NombreDos'},
                {
                "mData": null,
                "bSortable": false,
                "mRender": function(data, type, full) {
                    return '<a class="btn btn-info btn-sm" href=../fua-print/' + full[0] + '>' + 'Imprimir' + ' <i class="zmdi zmdi-refresh"></i> </a>';
                    
                    
                  }

                  
                }
    
                
                
                
                ],
        buttons: [
            'excel', 'pdf', 'print'
        ],
        "bDestroy": true,
        "autoWidth": false,
        dom: "Bfrtip",
        destroy: true,
            
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        })
}