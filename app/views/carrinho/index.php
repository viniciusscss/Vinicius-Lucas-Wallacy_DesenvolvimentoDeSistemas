<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="container main-content">
    <h1 class="cart-title">Meu Carrinho de Compras</h1>

    <?php if (empty($produtosNoCarrinho)): ?>
        <p class="cart-empty-message">Seu carrinho está vazio.</p>
        <a href="?controller=Home&action=index" class="btn btn-primary">Voltar para a loja</a>
    <?php else: ?>
        <div class="cart-container">
            <div class="cart-items">
                <?php foreach ($produtosNoCarrinho as $produto): ?>
                    <div class="cart-item">
                        <img src="<?= BASE_URL ?>assets/img/produtos/<?= htmlspecialchars($produto['imagem']) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" class="cart-item-image">
                        <div class="cart-item-details">
                            <h2><?= htmlspecialchars($produto['nome']) ?></h2>
                            <p class="price">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                            <p class="stock">Estoque: <?= $produto['estoque'] ?> unidades</p>

                            <form action="?controller=Carrinho&action=atualizar" method="post" class="cart-quantity-form">
                                <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                                <label for="quantidade-<?= $produto['id'] ?>">Qtd:</label>
                                <input type="number" id="quantidade-<?= $produto['id'] ?>" name="quantidade" value="<?= $produto['quantidade'] ?>" min="1" max="<?= $produto['estoque'] ?>" class="cart-item-quantity">
                                <button type="submit" class="btn btn-secondary btn-sm">Atualizar</button>
                            </form>
                        </div>
                        <div class="cart-item-subtotal">
                            <p>Subtotal: R$ <?= number_format($produto['subtotal'], 2, ',', '.') ?></p>
                            <a href="?controller=Carrinho&action=remover&id=<?= $produto['id'] ?>" class="cart-item-remove">Remover</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="cart-summary">
                <h2>Resumo do Pedido</h2>
                <div class="summary-line">
                    <span>Total dos Produtos:</span>
                    <span class="total-price">R$ <?= number_format($totalCarrinho, 2, ',', '.') ?></span>
                </div>
                <a href="?controller=Checkout&action=index" class="btn btn-success btn-block">Finalizar Compra</a>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>