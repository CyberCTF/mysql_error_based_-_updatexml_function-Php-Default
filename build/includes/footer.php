<?php
$metadata = json_decode(file_get_contents(__DIR__ . '/../config/metadata.json'), true);
$footer = $metadata['footer'];
$site = $metadata['site'];
?>
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h4 class="footer-title"><?php echo htmlspecialchars($site['name']); ?></h4>
                <p class="footer-description"><?php echo htmlspecialchars($site['description']); ?></p>
            </div>
            
            <div class="footer-section">
                <h4 class="footer-title">Navigation</h4>
                <div class="footer-links">
                    <?php foreach ($footer['links'] as $link): ?>
                        <a href="<?php echo htmlspecialchars($link['link']); ?>" class="footer-link">
                            <?php echo htmlspecialchars($link['title']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="footer-section">
                <h4 class="footer-title">Réseaux</h4>
                <div class="footer-social">
                    <?php foreach ($footer['social'] as $social): ?>
                        <a href="<?php echo htmlspecialchars($social['href']); ?>" 
                           class="footer-social-link" 
                           target="_blank" 
                           rel="noopener noreferrer">
                            <?php echo htmlspecialchars($social['name']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p class="footer-copyright">
                <?php echo htmlspecialchars($site['copyright']); ?>
            </p>
        </div>
    </div>
</footer>

<style>
.footer {
    background-color: var(--muted);
    border-top: 1px solid var(--border);
    margin-top: 4rem;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    padding: 3rem 0;
}

.footer-section {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.footer-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--foreground);
    margin-bottom: 0.5rem;
}

.footer-description {
    color: var(--muted-foreground);
    font-size: 0.875rem;
    line-height: 1.6;
}

.footer-links {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.footer-link {
    color: var(--muted-foreground);
    text-decoration: none;
    font-size: 0.875rem;
    transition: color 0.2s ease;
}

.footer-link:hover {
    color: var(--foreground);
}

.footer-social {
    display: flex;
    gap: 1rem;
}

.footer-social-link {
    color: var(--muted-foreground);
    text-decoration: none;
    font-size: 0.875rem;
    transition: color 0.2s ease;
}

.footer-social-link:hover {
    color: var(--foreground);
}

.footer-bottom {
    border-top: 1px solid var(--border);
    padding: 1.5rem 0;
    text-align: center;
}

.footer-copyright {
    color: var(--muted-foreground);
    font-size: 0.875rem;
}

/* Responsive */
@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
        gap: 1.5rem;
        padding: 2rem 0;
    }
    
    .footer-social {
        flex-wrap: wrap;
    }
}
</style> 