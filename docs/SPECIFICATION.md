# Artifen SDK Specification v1.0

**Version :** 1.0
**Date :** 16 Juillet 2026
**Auteur :** Auguste (CEO) & Hermes (CTO)

---

## Partie 1 — Vision

### Mission
> Donner aux créateurs le pouvoir de construire des plateformes intelligentes.

### Vision
> Devenir le standard open-source pour le développement d'applications assisté par IA.

### Objectifs

1. **Rendre l'IA accessible** aux développeurs WordPress sans PhD en machine learning
2. **Standardiser les interactions LLM** via des interfaces propres et interchangeables
3. **Éviter le vendor lock-in** — DeepSeek aujourd'hui, un autre demain
4. **Construire un écosystème** de modules qui partagent le même socle technique

### Cibles

| Phase | Module | Marché |
|:------|:-------|:-------|
| MVP | Artifen Forms → CF7 | 10M+ installs |
| 2 | Artifen Commerce → WooCommerce | 7M+ installs |
| 3 | Artifen Builder → Elementor | 10M+ installs |
| 4 | Artifen Fields → ACF | 2M+ installs |
| 5 | Artifen SEO → Rank Math | 3M+ installs |

---

## Partie 2 — Architecture

### Principe fondateur

> Tu ne construis pas un plugin. Tu construis un framework d'agents IA.  
> Le plugin WordPress n'est qu'un adaptateur.

### Architecture globale

```
                    Artifen Kernel
                          │
            ┌─────────────┼─────────────┐
            ▼             ▼             ▼
      Agent Runtime   Prompt Studio   LLM Manager
            │             │             │
            ▼             ▼             ▼
      Skill Engine   Tool Runtime   Memory Manager
            │             │             │
            └─────────────┼─────────────┘
                          ▼
                   WordPress Adapter
                          │
              ┌───────────┼────────────┐
              ▼           ▼            ▼
         CF7 Adapter  Woo Adapter  ACF Adapter
```

### Flow d'exécution

```
Tâche entrante
    │
    ▼
Kernel.receive(task)
    │
    ▼
AgentRuntime.selectAgent(task)
    │
    ▼
SkillEngine.load(skills)
    │
    ▼
MemoryManager.get(context)
    │
    ▼
PromptManager.build(system + agent + skills + context)
    │
    ▼
LLMManager.chat(prompt)
    │
    ▼
ToolRuntime.execute(tools)
    │
    ▼
AgentRuntime.respond(result)
    │
    ▼
Kernel.respond(output)
```

### Diagramme de classes

```
┌─────────────────────┐
│      Kernel         │
├─────────────────────┤
│ + runtime()         │
│ + llm()             │
│ + memory()          │
│ + skills()          │
│ + tools()           │
│ + prompts()         │
└────────┬────────────┘
         │
         ▼
┌─────────────────────┐
│   AgentRuntime      │
├─────────────────────┤
│ + run(task)         │
│ + registerAgent()   │
│ + agent(id)         │
└────────┬────────────┘
         │
    ┌────┴────┐
    ▼         ▼
┌────────┐ ┌──────────┐
│  Agent │ │  Skill   │
├────────┤ ├──────────┤
│ + id() │ │ + name() │
│ + run()│ │ + exec() │
│ +skill │ │ + schema │
└────────┘ └──────────┘
```

---

## Partie 3 — Interfaces (Contracts)

### KernelInterface

```php
interface Kernel {
    public function runtime(): AgentRuntime;
    public function llm(): LLMManager;
    public function memory(): MemoryManager;
    public function skills(): SkillEngine;
    public function tools(): ToolRuntime;
    public function prompts(): PromptManager;
}
```

### AgentInterface

```php
interface Agent {
    public function id(): string;
    public function name(): string;
    public function description(): string;
    public function skills(): array;
    public function run(string $input, Context $ctx): Result;
    public function withSkill(Skill $skill): static;
}
```

### LLMProviderInterface

