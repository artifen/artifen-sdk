# 🧠 Artifen SDK

**The AI Development Platform for WordPress.**

Artifen est le SDK open-source qui permet de construire des plugins WordPress intelligents.
Un noyau IA agnostique, des interfaces propres, des agents spécialisés.

[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php&logoColor=white)](https://php.net)
[![License](https://img.shields.io/badge/License-GPL--2.0--or--later-blue.svg)](LICENSE)
[![Tests](https://img.shields.io/badge/tests-23%20passed-brightgreen)](https://github.com/artifen/sdk)

## ✨ Pourquoi Artifen ?

- **Noyau IA agnostique** : branchez DeepSeek aujourd'hui, Ollama demain — la même API.
- **Interfaces propres** : `Contracts/` = le contrat stable que vos plugins implémentent.
- **Kernel + Registry** : enregistrez providers, agents, skills et prompts en fluent API.
- **Pipeline d'exécution** : composition de stages (prompt → LLM → post-traitement).
- **Prêt pour WordPress** : licence GPL-2.0-or-later (compatible WP), PSR-4, PHP 8.2+.

## 🧭 Positionnement — WordPress 7.0 et Artifen

WordPress 7.0 (mai 2026) a intégré des **fondations IA natives** dans le core :
AI Client, Abilities API, Connectors hub (OpenAI/Anthropic/Gemini), plugin IA officiel.

**Artifen ne fait pas doublon** : WordPress gère les appels LLM de base et la
connexion des providers. **Artifen apporte la couche agentique** que WP 7.0 ne
fournit pas : Agents, Skills, Mémoire, Pipeline multi-étapes, Workflows métier.

**Avantage coût** : Artifen route vers DeepSeek direct (prix fabricant) au lieu
d'OpenAI/Anthropic — différenciation prix massive, sans verrouillage provider.

## 🏗️ Architecture

```
Artifen SDK
    │
    ├── Contracts/    ← Interfaces (AIProvider, LLMProvider, Agent, Skill, Memory, Prompt, Tool…)
    ├── Core/         ← Kernel (registre providers/agents/skills/prompts) + DefaultResponse
    ├── Engine/       ← AbstractProvider (retry, capabilities) + DeepSeekProvider
    ├── Events/       ← LLMRequest, LLMResponse, BeforeAgentRun, AfterAgentRun
    ├── Exceptions/   ← LLMException, ProviderException, PromptException, SkillException…
    ├── Pipeline/     ← ExecutionPipeline (stages chaînés)
    └── Providers/    ← ProviderFactory + ProviderNotFoundException
```

## 📦 Installation

```bash
composer require artifen/sdk
```

## 🚀 Utilisation minimale

```php
use Artifen\Core\Kernel;
use Artifen\Engine\DeepSeekProvider;

$kernel = Kernel::make();

// 1. Enregistrer un provider LLM (la première devient la provider par défaut)
$kernel->provider('deepseek', new DeepSeekProvider([
    'api_key' => getenv('DEEPSEEK_API_KEY'),
    'model'   => 'deepseek-chat',
]));

// 2. Exécuter une tâche
$response = $kernel->run('agent-id', 'Ta tâche ici');

echo $response->content();   // réponse du LLM
echo $response->provider();  // 'deepseek'
echo $response->duration();  // secondes
```

## 🎛️ API publique (v0.1)

### Kernel (`Artifen\Core\Kernel`)
| Méthode | Description |
|:--------|:------------|
| `Kernel::make()` | Fabrique un Kernel |
| `provider(string $name, LLMProvider $instance): self` | Enregistre un provider |
| `agent(Agent $instance): self` | Enregistre un agent |
| `skill(Skill $instance): self` | Enregistre une skill |
| `prompt(Prompt $instance): self` | Enregistre un prompt |
| `run(string $agent, string $task, ?string $provider = null): Response` | Exécute une tâche |
| `registry(): Registry` | Accès au registre |

### Registry (`Artifen\Core\Registry`)
API fluide — setter si instance fournie, getter sinon (lève `RuntimeException` si absent).

```php
$registry->provider('name', $instance); // setter → retourne $registry
$registry->provider('name');            // getter → retourne LLMProvider
$registry->defaultProvider();           // premier enregistré, sinon 'deepseek'
```

### Response (`Artifen\Core\DefaultResponse`)
`content()`, `success()`, `duration()`, `tokens()`, `provider()`, `model()`, `meta(key, default)`.

### ProviderFactory (`Artifen\Providers\ProviderFactory`)
```php
$factory = new ProviderFactory();
$factory->register('deepseek', $provider);
$factory->create();            // 'deepseek' par défaut
$factory->create('openai');    // ProviderNotFoundException si absent
$factory->available();         // ['deepseek']
```

## ✅ Qualité

| Gate | Statut |
|:-----|:-------|
| PHPUnit | 23 tests / 45 assertions ✅ |
| PHPStan | niveau 5 — zéro erreur ✅ |
| PHPCS | PSR-12 — propre ✅ |
| Appel réel DeepSeek | ✅ (Bearer corrigé, health check OK) |

```bash
composer test       # phpunit
composer analyse    # phpstan (niveau 5)
composer lint       # phpcs PSR-12
composer fix        # phpcbf (auto-correct)
```

## 🧩 Modules (écosystème Artifen)

| Module | Cible | Statut |
|:-------|:------|:-------|
| Artifen Forms | Contact Form 7 | 🚧 MVP |
| Artifen Commerce | WooCommerce | 📋 Planifié |
| Artifen Fields | ACF | 📋 Planifié |
| Artifen Builder | Elementor | 📋 Planifié |
| Artifen SEO | Rank Math | 📋 Planifié |

## 📄 Licence

GPL-2.0-or-later — compatible WordPress.
