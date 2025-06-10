<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="container main-content">
    <h1 class="checkout-title">Finalizar Compra</h1>

    <div class="checkout-layout">

        <div class="checkout-form-container">
            <form action="?controller=Pedido&action=salvar" method="POST" class="checkout-form">

                <div class="form-section">
                    <h2><i class="fas fa-map-marker-alt"></i> Endereço de Entrega</h2>
                    <div class="form-row">
                        <div class="form-group col-md-4"><label for="cep">CEP</label><input type="text" class="form-control" id="cep" name="cep" placeholder="00000-000"></div>
                        <div class="form-group col-md-8"><label for="rua">Rua</label><input type="text" class="form-control" id="rua" name="rua" placeholder="Nome da rua"></div>
                    </div>
                     <div class="form-row">
                        <div class="form-group col-md-4"><label for="numero">Número</label><input type="text" class="form-control" id="numero" name="numero" placeholder="Ex: 123"></div>
                        <div class="form-group col-md-8"><label for="complemento">Complemento</label><input type="text" class="form-control" id="complemento" name="complemento" placeholder="Apto, bloco, etc."></div>
                    </div>
                     <div class="form-row">
                        <div class="form-group col-md-6"><label for="bairro">Bairro</label><input type="text" class="form-control" id="bairro" name="bairro" placeholder="Nome do bairro"></div>
                        <div class="form-group col-md-6"><label for="cidade">Cidade</label><input type="text" class="form-control" id="cidade" name="cidade" placeholder="Nome da cidade"></div>
                    </div>
                </div>

                <div class="form-section">
                    <h2><i class="fas fa-clock"></i> Horário de Entrega</h2>
                    <div class="form-group"><label for="horario_entrega">Escolha a data e o horário</label><input type="datetime-local" class="form-control" id="horario_entrega" name="horario_entrega"></div>
                </div>

                <div class="form-section">
                    <h2><i class="fas fa-credit-card"></i> Forma de Pagamento</h2>
                    <div class="payment-options">
                        <div class="form-check"><input class="form-check-input" type="radio" name="forma_pagamento" id="pix" value="pix" checked><label class="form-check-label" for="pix"><i class="fas fa-qrcode"></i> PIX</label></div>
                        <div class="form-check"><input class="form-check-input" type="radio" name="forma_pagamento" id="cartao" value="cartao"><label class="form-check-label" for="cartao"><i class="fas fa-credit-card"></i> Cartão de Crédito</label></div>
                        <div class="form-check"><input class="form-check-input" type="radio" name="forma_pagamento" id="boleto" value="boleto"><label class="form-check-label" for="boleto"><i class="fas fa-barcode"></i> Boleto</label></div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-lg btn-block">Confirmar Pedido</button>
            </form>
        </div>

        <div class="order-summary-container">
            <h2>Resumo da Compra</h2>
            <div class="summary-items">
                <?php foreach ($produtosNoCarrinho as $produto): ?>
                    <div class="summary-item">
                        <img src="<?= BASE_URL ?>assets/img/produtos/<?= htmlspecialchars($produto['imagem']) ?>" class="summary-item-img">
                        <div class="summary-item-info">
                            <span class="summary-item-name"><?= htmlspecialchars($produto['nome']) ?></span>
                            <span class="summary-item-qty">Qtd: <?= $produto['quantidade'] ?></span>
                        </div>
                        <span class="summary-item-price">R$ <?= number_format($produto['subtotal'], 2, ',', '.') ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="summary-total">
                <strong>Total</strong>
                <strong>R$ <?= number_format($totalCarrinho, 2, ',', '.') ?></strong>
            </div>
        </div>

    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>