<<<<<<< HEAD
<?php require_once __DIR__ . '/../partials/header.php'; ?>
=======
<?php require_once '../partials/header.php'; ?>
>>>>>>> 321605f3475b9d5912aa6d786975baf2704d5e00

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Login</h2>
        <?php if (isset($erro)): ?>
            <div class="alert alert-danger"><?= $erro ?></div>
        <?php endif; ?>
<<<<<<< HEAD
        <?php if (isset($_SESSION['msg'])): ?>
            <div class="alert alert-success" role="alert">
                <?= $_SESSION['msg']; unset($_SESSION['msg']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['erro'])): ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['erro']; unset($_SESSION['erro']); ?>
            </div>
        <?php endif; ?>
=======
>>>>>>> 321605f3475b9d5912aa6d786975baf2704d5e00

        <form method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" 
                       value="<?= $_COOKIE['lembrar_email'] ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="lembrar" name="lembrar">
                <label class="form-check-label" for="lembrar">Lembrar-me</label>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
<<<<<<< HEAD
        <p class="mt-3">Ainda não tem uma conta? <a href="?controller=Cliente&action=create">Cadastre-se aqui</a>.</p>
    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
=======
    </div>
</div>

<?php require_once '../partials/footer.php'; ?>
>>>>>>> 321605f3475b9d5912aa6d786975baf2704d5e00
