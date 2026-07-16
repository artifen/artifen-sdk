# Artifen Coding Standards

## Langages
- **SDK** : TypeScript strict mode
- **Plugins** : PHP 8.3+ avec types stricts
- **UI** : React 19 + TypeScript + Tailwind 4

## TypeScript
- strict: true dans tsconfig.json
- Pas de `any`. Utiliser `unknown` si nécessaire
- Nommage : camelCase (variables), PascalCase (types/interfaces), kebab-case (fichiers)
- Exports : named exports uniquement (pas de default export)
- Tests : fichiers `.test.ts` à côté du module

## PHP
- `declare(strict_types=1);` en tête de chaque fichier
- PSR-12 coding standard
- PSR-4 autoloading
- WordPress Coding Standards (WPCS) pour les hooks WP

## Git
- Commits en français (conventionnel)
- Format : `type(scope): message` (ex: `feat(core): ajout LLM Manager`)
- Types : feat, fix, docs, refactor, test, chore
- Branches : `feat/forms-agent`, `fix/memory-leak`, `docs/architecture`
- PRs : lien vers l'issue + description + captures si UI

## Qualité
- Tests unitaires obligatoires pour toute logique métier
- Coverage minimum : 80%
- Lint : ESLint (TS) + PHPCS (PHP)
- CI : GitHub Actions (lint + test + build) sur chaque PR
