# PHP Template - CyberCTF Library

Un template PHP moderne inspiré de Next.js avec des composants UI inspirés de shadcn/ui.

## 🚀 Fonctionnalités

- **Design moderne** : Interface inspirée de Next.js avec des composants UI élégants
- **Système de composants** : Architecture modulaire avec 30+ composants UI
- **Responsive** : Design adaptatif pour tous les appareils
- **Performance** : Code optimisé et léger
- **Accessibilité** : Composants conformes aux standards WCAG
- **Métadonnées dynamiques** : Configuration via fichier JSON

## 📁 Structure du projet

```
php-site/
├── build/              # Site web (index.php, components, assets, etc.)
├── deploy/             # Configuration Docker et métadonnées
│   ├── docker-compose.yaml
│   ├── docker-compose.dev.yaml
│   └── metadata.json
├── docs/               # Documentation
├── test/               # Tests
└── README.md           # Ce fichier
```

## 🛠️ Installation et lancement

### Option 1 : Avec Docker (Recommandé)

1. **Lancer avec Docker Compose**
```bash
cd php-site/deploy
docker-compose up -d
```

2. **Accéder au site**
- Site principal : http://localhost:8000
- phpMyAdmin : http://localhost:8080

3. **Arrêter les services**
```bash
docker-compose down
```

### Option 2 : Mode développement

```bash
cd php-site/deploy
docker-compose -f docker-compose.dev.yaml up -d
```

### Option 3 : Serveur PHP local

```bash
cd php-site/build
php -S localhost:8000
```

## 🔧 Configuration

### Métadonnées du site

Modifiez le fichier `deploy/metadata.json` pour personnaliser :
- Nom et description du site
- Navigation
- Liens du footer
- Informations du challenge CTF

### Variables d'environnement Docker

- **Port du site** : 8000
- **Port MySQL** : 3306
- **Port phpMyAdmin** : 8080
- **Base de données** : cyberctf
- **Utilisateur** : cyberctf
- **Mot de passe** : cyberctf123

## 🎨 Composants disponibles

### Composants de base
- **Button** : Boutons avec variantes et états
- **Card** : Conteneurs avec ombres et bordures
- **Input** : Champs de saisie stylisés
- **Badge** : Étiquettes et badges

### Composants avancés
- **Alert** : Messages d'alerte
- **Dialog** : Modales et dialogues
- **Tabs** : Navigation par onglets
- **Table** : Tableaux de données
- **Progress** : Barres de progression
- **Skeleton** : Placeholders de chargement

### Composants spécialisés
- **ChallengeToast** : Notifications pour les défis CTF
- **Avatar** : Images de profil
- **Breadcrumb** : Navigation hiérarchique

## 📝 Utilisation

### Inclure un composant
```php
<?php include 'components/ui/Button.php'; ?>
<?php echo Button::render('Cliquer ici', ['variant' => 'primary']); ?>
```

### Utiliser les métadonnées
```php
<?php
require_once 'config/metadata.php';
$siteName = Metadata::get('site.name');
$challengeTitle = Metadata::get('challenge.title');
?>
```

## 🧪 Tests

### Lancer les tests
```bash
cd php-site/build
npm test
```

## 📚 Documentation

Consultez le dossier `docs/` pour :
- Guide d'utilisation des composants
- Configuration avancée
- Bonnes pratiques
- Exemples d'implémentation

## 🚀 Déploiement

### Déploiement en production
1. Modifiez `deploy/docker-compose.yaml` pour la production
2. Configurez les variables d'environnement
3. Déployez avec `docker-compose up -d`

### Déploiement simple
1. Uploadez le contenu du dossier `build/` sur votre serveur
2. Configurez votre serveur web pour pointer vers `index.php`
3. Vérifiez les permissions des dossiers

## 🤝 Contribution

1. Fork le projet
2. Créez une branche pour votre fonctionnalité
3. Committez vos changements
4. Poussez vers la branche
5. Ouvrez une Pull Request

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 🆘 Support

- **Documentation** : Consultez le dossier `docs/`
- **Issues** : Ouvrez une issue sur GitHub
- **Discussions** : Utilisez les discussions GitHub

---

**Développé avec ❤️ pour la communauté CyberCTF** 