# RFC 0001 — Public API

**Status:** Draft  
**Date:** 2026-07-16  
**Author:** Auguste & Hermes  

## Summary

Définir l'API publique stable d'Artifen SDK, garantie pour les développeurs tiers.

## Contract

```php
$kernel = new Artifen\Core\Kernel();

$response = $kernel->run(
    agent: 'wordpress',      // Agent ID (string)
    task: '...',             // Task description (string)
    provider: 'deepseek'     // Provider name (string, optional)
);
```

## Garanties

| API | Stabilité depuis | Breaking ? |
|:----|:----------------:|:----------:|
| `Kernel::run()` | v0.1 | ❌ Aucun |
| `AgentInterface::run()` | v0.1 | ❌ Aucun |
| `LLMProviderInterface` | v0.1 | ❌ Aucun |
| Autres interfaces | v0.1 | ⚠️ Minor versions |

## Processus de breaking change

1. Déposer une RFC (`rfcs/NNNN-titre.md`)
2. Discussion (min. 72h)
3. Validation par le CTO
4. Migration guide publié
5. Changement en version majeure

## API non-publique

- Pipeline stages internes
- Implémentations spécifiques des providers
- Backends de stockage Memory
- Format des fichiers de config
