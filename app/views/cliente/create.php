<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-5">
    <h2>Cadastrar-se como Cliente</h2>

    <?php if (isset($_SESSION['erro'])): ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['erro']; unset($_SESSION['erro']); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="?controller=Cliente&action=store">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome completo" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="seuemail@exemplo.com" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Crie uma senha segura" required>
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(XX) XXXXX-XXXX">
        </div>
        <div class="mb-3">
            <label for="cpf_cnpj" class="form-label">CPF ou CNPJ</label>
            <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" placeholder="Ex: 123.456.789-00 ou 12.345.678/0001-90">
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço Completo</label>
            <textarea class="form-control" id="endereco" name="endereco" rows="3" placeholder="Rua, Número, Bairro, Cidade, Estado"></textarea>
        </div>
        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="dd/mm/aaaa">
        </div>
        
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

<script>
$(document).ready(function(){
    // Máscaras
    $('#telefone').mask('(00) 00000-0000'); // Telefone (com 9º dígito)
    $('#cpf_cnpj').mask('000.000.000-00', {
        onKeyPress : function(cpfcnpj, e, field, options){
            var masks = ['000.000.000-000', '00.000.000/0000-00'];
            var cpfcnpj = cpfcnpj.length > 14 ? masks[1] : masks[0];
            $('#cpf_cnpj').mask(cpfcnpj, options);
        }
    });

    // Validações de entrada de caracteres (sem prevenir colar)
    $('#nome').on('keypress', function(e){
        var char = String.fromCharCode(e.which);
        if(!/^[a-zA-Z\s]*$/.test(char)){ // Permite letras e espaço
            e.preventDefault();
        }
    });

    // Para CPF/CNPJ e Telefone, a máscara já impede letras.
    // Para garantir que não haja letras ao colar, você pode adicionar um filtro:
    $('#telefone, #cpf_cnpj').on('input', function() {
        this.value = this.value.replace(/[^0-9\.\-/() ]/g, ''); // Remove tudo que não for número ou máscara
    });

    // Para impedir números em nome
    $('#nome').on('input', function() {
        this.value = this.value.replace(/[0-9]/g, ''); // Remove números
    });
});
</script>