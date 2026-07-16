# 🧠 Artifen SDK

**The AI Development Platform for WordPress.**

Artifen est le SDK open-source qui permet de construire des plugins WordPress intelligents.  
Un noyau IA agnostique, des interfaces propres, des agents spécialisés.

## Architecture

```
Artifen SDK
    │
    ├── Contracts/    ← Interfaces (AIProvider, Agent, Skill, Memory...)
    ├── Core/         ← Kernel (registre providers, agents, skills)
    ├── AI/           ← LLM drivers (DeepSeek, Ollama, etc.)
    ├── Agents/       ← Agent Framework
    ├── Skills/       ← Skill Framework
    ├── Memory/       ← Memory Framework
    ├── Providers/    ← Implémentations LLM
    └── WordPress/    ← Adaptateur WordPress
```

## Installation

```bash
composer require artifen/sdk
```

## Utilisation minimale

```php
use Artifen\Core\Kernel;

$kernel = new Kernel();
$kernel->registerProvider('deepseek', new DeepSeekProvider($apiKey));
$kernel->registerAgent(new FormAgent());
$kernel->registerSkill(new CF7Skill());

$result = $kernel->agent('forms')->run('Créer un formulaire de contact');
```

## Modules

| Module | Cible | Statut |
|:-------|:------|:-------|
| Artifen Forms | Contact Form 7 | 🚧 MVP |
| Artifen Commerce | WooCommerce | 📋 Planifié |
| Artifen Fields | ACF | 📋 Planifié |
| Artifen Builder | Elementor | 📋 Planifié |
| Artifen SEO | Rank Math | 📋 Planifié |

## Licence

GPL-2.0-or-later — compatible WordPress.
