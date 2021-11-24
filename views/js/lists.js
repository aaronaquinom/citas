function listar_fuas(){
    var url="../controllers/listfuaController.php";
    var table= $('#fuas').DataTable({    
        
        ajax:url,
        
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