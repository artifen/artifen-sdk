# Artifen SDK — Architecture Détaillée

## Principe fondateur
> Le SDK est construit UNE FOIS. Tous les plugins l'utilisent.
> Un plugin est une application sur le SDK, pas un projet indépendant.

## Monorepo Structure

```
artifen-sdk/
│
├── packages/
│   ├── core/           ← Kernel IA : LLM Manager, Prompts, Agent Runtime
│   ├── agents/         ← Agents spécialisés (Forms, Commerce, Builder...)
│   ├── skills/         ← Skills réutilisables (WordPress, WooCommerce, ACF...)
│   ├── memory/         ← Memory Framework (contexte, historique, vector store)
│   ├── prompts/        ← Prompt templates versionnés
│   ├── wordpress-sdk/  ← WordPress hooks, REST API, capabilities
│   └── ui/             ← Composants React partagés (Tailwind, dark mode)
│
├── plugins/            ← Modules applicatifs (apps sur le SDK)
│   ├── forms/          ← Artifen Forms (CF7 killer)
│   ├── commerce/       ← Artifen Commerce (WooCommerce Brain)
│   ├── builder/        ← Artifen Builder (ACF killer)
│   ├── designer/       ← Artifen Designer (Elementor killer)
│   └── seo/            ← Artifen SEO (Rank Math killer)
│
├── docs/
│   ├── ARCHITECTURE.md
│   ├── CODING.md
│   └── ROADMAP.md
│
├── examples/
└── tests/
```

## Core Package

```
packages/core/
├── src/
│   ├── LLM/
│   │   ├── Manager.ts        ← Route les appels LLM
│   │   ├── Provider.ts       ← Interface commune
│   │   └── RateLimiter.ts    ← Quotas et coûts
│   │
│   ├── Agent/
│   │   ├── Runtime.ts        ← Boucle d'exécution
│   │   ├── ToolRegistry.ts   ← Outils disponibles
│   │   └── Context.ts        ← Contexte agent
│   │
│   ├── Skill/
│   │   ├── Loader.ts         ← Charge les skills
│   │   └── Registry.ts       ← Catalogue de skills
│   │
│   ├── Memory/
│   │   ├── Store.ts          ← Stockage conversations
│   │   ├── VectorStore.ts    ← Recherche sémantique
│   │   └── Summary.ts        ← Résumé auto
│   │
│   └── Prompt/
│       ├── Template.ts       ← Templates versionnés
│       └── Optimizer.ts      ← Compression contexte
│
├── __tests__/
└── index.ts
```

## Interface Agent

```typescript
interface Agent {
  id: string;
  name: string;
  skills: Skill[];
  tools: Tool[];
  run(input: AgentInput): Promise<AgentOutput>;
  getTools(): Tool[];
  getContext(): Context;
}
```

## Interface Plugin

```typescript
interface ArtifenPlugin {
  id: string;
  name: string;
  target: string;
  register(): void;
  agent: Agent;
  settings: Setting[];
}
```

## Design Patterns

1. **Plugin-Architecture** : chaque plugin app sur le SDK
2. **Strategy Pattern** : LLM interchangeables
3. **Observer Pattern** : events WP → agents
4. **Repository Pattern** : abstraction données
5. **Dependency Injection** : services partagés

## Règles strictes

- NE JAMAIS envoyer tout WordPress au LLM. Contexte structuré.
- Tout appel LLM passe par le LLM Manager (rate limiting, fallback, cache)
- Un skill = fichier de connaissances. Pas de logique métier.
- Les plugins passent par l'Agent Runtime, jamais direct LLM
- Données WP encapsulées dans le WordPress SDK

## Stack Technique

| Couche | Technologie |
|:-------|:-----------|
| Runtime | Node.js 22+ / PHP 8.3+ |
| Langage | TypeScript (SDK) / PHP (plugins WP) |
| UI | React 19 + Tailwind 4 |
| Build | TypeScript + Vite |
| Tests | Vitest + Playwright |
| WP SDK | PHP 8.3+ classes with hooks |
| Monorepo | npm workspaces |
| CI/CD | GitHub Actions |
