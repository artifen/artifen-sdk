# Sprint 1 — Foundation

**Date :** 16 Juillet 2026
**Règle :** Pas une ligne de feature avant que cette checklist soit entièrement verte.

## Gate de sortie

- [ ] `vendor/bin/phpunit` — vert
- [ ] `vendor/bin/phpstan analyse` — 0 erreur (max level)
- [ ] `composer validate` — valide
- [ ] `php-cs-fixer` — conforme
- [ ] GitHub Actions — vert (lint + test + analyse)
- [ ] `examples/hello-world.php` — fonctionne
- [ ] Première release taguée `v0.1.0`

## Tests à écrire

| # | Test | Priorité |
|:-:|:-----|:---------|
| 1 | Kernel — `Artifen::make()` retourne un Kernel | 🔴 |
| 2 | Kernel — `->provider()` enregistre un provider | 🔴 |
| 3 | Kernel — `->run()` retourne une Response | 🔴 |
| 4 | Kernel — l'API fluide chaîne correctement | 🔴 |
| 5 | DeepSeekProvider — `chat()` retourne une string | 🔴 |
| 6 | DeepSeekProvider — `name()` retourne 'DeepSeek' | 🔴 |
| 7 | DeepSeekProvider — `health()` retourne bool | 🔴 |
| 8 | DeepSeekProvider — timeout lève une exception | 🔴 |
| 9 | DeepSeekProvider — `supportsJson()` retourne true | 🔴 |
| 10 | Registry — `provider()` register + resolve | 🔴 |
| 11 | Registry — `agent()` register + resolve | 🔴 |
| 12 | Registry — provider inexistant lève exception | 🔴 |
| 13 | ExecutionPipeline — `addStage()` + `execute()` | 🔴 |
| 14 | Pipeline — les stages sont exécutés dans l'ordre | 🔴 |
| 15 | AbstractProvider — `retry()` relance après échec | 🟡 |
| 16 | AbstractProvider — `health()` false si provider HS | 🟡 |
| 17 | HasCapabilities — valeurs par défaut | 🟡 |
| 18 | Events — BeforeAgentRun contient agentId + task | 🟡 |
| 19 | Events — AfterAgentRun contient result | 🟡 |
| 20 | ProviderFactory — `create()` retourne un provider | 🟡 |
| 21 | ProviderFactory — provider inconnu lève exception | 🟡 |
| 22 | ResponseInterface — contenu + métadonnées | 🟢 |
| 23 | ContextInterface — get/set/all | 🟢 |
| 24 | Config — valeurs par défaut | 🟢 |
| 25 | Exception — classes spécialisées lancent runtime | 🟢 |

🔴 = critique (core API) · 🟡 = important · 🟢 = bonus
