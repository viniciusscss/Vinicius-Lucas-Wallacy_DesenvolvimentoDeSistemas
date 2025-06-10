<?php require_once __DIR__ . '/../partials/header.php'; ?>

<main class="contact-container">
    <section class="contact-section">
        <h1>Entre em Contato</h1>
        
        <div class="contact-info">
            <div class="info-item">
                <i class="fas fa-phone"></i>
                <p>(041) 9999-9999</p>
            </div>
            <div class="info-item">
                <i class="fas fa-envelope"></i>
                <p>contato@hortifrutilonline.com.br</p>
            </div>
            <div class="info-item">
                <i class="fas fa-map-marker-alt"></i>
                <p>Rua das Frutas, 123 - Centro, Curitiba/PR</p>
            </div>
        </div>
        
        <form class="contact-form" method="post" action="<?= BASE_URL ?>?controller=Home&action=enviarContato">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="mensagem">Mensagem:</label>
                <textarea id="mensagem" name="mensagem" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
        </form>
        
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3599.584518745273!2d-49.3049716249432!3d-25.55221313773796!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94dcfd901a6fe3c5%3A0x8ea72e3963903003!2sCeasa%20-%20Curitiba!5e0!3m2!1spt-BR!2sbr!4v1748867212845!5m2!1spt-BR!2sbr" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>