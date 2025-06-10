</main>
        <footer class="main-footer">
            <div class="footer-container">
                <div class="footer-section">
                    <h3>Links Rápidos</h3>
                    <ul class="footer-links">
                        <li><a href="<?= BASE_URL ?>?controller=Home&action=index">Home</a></li>
                        <li><a href="<?= BASE_URL ?>?controller=Home&action=sobre">Sobre Nós</a></li>
                        <li><a href="<?= BASE_URL ?>?controller=Home&action=contato">Fale Conosco</a></li>
                        <li><a href="<?= BASE_URL ?>?controller=Produto&action=index">Nossos Produtos</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Contato</h3>
                    <div class="contact-info">
                        <p><i class="fas fa-phone"></i> (041) 9999-9999</p>
                        <p><i class="fas fa-envelope"></i> contato@hortifrutilonline.com.br</p>
                        <p><i class="fas fa-map-marker-alt"></i> Rua das Hortaliças, 123 - PR</p>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h3>Redes Sociais</h3>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; <?= date('Y') ?> Hortifrúti Online. Todos os direitos reservados.</p>
            </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>