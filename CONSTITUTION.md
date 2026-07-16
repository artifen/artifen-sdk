# Constitution Artifen v1

**Version :** 1.0
**Date :** 16 Juillet 2026

---

## Règle n°1 — Les tests d'abord

Aucune fonctionnalité n'est développée tant que `vendor/bin/phpunit` n'est pas entièrement vert.

Objectif de couverture : 25 → 50 → 100 tests, puis > 90%.

---

## Règle n°2 — Le SDK est sacré

Le SDK ne contient jamais :
- WordPress
- Laravel
- Symfony
- WooCommerce
- Elementor
- Aucun CMS ou framework externe

Uniquement :
- PHP 8.2+
- PSR-4 / PSR-12
- Contrats / Interfaces
- Runtime
- Pipeline
- Providers

---

## Règle n°3 — L'API publique est stable

Une fois publiée, l'API suivante ne change pas :

```php
Artifen::make()
    ->provider('name', new Provider($key))
    ->run(agent: 'id', task: '...');
```

Les évolutions sont compatibles ascendantes ou passent par une version majeure (RFC obligatoire).

---

## Règle n°4 — Les plugins font évoluer le SDK

Jamais l'inverse. Le cycle est :

```
Plugin → Besoin réel → RFC → SDK → Tests → Release
```

Aucune feature sans use case validé par un module.

---

## Règle n°5 — "Done" a une définition

Une fonctionnalité est terminée uniquement si :

- [ ] le code compile
- [ ] les tests passent
- [ ] PHPStan ne remonte aucune erreur (max level)
- [ ] le style de code est conforme (PSR-12)
- [ ] la documentation est à jour
- [ ] un exemple d'utilisation fonctionne

---

## Gate validation — Sprint 1 → Sprint 2

Le SDK ne passe en Sprint 2 que si :

- [ ] `vendor/bin/phpunit` — vert
- [ ] `vendor/bin/phpstan` — 0 erreur
- [ ] `composer validate` — valide
- [ ] `php-cs-fixer` — conforme
- [ ] `rector` — ok
- [ ] GitHub Actions — vert (lint + test + analyse)
- [ ] README exécutable — `composer install && vendor/bin/phpunit`
- [ ] Exemple fonctionne — `examples/hello-world.php`
- [ ] Première release taguée — `v0.1.0`

---

## Politique de branches

- `main` est toujours publiable.
- Toute fonctionnalité → branche dédiée (`feat/`, `fix/`).
- PR fusionnée uniquement si CI verte.
