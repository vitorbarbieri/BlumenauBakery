<?= headerAdmin($data); ?>
<?= navAdmin($data); ?>

<main class="app-content">
    <div class="page-error tile">
        <h1><i class="fa fa-exclamation-circle"></i> Error 404: Página não encontrada</h1>
        <p>A página que você solicitou não foi encontrada.</p>
        <p><a class="btn btn-primary" href="javascript:window.history.back();">Voltar</a></p>
    </div>
</main>

<?= footerAdmin($data); ?>