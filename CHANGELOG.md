# Changelog

Toutes les modifications notables du SDK Artifen seront documentées dans ce fichier.

Le format est basé sur [Keep a Changelog](https://keepachangelog.com/fr/1.1.0/),
et ce projet adhère au [Semantic Versioning](https://semver.org/lang/fr/).

## [0.1.0] — 2026-08-16

### Ajouté
- Kernel (`Artifen\Core\Kernel`) : fabrique, enregistrement providers/agents/skills/prompts, `run()`.
- Registry (`Artifen\Core\Registry`) : API fluide setter/getter, provider par défaut.
- DefaultResponse : implémentation concrète de `Contracts\Response`.
- ProviderFactory (`Artifen\Providers\ProviderFactory`) : register/create/available.
- DeepSeekProvider (`Artifen\Engine\DeepSeekProvider`) : chat, models, retry avec backoff.
- ExecutionPipeline : stages chaînés avec passage de contexte.
- 4 events (LLMRequest, LLMResponse, BeforeAgentRun, AfterAgentRun).
- 6 exceptions (LLM, Provider, Prompt, Runtime, Skill + ProviderNotFoundException).
- Suite de tests PHPUnit : 23 tests / 45 assertions.
- Config PHPStan niveau 5 (`phpstan.neon`) : zéro erreur.
- Config PHPCS PSR-12 : propre.

### Corrigé
- **PSR-4** : 3 fichiers multi-interfaces (Support, LLM, Runtime) splittés en 12 fichiers
  conforme à la règle "une classe = un fichier". Le SDK ne se chargeait pas sans cela.
- **Autorisation API** : `Authorization: *** <clé>` → `Authorization: Bearer <clé>`
  (2 occurrences). L'API DeepSeek ne fonctionnait pas du tout avant ce correctif.
- **Kernel::run()** : retournait `array` au lieu de `Response` → retourne `DefaultResponse`.
- **ProviderNotFoundException** : étend désormais `Artifen\Exceptions\ProviderException`
  (au lieu de `\RuntimeException` natif) — cohérence du modèle d'exceptions.
- **Interface Prompt** : ajout de `path(): string` (utilisé par Kernel::prompt()).
- Typages : docblocks `@param`/`@return` ajoutés sur Registry, ProviderFactory,
  ExecutionPipeline, AbstractProvider.

### Technique
- PHP 8.2+ requis, PSR-4 (`Artifen\` → `src/`).
- Licence GPL-2.0-or-later.
