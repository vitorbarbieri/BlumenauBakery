let tablePedido;

tablePedido = $('#tablePedido').dataTable({
    "aProcessing": true,
    "aServerSide": true,
    "scrollY": true,
    "scrollX": false,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
    },
    "ajax": {
        "url": " " + base_url + "/pedido/getPedidos",
        "dataSrc": ""
    },
    "columns": [
        { "data": "id", "width": "10%" },
        { "data": "data", "width": "15%" },
        { "data": "cNome", "width": "30%" },
        { "data": "total", "width": "10%" },
        { "data": "pagamento", "width": "15%" },
        { "data": "status", "width": "10%" },
        { "data": "opcoes", "width": "10%" }
    ],
    "columnDefs": [
        { 'className': "textcenter", "targets": [3] },
        { 'className': "textright", "targets": [4] },
        { 'className': "textcenter", "targets": [5] }
    ],
    'dom': 'lBfrtip',
    'buttons': [
        {
            "extend": "copyHtml5",
            "text": "<i class='far fa-copy'></i> Copiar",
            "titleAttr": "Copiar",
            "className": "btn btn-secondary",
            "exportOptions": {
                "columns": [0, 1, 2, 3, 4, 5]
            }
        }, {
            "extend": "excelHtml5",
            "text": "<i class='fas fa-file-excel'></i> Excel",
            "titleAttr": "Esportar a Excel",
            "className": "btn btn-success",
            "exportOptions": {
                "columns": [0, 1, 2, 3, 4, 5]
            }
        }, {
            "extend": "pdfHtml5",
            "text": "<i class='fas fa-file-pdf'></i> PDF",
            "titleAttr": "Esportar a PDF",
            "className": "btn btn-danger",
            "exportOptions": {
                "columns": [0, 1, 2, 3, 4, 5]
            }
        }, {
            "extend": "csvHtml5",
            "text": "<i class='fas fa-file-csv'></i> CSV",
            "titleAttr": "Esportar a CSV",
            "className": "btn btn-info",
            "exportOptions": {
                "columns": [0, 1, 2, 3, 4, 5]
            }
        }
    ],
    "resonsieve": "true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order": [[0, "desc"]]
});