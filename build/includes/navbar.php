<?php
$metadata = json_decode(file_get_contents(__DIR__ . '/../config/metadata.json'), true);
$navigation = $metadata['navigation'];
$site = $metadata['site'];
?>
<nav class="navbar">
    <div class="container">
        <div class="navbar-content">
            <div class="navbar-brand">
                <a href="/" class="brand-link">
                    <span class="brand-text"><?php echo htmlspecialchars($site['name']); ?></span>
                </a>
            </div>
            
            <div class="navbar-nav">
                <?php foreach ($navigation['main'] as $item): ?>
                    <a href="<?php echo htmlspecialchars($item['link']); ?>" class="nav-link">
                        <?php echo htmlspecialchars($item['title']); ?>
                    </a>
                <?php endforeach; ?>
            </div>
            
            <div class="navbar-auth">
                <?php foreach ($navigation['auth'] as $item): ?>
                    <a href="<?php echo htmlspecialchars($item['link']); ?>" class="btn btn-outline">
                        <?php echo htmlspecialchars($item['title']); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</nav>

<style>
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 50;
    background-color: var(--background);
    border-bottom: 1px solid var(--border);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

.navbar-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 0;
}

.navbar-brand .brand-link {
    text-decoration: none;
    color: var(--foreground);
    font-weight: 600;
    font-size: 1.125rem;
}

.navbar-nav {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.nav-link {
    text-decoration: none;
    color: var(--muted-foreground);
    font-weight: 500;
    transition: color 0.2s ease;
}

.nav-link:hover {
    color: var(--foreground);
}

.navbar-auth {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-outline {
    background-color: transparent;
    color: var(--foreground);
    border: 1px solid var(--border);
}

.btn-outline:hover {
    background-color: var(--muted);
}

/* Responsive */
@media (max-width: 768px) {
    .navbar-nav {
        display: none;
    }
    
    .navbar-auth {
        gap: 0.25rem;
    }
    
    .btn {
        padding: 0.375rem 0.75rem;
        font-size: 0.75rem;
    }
}

/* Ajustement pour le contenu principal */
body {
    padding-top: 80px;
}
</style> 