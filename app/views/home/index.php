<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="container">
<<<<<<< HEAD
    <div style="height: 120px;"></div>
=======
>>>>>>> 321605f3475b9d5912aa6d786975baf2704d5e00
    <section class="hero-banner" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('<?= BASE_URL ?>assets/img/banner.png')">
        <h1>Hortifrúti Online</h1>
        <p>Produtos frescos direto do produtor</p>
    </section>

    <section class="products-section">
        <h2>Nossos Produtos</h2>
        
        <div class="products-grid">
            <?php foreach ($produtos as $produto): ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="<?= BASE_URL ?>assets/img/produtos/<?= $produto['imagem'] ?>" 
                         alt="<?= htmlspecialchars($produto['nome']) ?>" 
                         title="<?= htmlspecialchars($produto['nome']) ?>">
                </div>
                <div class="product-info">
                    <h3><?= htmlspecialchars($produto['nome']) ?></h3>
                    <p class="product-price">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                    <p class="product-stock">Estoque: <?= $produto['estoque'] ?> unidades</p>
                    <button class="btn-add-cart">Adicionar ao carrinho</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>