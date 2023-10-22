<?php
headerLoja($data);
?>

<br><br><br>

<div class="jumbotron text-center">
    <h1 class="display-4">Obrigado por sua compra!</h1>
    <p class="lead">Seu pedido foi processado com sucesso.</p>
    <p>Nº Pedido: <strong><?= $data['order']; ?></strong></p>
    <hr class="my-4">
    <p>Em pouco tempo processaremos seu pedido para entrega.</p>
    <p>Podes ver o estado do seu pedido na seção "Minha Conta".</p>
    <br>
    <a class="btn btn-primary btn-lg" href="<?= base_url(); ?>" role="button">Voltar</a>
</div>

<?php
footerLoja($data);
?>