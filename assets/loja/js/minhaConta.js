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
        "url": " " + base_url + "/minhaConta/getPedidos",
        "dataSrc": ""
    },
    "columns": [
        { "data": "id", "width": "10%" },
        { "data": "data", "width": "15%" },
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
    "resonsieve": "true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order": [[0, "desc"]]
});