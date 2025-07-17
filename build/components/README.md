# Système de Composants PHP

Un système de composants modulaires inspiré de **shadcn/ui** et **React** pour PHP. Ce système permet de créer des interfaces utilisateur cohérentes et réutilisables avec des variantes de style et une gestion d'état simplifiée.

## 🚀 Fonctionnalités

- **Composants modulaires** : Système de composants réutilisables
- **Gestion des variantes** : Multiple styles par composant (comme shadcn/ui)
- **Chargement automatique** : Auto-loading des composants
- **Sécurité intégrée** : Échappement automatique XSS
- **Multi-composants** : Utilisation de plusieurs composants sur une page
- **API simple** : Interface intuitive pour les développeurs

## 📁 Structure

```
components/
├── Component.php              # Classe de base abstraite
├── ComponentLoader.php        # Système de chargement automatique
├── ui/                       # Composants d'interface utilisateur
│   ├── Button.php            # Boutons avec variantes
│   ├── Card.php              # Cartes et sous-composants
│   ├── Input.php             # Champs de saisie
│   ├── Badge.php             # Badges colorés
│   ├── Alert.php             # Alertes avec types
│   └── Avatar.php            # Avatars utilisateur
└── challenge/                # Composants spécifiques CTF
    └── ChallengeToast.php    # Toast d'information challenge
```

## 🛠️ Utilisation de Base

### Chargement du Système

```php
// Charger le système de composants
require_once __DIR__ . '/components/ComponentLoader.php';
```

### Rendu d'un Composant Simple

```php
// Bouton basique
echo renderComponent('Button', [
    'children' => 'Cliquez ici'
]);

// Bouton avec variante
echo renderComponent('Button', [
    'variant' => 'destructive',
    'size' => 'lg',
    'children' => 'Supprimer'
]);
```

### Composition de Composants

```php
// Carte complète avec sous-composants
echo renderComponent('Card', [
    'children' => 
        renderComponent('CardHeader', [
            'children' => 
                renderComponent('CardTitle', [
                    'children' => 'Titre de la carte'
                ]) .
                renderComponent('CardDescription', [
                    'children' => 'Description détaillée'
                ])
        ]) .
        renderComponent('CardContent', [
            'children' => '<p>Contenu principal</p>'
        ]) .
        renderComponent('CardFooter', [
            'children' => renderComponent('Button', [
                'children' => 'Action'
            ])
        ])
]);
```

## 📝 Composants Disponibles

### Button
Bouton avec multiple variantes et tailles.

**Variantes** : `default`, `destructive`, `outline`, `secondary`, `ghost`, `link`  
**Tailles** : `default`, `sm`, `lg`, `icon`

```php
echo renderComponent('Button', [
    'variant' => 'outline',
    'size' => 'lg',
    'href' => '/page',
    'asChild' => 'a',
    'children' => 'Lien bouton'
]);
```

### Card
Composant de carte avec sous-éléments.

**Sous-composants** : `CardHeader`, `CardTitle`, `CardDescription`, `CardContent`, `CardFooter`, `CardAction`

### Input, Label, Textarea
Composants de formulaire avec validation.

```php
echo renderComponent('Label', [
    'for' => 'email',
    'children' => 'Email'
]);

echo renderComponent('Input', [
    'id' => 'email',
    'type' => 'email',
    'placeholder' => 'votre@email.com',
    'required' => true
]);
```

### Badge
Badges avec couleurs de statut.

**Variantes** : `default`, `secondary`, `destructive`, `success`, `warning`, `outline`, `skill`

### Alert
Alertes contextuelles avec icônes.

**Variantes** : `default`, `destructive`, `success`, `warning`, `info`

### Avatar
Avatars utilisateur avec fallback.

**Sous-composants** : `AvatarImage`, `AvatarFallback`

### ChallengeToast
Composant spécialisé pour afficher les informations de challenge CTF.

## 🎨 Système de Variantes

Chaque composant utilise un système de variantes similaire à **class-variance-authority** :

