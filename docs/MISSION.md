# Artifen — Mission d'Industrialisation

**Date :** 16 Juillet 2026
**Instruction :** Plus aucune discussion d'architecture. Mode livraison uniquement.

## Mission
> Industrialiser Artifen SDK pour la version 1.0

## Étapes (ordre strict)

| # | Objectif | Critère de succès |
|:-:|:---------|:-----------------|
| 1 | ✅ **Tests** | 90-95% coverage sur le SDK |
| 2 | ✅ **CI** | GitHub Actions (PHPUnit + PHPStan + CS Fixer) |
| 3 | ✅ **Packagist** | `artifen/sdk` publié et installable |
| 4 | ✅ **artifen-wordpress** | Package séparé (0 code SDK dedans) |
| 5 | ✅ **artifen/forms** | Premier produit commercial sur WordPress.org |

## Ce qui est déjà fait (ne pas retoucher)

```
✅ Brand (Artifen, .com, GitHub)
✅ Architecture 4 niveaux (SDK → Adapter → Modules → Plugins)
✅ 15 contracts, 29 fichiers PHP, DeepSeekProvider
✅ VISION v3, RFC 0001, ROADMAP-30DAYS
✅ API stable : Artifen::make()->provider()->run()
```

## Règle absolue
> Aucune nouvelle fonctionnalité avant que la CI soit verte sur `main`.

## Règle stricte
> Aucune ligne WordPress dans `artifen/sdk`. Jamais.
