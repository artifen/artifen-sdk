# Artifen — Constitution du Projet v3

**Version :** 3.0 (Finale)
**Date :** 16 Juillet 2026
**Fondateur :** Auguste

## La Grande Ambition
> Le framework PHP d'agents IA spécialisé WordPress.
> Le Symfony des agents IA en PHP.

## Positionnement (mis à jour 16/08/2026 — WordPress 7.0)

**Contexte** : WordPress 7.0 (sorti le 20/05/2026) a intégré des fondations IA natives
dans le core : AI Client (SDK PHP IA), Abilities API, Connectors hub (OpenAI/Anthropic/
Gemini en quelques clics), plugin IA officiel, MCP Adapter.

**Positionnement Artifen** : Artifen **ne concurrence pas** l'AI Client de WP 7.0 —
il s'y **greffe**. WordPress fait les appels LLM de base et la connexion providers.
Artifen apporte ce que WP 7.0 ne fait pas :

| WP 7.0 (core) | Artifen (valeur ajoutée) |
|:---------------|:--------------------------|
| Appels LLM de base | ✅ **Agents** (framework agentique complet) |
| Connecter des providers | ✅ **Skills** (compétences réutilisables) |
| Générer images/titres | ✅ **Mémoire** (persistance) |
| MCP pour devs | ✅ **Pipeline** multi-étapes |
| | ✅ **Workflows** métier (Forms → LLM → action) |

**Avantage coût** : le AI Client WP route vers OpenAI/Anthropic/Gemini.
Artifen route vers DeepSeek direct (prix fabricant) — différenciation prix massive
pour les clients sensibles aux coûts, tout en restant agnostique (n'importe quel
provider via `Providers/`).

**Le timing est favorable** : WordPress a éduqué le marché (mai 2026). Les plugins
cherchent maintenant la couche agentique — c'est notre place.

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