```php
protected $variants = [
    'base' => 'classes-de-base',
    'variants' => [
        'default' => 'classes-variante-par-defaut',
        'destructive' => 'classes-variante-destructive'
    ],
    'sizes' => [
        'sm' => 'classes-petite-taille',
        'lg' => 'classes-grande-taille'
    ]
];
```

## 🔧 Création d'un Nouveau Composant

1. **Créer la classe** en étendant `Component` :

```php
<?php
require_once __DIR__ . '/../Component.php';

class MonComposant extends Component {
    protected $variants = [
        'base' => 'classes-css-de-base',
        'variants' => [
            'default' => 'style-par-defaut'
        ]
    ];

    public function render() {
        $variant = $this->props['variant'] ?? 'default';
        
        $classes = $this->cn(
            $this->getVariantClasses($variant),
            $this->className
        );
        
        return sprintf(
            '<div class="%s">%s</div>',
            $classes,
            $this->children
        );
    }
}

// Enregistrer le composant
ComponentManager::register('MonComposant', 'MonComposant');
```

2. **L'utiliser** dans vos pages :

```php
echo renderComponent('MonComposant', [
    'variant' => 'default',
    'children' => 'Contenu'
]);
```

## 🚦 Multi-Composants sur une Page

### Méthode Array

```php
$components = [
    ['type' => 'Alert', 'props' => ['variant' => 'success', 'children' => 'Succès !']],
    ['type' => 'Button', 'props' => ['children' => 'Action']],
    ['type' => 'Card', 'props' => ['children' => 'Contenu de carte']]
];

echo renderPage($components);
```

### Méthode Directe

```php
// Utilisation directe dans le HTML
echo renderComponent('Alert', ['variant' => 'info', 'children' => 'Information']);
echo renderComponent('Card', ['children' => 'Ma carte']);
echo renderComponent('Button', ['children' => 'Mon bouton']);
```

## 🔒 Sécurité

- **Échappement automatique** : Toutes les données utilisateur sont échappées
- **Validation des propriétés** : Filtrage des attributs HTML
- **Protection XSS** : Utilisation de `htmlspecialchars()`

## 🎯 Exemple Complet

```php
<?php
require_once __DIR__ . '/components/ComponentLoader.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ma Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php
    // Alerte de bienvenue
    echo renderComponent('Alert', [
        'variant' => 'success',
        'children' => 
            renderComponent('AlertTitle', ['children' => 'Bienvenue !']) .
            renderComponent('AlertDescription', ['children' => 'Votre compte a été créé avec succès.'])
    ]);
    
    // Carte de profil
    echo renderComponent('Card', [
        'className' => 'max-w-md mx-auto mt-8',
        'children' => 
            renderComponent('CardHeader', [
                'children' => 
                    renderComponent('CardTitle', ['children' => 'Profil Utilisateur']) .
                    renderComponent('CardAction', [
                        'children' => renderComponent('Badge', [
                            'variant' => 'success',
                            'children' => 'Actif'
                        ])
                    ])
            ]) .
            renderComponent('CardContent', [
                'children' => 
                    '<div class="space-y-4">' .
                    renderComponent('Avatar', [
                        'className' => 'h-16 w-16 mx-auto',
                        'children' => renderComponent('AvatarFallback', ['children' => 'JD'])
                    ]) .
                    '<div class="text-center">' .
                    '<h3 class="font-semibold">John Doe</h3>' .
                    '<p class="text-sm text-muted-foreground">john@example.com</p>' .
                    '</div>' .
                    '</div>'
            ]) .
            renderComponent('CardFooter', [
                'children' => 
                    '<div class="flex w-full gap-2">' .
                    renderComponent('Button', [
                        'variant' => 'outline',
                        'className' => 'flex-1',
                        'children' => 'Modifier'
                    ]) .
                    renderComponent('Button', [
                        'className' => 'flex-1',
                        'children' => 'Sauvegarder'
                    ]) .
                    '</div>'
            ])
    ]);
    ?>
</body>
</html>
```

Ce système vous permet de créer rapidement des interfaces modernes et cohérentes en PHP avec la flexibilité des composants React et la puissance de shadcn/ui ! 