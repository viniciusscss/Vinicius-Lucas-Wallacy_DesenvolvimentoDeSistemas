<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="container">
    <div style="height: 120px;"></div>
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
                    <img src="<?= BASE_URL ?>assets/img/produtos/<?= $produto['imagem'] ?? 'default.png' ?>" 
                         alt="<?= htmlspecialchars($produto['nome']) ?>" 
                         title="<?= htmlspecialchars($produto['nome']) ?>">
                </div>
                <div class="product-info">
                    <h3><?= htmlspecialchars($produto['nome']) ?></h3>
                    <p class="product-price">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                    <p class="product-stock">Estoque: <?= $produto['estoque'] ?> unidades</p>
                    <?php if (isset($_SESSION['carrinho'][$produto['id']])): ?>

<button class="btn-add-cart in-cart" disabled>
    <i class="fas fa-check"></i> No Carrinho
</button>

<?php else: ?>

<form action="?controller=Carrinho&action=adicionar&id=<?= $produto['id'] ?>" method="post" style="margin: 0;">
    <button type="submit" class="btn-add-cart">Adicionar ao Carrinho</button>
</form>

<?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>