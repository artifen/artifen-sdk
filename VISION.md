# Artifen — Constitution du Projet v2

**Version :** 2.0
**Date :** 16 Juillet 2026
**Fondateur :** Auguste

## La Grande Ambition
> Devenir le Symfony des agents IA en PHP.
> Le framework d'orchestration d'agents pour PHP.

## Principes fondateurs
1. **SDK d'abord.** Le plugin WordPress est une démonstration, pas le produit.
2. **API publique stable.** `Artifen::make()->provider()->agent()->run()` doit marcher dans 5 ans.
3. **Interfaces avant tout.** Les contracts sont sacrés. Les implémentations sont remplaçables.
4. **PHP d'abord.** Aucun équivalent mature de LangChain/CrewAI n'existe en PHP. Artifen comble ce vide.
5. **TDD.** Test → Interface → Implémentation → Refactor. Aucun merge si un test échoue.
6. **Modules auto-découvrables.** `composer require artifen/forms` → tout fonctionne.

## Architecture

```
                    Artifen SDK
                         │
            ┌────────────┼────────────┐
            ▼            ▼            ▼
        Providers    Registry     Pipeline
        (LLM)        (Container)  (Workflow)
            │            │            │
            └────────────┼────────────┘
                         ▼
                   Runtime (Prompt → Memory → LLM → Response)
                         │
            ┌────────────┼────────────┐
            ▼            ▼            ▼
      WordPress     Laravel       CLI / API
      Adapter       Adapter       Scripts
```

## Marque
- **Artifen** — du latin *artifex* (artisan, créateur)
- Tagline : *Build Smarter*
- Palette : Violet (#7C3AED) + Cyan (#0891B2)
- Licence : GPL-2.0-or-later

## Roadmap 30 jours

| Semaine | Objectif |
|:-------:|:---------|
| 1 | ✅ 25+ tests, CI GitHub, examples |
| 2 | PromptManager, Pipeline final, Events, Logger |
| 3 | WordPress Adapter, flux complet validé |
| 4 | Artifen Forms MVP (CF7) |

## Marchés cibles (par ordre)

1. 📦 WordPress (premier adaptateur)
2. 🧪 Laravel / Symfony (framework PHP)
3. 🖥️ CLI / Scripts d'automatisation
4. 🏪 Drupal / PrestaShop (CMS PHP)

## Règle ultime
> Aucune fonctionnalité n'existe si elle n'a pas un test, une interface et une implémentation.
