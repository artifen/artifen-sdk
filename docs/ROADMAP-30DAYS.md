# Artifen — Feuille de route 30 jours

**Date :** 16 Juillet 2026  
**Décision :** Architecture gelée. Exécution uniquement.

## Semaine 1 — Tests & CI
- [ ] 25+ tests PHPUnit (Kernel, PromptManager, DeepSeekProvider, Registry)
- [ ] CI GitHub Actions (composer validate → phpstan → phpunit → phpcs)
- [ ] Stabilisation API publique
- [ ] Examples/ (hello-world, provider-deepseek, prompt-loader)

## Semaine 2 — Composants Core
- [ ] PromptManager (charge markdowns, cache, variables, render)
- [ ] ExecutionPipeline finalisé
- [ ] Event system + Logger
- [ ] Config system

## Semaine 3 — WordPress Adapter
- [ ] Premier adaptateur WordPress
- [ ] WordPressAgent minimal
- [ ] Flux complet validé dans WordPress

## Semaine 4 — Artifen Forms (MVP)
- [ ] Génération formulaires CF7
- [ ] Génération e-mails notification
- [ ] Suggestions validation + améliorations
- [ ] Publication WordPress.org

## Règle d'or
> Test → Interface → Implémentation → Refactor.
> Aucun merge si un test échoue.
> TDD léger.
