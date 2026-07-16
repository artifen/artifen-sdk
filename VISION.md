# Artifen — Constitution du Projet v3

**Version :** 3.0 (Finale)
**Date :** 16 Juillet 2026
**Fondateur :** Auguste

## La Grande Ambition
> Le framework PHP d'agents IA spécialisé WordPress.
> Le Symfony des agents IA en PHP.

## Architecture 4 niveaux

```
ARTIFEN PLATFORM
     │
     ▼
┌─────────────────────────────────────────────────────┐
│  N1 — SDK (100% PHP, 0% WordPress)                 │
│  Kernel · Engine · Providers · Pipeline · Prompt   │
│  Memory · Agents · Skills · Tools · Events         │
│                                                     │
│  NE CONNAÎT PAS : add_action, WP_Query, REST API   │
└─────────────────────────────────────────────────────┘
     │
     ▼
┌─────────────────────────────────────────────────────┐
│  N2 — WordPress Adapter (artifen/wordpress)         │
│  Hooks · Filters · REST API · Cron · WP Filesystem │
│  Plugin API · Shortcodes · Blocks                   │
│                                                     │
│  Traduit WordPress → SDK                           │
└─────────────────────────────────────────────────────┘
     │
     ▼
┌─────────────────────────────────────────────────────┐
│  N3 — Modules (artifen/forms, artifen/commerce...) │
│  Utilisent le SDK via l'adapter WordPress           │
│  Déployés via Composer                              │
└─────────────────────────────────────────────────────┘
     │
     ▼
┌─────────────────────────────────────────────────────┐
│  N4 — Plugins (installés par l'utilisateur)         │
│  Artifen Forms · Artifen Commerce · Artifen SEO    │
│  L'utilisateur ne voit jamais le SDK                │
└─────────────────────────────────────────────────────┘
```

## Engine Layer

```
Kernel
  │
  ▼
Engine (orchestrateur de moteurs)
  │
  ├── Chat Engine
  ├── Workflow Engine
  ├── Embedding Engine
  ├── Vision Engine
  ├── Planning Engine
  └── Automation Engine
  │
  ▼
Runtime
  │
  ▼
Providers · Agents · Skills
```

## Règle absolue
> **Aucune ligne WordPress dans le SDK.**
> `add_action()`, `WP_Query`, `wp_remote_post()` → vivent dans `artifen/wordpress`.
> Le SDK doit pouvoir fonctionner dans Laravel, Symfony, CLI, PrestaShop.

## Marketplace (vision 18 mois)
```
composer require artifen/marketplace
  → Installer des Agents, Skills, Workflows
  → Comme VSCode / Cursor / MCP
  → Chaque développeur peut publier
```

## Roadmap

| Phase | Objectif |
|:-----:|:---------|
| 1 | ✅ SDK (29 fichiers, 15 contracts, DeepSeek) |
| 2 | 🚧 Tests + CI + Composer/Packagist |
| 3 | WordPress Adapter |
| 4 | Artifen Forms → WordPress.org |
| 5 | Marketplace (Agents, Skills, Workflows) |
| 6 | Cloud (sync, licences, analytics) |

## API publique (garantie stable)
```php
Artifen\make()
    ->provider('deepseek', new DeepSeekProvider($key))
    ->run(agent: 'wordpress', task: '...');
```

## Licence
GPL-2.0-or-later (compatible WordPress)