```php
interface LLMProvider {
    public function chat(array $messages, array $options = []): string;
    public function stream(array $messages, callable $onChunk): void;
    public function embeddings(string $input): array;
    public function models(): array;
    public function health(): bool;
}
```

### LLMManagerInterface

```php
interface LLMManager {
    public function register(string $name, LLMProvider $provider): void;
    public function provider(?string $name = null): LLMProvider;
    public function chat(array $messages, array $options = []): string;
    public function stream(array $messages, callable $onChunk): void;
    public function embeddings(string $input): array;
}
```

### SkillInterface

```php
interface Skill {
    public function name(): string;
    public function description(): string;
    public function instructions(): string;
    public function execute(array $params = []): mixed;
}
```

### ToolInterface

```php
interface Tool {
    public function name(): string;
    public function description(): string;
    public function execute(array $params): mixed;
    public function schema(): array;
}
```

### MemoryInterface

```php
interface Memory {
    public function remember(string $key, mixed $value, array $meta = []): void;
    public function recall(string $key): mixed;
    public function search(string $query): array;
    public function forget(string $key): void;
}
```

### PromptInterface

```php
interface Prompt {
    public function render(array $variables = []): string;
    public function path(): string;
    public function metadata(): array;
}
```

### AgentResultInterface

```php
interface AgentResult {
    public function output(): string;
    public function success(): bool;
    public function duration(): float;
    public function tokens(): int;
    public function logs(): array;
}
```

---

## Partie 4 — Conventions

### Namespaces

```
Artifen\Kernel         ← Point d'entrée
Artifen\Contracts      ← Toutes les interfaces
Artifen\AI             ← Implémentations LLM (OpenAI, DeepSeek...)
Artifen\Agent          ← Runtime + agents
Artifen\Skill          ← Skills
Artifen\Tool           ← Tools
Artifen\Memory         ← Memory stores
Artifen\Prompt         ← Prompt manager + templates
Artifen\WordPress      ← WordPress adapter
Artifen\Providers      ← Provider factory
Artifen\Support        ← Helpers, exceptions, logging
Artifen\Tests          ← Tests
```

### Standards

| Règle | Standard |
|:------|:---------|
| PHP | 8.2 minimum |
| Autoloading | PSR-4 |
| Coding style | PSR-12 |
| Tests | PHPUnit 11 |
| Static analysis | PHPStan max level |
| Psalm | level 1 |
| Rector | règles complètes |
| Types | declare(strict_types=1) partout |
| Exceptions | classes d'exception par module |
| Logging | PSR-3 (Monolog) |
| Cache | PSR-6/PSR-16 |

### Structure de commit

```
feat(llm): ajout LLM Manager avec rate limiting
feat(agent): implementation Agent Runtime v1
fix(memory): correction fuite mémoire dans VectorStore
docs(architecture): mise à jour diagrammes UML
test(skills): couverture 100% Skill Engine
```

---

## Partie 5 — Roadmap v1

### v0.1.0 — Core Kernel
- [ ] LLM Manager + OpenAI/DeepSeek providers
- [ ] Agent Runtime basique
- [ ] Skill Engine
- [ ] Tool Runtime
- [ ] Memory Manager (array)
- [ ] Prompt Manager (filesystem)
- [ ] Tests unitaires
- [ ] CI GitHub Actions

### v0.2.0 — WordPress Adapter
- [ ] WordPress hooks integration
- [ ] WP REST API endpoints
- [ ] Settings page
- [ ] CF7 adapter
- [ ] Artifen Forms MVP

### v1.0.0 — Production
- [ ] Memory persistante (SQLite)
- [ ] Rate limiting configurable
- [ ] Dashboard React
- [ ] Documentation complète
- [ ] WordPress.org submission

### v2.0.0 — Écosystème
- [ ] Artifen Commerce
- [ ] Artifen Builder
- [ ] Artifen Fields
- [ ] Artifen SEO
- [ ] Artifen Cloud Marketplace
- [ ] Laravel/Symfony adapters

---

*Artifen — Build Smarter.*
