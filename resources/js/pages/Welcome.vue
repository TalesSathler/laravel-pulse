<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {
    Activity, AlertTriangle, BookOpen, Cpu, Database, ExternalLink,
    FlaskConical, HeartHandshake, Radar, Server, Shield, Sparkles, Zap,
} from '@lucide/vue';
import { ref } from 'vue';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { dashboard, login, register } from '@/routes';

const svgRef = ref<HTMLElement | null>(null);
const tiltStyle = ref({ transform: 'perspective(800px) rotateX(0deg) rotateY(0deg)' });

const handleMouseMove = (e: MouseEvent) => {
    const el = svgRef.value;
    if (!el) return;
    const rect = el.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    const centerX = rect.width / 2;
    const centerY = rect.height / 2;
    const rotateX = ((y - centerY) / centerY) * -8;
    const rotateY = ((x - centerX) / centerX) * 8;
    tiltStyle.value = {
        transform: `perspective(800px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02,1.02,1.02)`,
    };
};

const handleMouseLeave = () => {
    tiltStyle.value = { transform: 'perspective(800px) rotateX(0deg) rotateY(0deg) scale3d(1,1,1)' };
};

const cardRefs = ref<any[]>([null, null, null, null]);
const cardTilts = ref<{ transform: string }[]>(
    Array.from({ length: 4 }, () => ({ transform: 'perspective(800px) rotateX(0deg) rotateY(0deg)' })),
);

const handleCardMove = (i: number) => (e: MouseEvent) => {
    const el = cardRefs.value[i];
    if (!el) return;
    const rect = el.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    const centerX = rect.width / 2;
    const centerY = rect.height / 2;
    const rotateX = ((y - centerY) / centerY) * -6;
    const rotateY = ((x - centerX) / centerX) * 6;
    cardTilts.value[i] = {
        transform: `perspective(800px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02,1.02,1.02)`,
    };
};

const handleCardLeave = (i: number) => () => {
    cardTilts.value[i] = { transform: 'perspective(800px) rotateX(0deg) rotateY(0deg) scale3d(1,1,1)' };
};
</script>

<template>
    <Head title="Welcome" />

    <div class="relative flex min-h-screen flex-col overflow-hidden bg-linear-to-b from-background via-background to-blue-950/5 text-foreground">
        <div class="pointer-events-none fixed inset-0 -z-10">
            <div class="absolute inset-0 bg-[radial-gradient(rgba(255,255,255,0.05)_1px,transparent_1px)] bg-[length:24px_24px] dark:bg-[radial-gradient(rgba(255,255,255,0.03)_1px,transparent_1px)]" />
            <div class="animate-float-slow absolute -top-40 right-0 h-[600px] w-[600px] rounded-full bg-linear-to-br from-primary/20 to-blue-500/20 blur-3xl" />
            <div class="animate-float-slower absolute -bottom-40 left-0 h-[500px] w-[500px] rounded-full bg-linear-to-tr from-blue-500/20 to-purple-500/20 blur-3xl" />
            <div class="animate-float absolute left-1/4 top-1/3 h-[350px] w-[350px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-linear-to-r from-purple-500/20 to-pink-500/20 blur-3xl" />
        </div>

        <header class="sticky top-0 z-10 border-b border-border/40 bg-background/80 backdrop-blur-md">
            <div class="mx-auto flex h-14 max-w-5xl items-center justify-end gap-4 px-6">
                <Link
                    v-if="$page.props.auth.user"
                    :href="dashboard()"
                    class="inline-flex items-center justify-center rounded-lg border border-border bg-background px-4 py-2 text-sm font-medium text-foreground shadow-xs transition-all hover:bg-accent/50 hover:text-accent-foreground"
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="login()"
                        class="inline-flex items-center justify-center rounded-lg px-4 py-2 text-sm font-medium text-muted-foreground transition-colors hover:bg-accent/50 hover:text-accent-foreground"
                    >
                        Log in
                    </Link>
                    <Link
                        :href="register()"
                        class="inline-flex items-center justify-center rounded-lg border border-border bg-background px-4 py-2 text-sm font-medium text-foreground shadow-xs transition-all hover:bg-accent/50 hover:text-accent-foreground"
                    >
                        Register
                    </Link>
                </template>
            </div>
        </header>

        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="animate-ping-slow absolute left-[20%] top-[15%] h-32 w-32 rounded-full border-2 border-primary/20" />
            <div class="animate-ping-slower absolute right-[25%] top-[40%] h-24 w-24 rounded-full border-2 border-blue-500/20" />
            <div class="animate-ping-slowest absolute left-[40%] top-[60%] h-40 w-40 rounded-full border-2 border-purple-500/15" />
            <div class="animate-float absolute left-[10%] top-[70%] h-2 w-2 rounded-full bg-primary/40" />
            <div class="animate-float-slow absolute right-[15%] top-[20%] h-1.5 w-1.5 rounded-full bg-blue-500/40" />
            <div class="animate-float-slower absolute right-[30%] top-[80%] h-1 w-1 rounded-full bg-purple-500/40" />
            <div class="animate-float absolute left-[50%] top-[10%] h-1.5 w-1.5 rounded-full bg-emerald-500/40" />
            <div class="animate-float-slow absolute left-[70%] top-[50%] h-2 w-2 rounded-full bg-amber-500/40" />
            <div class="animate-float-slower absolute left-[30%] top-[30%] h-1 w-1 rounded-full bg-rose-500/40" />
        </div>
    <section class="relative overflow-hidden">
            <div class="mx-auto flex max-w-6xl flex-col items-center gap-10 px-6 py-16 lg:flex-row lg:py-24">
                <div class="flex-1 text-center lg:text-left">
                    <Badge variant="secondary" class="mb-4 border-primary/20 bg-primary/10 px-3 py-1 text-xs tracking-wide text-primary uppercase">
                        Laravel Ecosystem
                    </Badge>
                    <h1 class="bg-linear-to-r from-foreground via-foreground to-primary/70 bg-clip-text text-5xl font-bold tracking-tight text-transparent text-balance lg:text-6xl">
                        Laravel Pulse
                    </h1>
                    <p class="mx-auto mt-4 max-w-xl text-lg leading-relaxed text-muted-foreground lg:mx-0">
                        Full-stack monitoring platform &mdash; built with a modern open-source stack spanning backend, frontend, infrastructure, and developer tooling.
                    </p>
                </div>
                <div ref="svgRef" class="tilt-transition flex-1 cursor-pointer" :style="tiltStyle" @mousemove="handleMouseMove" @mouseleave="handleMouseLeave">
                    <svg viewBox="0 0 500 340" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full max-w-[500px] drop-shadow-2xl">
                        <rect x="0" y="0" width="500" height="340" rx="16" class="fill-card stroke-border/50 drop-shadow-[0_0_15px_rgba(255,255,255,0.05)]" stroke-width="1" />
                        <rect x="20" y="20" width="140" height="24" rx="6" class="fill-primary/10" />
                        <rect x="170" y="20" width="80" height="24" rx="6" class="fill-blue-500/10" />
                        <rect x="400" y="20" width="80" height="24" rx="6" class="fill-blue-500/10" />
                        <circle cx="36" cy="32" r="4" class="fill-green-500" />
                        <rect x="20" y="60" width="220" height="120" rx="8" class="fill-muted/50 stroke-border/50" stroke-width="1" />
                        <path d="M40 140 L70 110 L100 125 L130 90 L160 105 L190 80 L220 95" class="stroke-primary" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none" />
                        <path d="M40 100 L70 90 L100 95 L130 80 L160 85 L190 70 L220 75" class="stroke-emerald-500" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none" opacity="0.6" />
                        <path d="M40 160 L70 150 L100 155 L130 140 L160 145 L190 130 L220 135" class="stroke-amber-500" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none" opacity="0.6" />
                        <rect x="260" y="60" width="220" height="55" rx="8" class="fill-muted/50 stroke-border/30" stroke-width="1" />
                        <rect x="275" y="75" width="90" height="8" rx="4" class="fill-muted-foreground/30" />
                        <rect x="275" y="90" width="60" height="8" rx="4" class="fill-muted-foreground/30" />
                        <rect x="380" y="75" width="85" height="8" rx="4" class="fill-muted-foreground/30" />
                        <rect x="380" y="90" width="45" height="8" rx="4" class="fill-muted-foreground/30" />
                        <rect x="260" y="125" width="220" height="55" rx="8" class="fill-muted/50 stroke-border/30" stroke-width="1" />
                        <rect x="275" y="140" width="70" height="8" rx="4" class="fill-muted-foreground/30" />
                        <rect x="275" y="155" width="100" height="8" rx="4" class="fill-muted-foreground/30" />
                        <rect x="380" y="140" width="85" height="8" rx="4" class="fill-muted-foreground/30" />
                        <rect x="380" y="155" width="60" height="8" rx="4" class="fill-muted-foreground/30" />
                        <rect x="20" y="195" width="220" height="50" rx="8" class="fill-muted/50 stroke-border/30" stroke-width="1" />
                        <rect x="35" y="210" width="140" height="8" rx="4" class="fill-muted-foreground/30" />
                        <rect x="35" y="225" width="100" height="8" rx="4" class="fill-muted-foreground/30" />
                        <rect x="190" y="210" width="35" height="25" rx="6" class="fill-primary/20" />
                        <rect x="20" y="255" width="105" height="65" rx="8" class="fill-muted/50 stroke-border/30" stroke-width="1" />
                        <circle cx="72" cy="280" r="12" class="fill-blue-500/20" />
                        <circle cx="72" cy="280" r="6" class="fill-blue-500" />
                        <rect x="35" y="298" width="75" height="6" rx="3" class="fill-muted-foreground/30" />
                        <rect x="135" y="255" width="105" height="65" rx="8" class="fill-muted/50 stroke-border/30" stroke-width="1" />
                        <circle cx="187" cy="280" r="12" class="fill-amber-500/20" />
                        <circle cx="187" cy="280" r="6" class="fill-amber-500" />
                        <rect x="150" y="298" width="75" height="6" rx="3" class="fill-muted-foreground/30" />
                        <rect x="260" y="195" width="220" height="125" rx="8" class="fill-muted/50 stroke-border/30" stroke-width="1" />
                        <path d="M280 280 Q300 270 320 280 T360 280 T400 275" class="stroke-primary" stroke-width="2" stroke-linecap="round" fill="none" />
                        <path d="M280 290 Q310 280 330 290 T370 290 T400 285" class="stroke-emerald-500" stroke-width="1.5" stroke-linecap="round" fill="none" opacity="0.5" />
                        <path d="M280 300 Q320 295 340 300 T380 300 T400 295" class="stroke-purple-500" stroke-width="1.5" stroke-linecap="round" fill="none" opacity="0.5" />
                    </svg>
                </div>
            </div>
        </section>

        <section class="border-y border-border/40 bg-linear-to-b from-blue-950/10 via-background to-background">
            <div class="mx-auto max-w-5xl px-6 py-16">
                <div class="mb-10 text-center">
                    <Badge variant="secondary" class="mb-3 border-primary/20 bg-primary/10 px-3 py-1 text-xs tracking-wide text-primary uppercase">
                        Key Features
                    </Badge>
                    <h2 class="bg-linear-to-r from-foreground to-primary/60 bg-clip-text text-3xl font-bold tracking-tight text-transparent text-balance">
                        Monitor every layer of your app
                    </h2>
                    <p class="mx-auto mt-2 max-w-xl text-muted-foreground">
                        Laravel Pulse gives you real-time visibility into what matters most.
                    </p>
                </div>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="rounded-xl border border-border/50 bg-card p-5 transition-all duration-200 hover:border-primary/20 hover:shadow-md">
                        <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-500/10">
                            <Activity class="h-5 w-5 text-blue-500" />
                        </div>
                        <h3 class="mb-1 font-semibold">Slow Jobs</h3>
                        <p class="text-sm text-muted-foreground">Track queue jobs exceeding thresholds. Identify bottlenecks before users notice.</p>
                    </div>
                    <div class="rounded-xl border border-border/50 bg-card p-5 transition-all duration-200 hover:border-primary/20 hover:shadow-md">
                        <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-500/10">
                            <Database class="h-5 w-5 text-emerald-500" />
                        </div>
                        <h3 class="mb-1 font-semibold">Slow Queries</h3>
                        <p class="text-sm text-muted-foreground">Detect database queries running too long. Optimize with exact N+1 and missing index data.</p>
                    </div>
                    <div class="rounded-xl border border-border/50 bg-card p-5 transition-all duration-200 hover:border-primary/20 hover:shadow-md">
                        <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-amber-500/10">
                            <Zap class="h-5 w-5 text-amber-500" />
                        </div>
                        <h3 class="mb-1 font-semibold">Slow Requests</h3>
                        <p class="text-sm text-muted-foreground">Monitor HTTP request durations. Pinpoint slow endpoints and API routes instantly.</p>
                    </div>
                    <div class="rounded-xl border border-border/50 bg-card p-5 transition-all duration-200 hover:border-primary/20 hover:shadow-md">
                        <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-red-500/10">
                            <AlertTriangle class="h-5 w-5 text-red-500" />
                        </div>
                        <h3 class="mb-1 font-semibold">Exceptions</h3>
                        <p class="text-sm text-muted-foreground">See every application exception in real time. Stack traces, frequency, and trends.</p>
                    </div>
                    <div class="rounded-xl border border-border/50 bg-card p-5 transition-all duration-200 hover:border-primary/20 hover:shadow-md">
                        <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-purple-500/10">
                            <ExternalLink class="h-5 w-5 text-purple-500" />
                        </div>
                        <h3 class="mb-1 font-semibold">Outgoing Requests</h3>
                        <p class="text-sm text-muted-foreground">Watch external HTTP calls. Measure latency to APIs, webhooks, and third-party services.</p>
                    </div>
                    <div class="rounded-xl border border-border/50 bg-card p-5 transition-all duration-200 hover:border-primary/20 hover:shadow-md">
                        <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-cyan-500/10">
                            <Server class="h-5 w-5 text-cyan-500" />
                        </div>
                        <h3 class="mb-1 font-semibold">Cache & Redis</h3>
                        <p class="text-sm text-muted-foreground">Monitor cache hit/miss rates and Redis memory usage. Keep your app snappy.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-linear-to-b from-background via-blue-950/5 to-background">
            <div class="mx-auto w-full max-w-5xl px-6 py-16">
                <div class="mb-10 text-center">
                    <Badge variant="secondary" class="mb-3 border-primary/20 bg-primary/10 px-3 py-1 text-xs tracking-wide text-primary uppercase">
                        Technology Stack
                    </Badge>
                    <h2 class="bg-linear-to-r from-foreground to-primary/60 bg-clip-text text-3xl font-bold tracking-tight text-transparent text-balance">
                        Built with modern tools
                    </h2>
                    <p class="mx-auto mt-2 max-w-xl text-muted-foreground">
                        Every component of this platform is powered by industry-leading open-source technologies.
                    </p>
                </div>
                <div class="grid gap-6 md:grid-cols-2">
                <Card :ref="(el) => { cardRefs[0] = el }" :style="cardTilts[0]" @mousemove="handleCardMove(0)" @mouseleave="handleCardLeave(0)" class="tilt-transition group border-border/50 transition-all duration-300 hover:border-primary/30 hover:shadow-xl hover:shadow-primary/5">
                    <CardHeader>
                        <CardTitle class="flex items-center gap-2">
                            <Server class="h-5 w-5 text-primary" />
                            Backend Stack
                        </CardTitle>
                        <CardDescription class="text-muted-foreground">PHP & Laravel ecosystem powering the server</CardDescription>
                    </CardHeader>
                    <CardContent class="grid gap-3 text-sm">
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <Sparkles class="mt-0.5 h-4 w-4 shrink-0 text-blue-500" />
                            <div><span class="font-medium">Laravel 13</span> &mdash; Full-stack PHP framework. MVC architecture, Eloquent ORM, Artisan CLI, queue system, events, validation, policies.</div>
                        </div>
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <Activity class="mt-0.5 h-4 w-4 shrink-0 text-green-500" />
                            <div><span class="font-medium">Pulse</span> &mdash; Real-time app performance. Tracks slow jobs, queries, requests, outgoing HTTP, exceptions, cache, and more.</div>
                        </div>
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <Radar class="mt-0.5 h-4 w-4 shrink-0 text-purple-500" />
                            <div><span class="font-medium">Horizon</span> &mdash; Queue worker dashboard. Redis-backed. Displays job throughput, failures, queue lengths, worker health.</div>
                        </div>
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <BookOpen class="mt-0.5 h-4 w-4 shrink-0 text-amber-500" />
                            <div><span class="font-medium">Telescope</span> &mdash; Debugging assistant. Captures requests, queries, exceptions, logs, dumps, mail, notifications, jobs.</div>
                        </div>
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <Shield class="mt-0.5 h-4 w-4 shrink-0 text-red-500" />
                            <div><span class="font-medium">Fortify</span> &mdash; Authentication backend. Login, registration, 2FA, password confirmation, rate limiting.</div>
                        </div>
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <FlaskConical class="mt-0.5 h-4 w-4 shrink-0 text-orange-500" />
                            <div><span class="font-medium">Pest</span> &mdash; Testing framework. Fluent, expressive test syntax built on PHPUnit.</div>
                        </div>
                    </CardContent>
                </Card>

                <Card :ref="(el) => { cardRefs[1] = el }" :style="cardTilts[1]" @mousemove="handleCardMove(1)" @mouseleave="handleCardLeave(1)" class="tilt-transition group border-border/50 transition-all duration-300 hover:border-primary/20 hover:shadow-lg">
                    <CardHeader>
                        <CardTitle class="flex items-center gap-2">
                            <Cpu class="h-5 w-5 text-primary" />
                            Frontend Stack
                        </CardTitle>
                        <CardDescription class="text-muted-foreground">Vue 3, Inertia, Tailwind & tooling</CardDescription>
                    </CardHeader>
                    <CardContent class="grid gap-3 text-sm">
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <Zap class="mt-0.5 h-4 w-4 shrink-0 text-emerald-500" />
                            <div><span class="font-medium">Vue 3</span> &mdash; Progressive reactive framework. Composition API, <code>&lt;script setup&gt;</code>, SFC, refs, computed.</div>
                        </div>
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <HeartHandshake class="mt-0.5 h-4 w-4 shrink-0 text-sky-500" />
                            <div><span class="font-medium">Inertia.js v3</span> &mdash; Monolith SPA bridge. Server-side routing, no API. Props from controllers become component props.</div>
                        </div>
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <Badge variant="outline" class="mt-0.5 h-5 w-5 rounded p-0 text-[10px]">TS</Badge>
                            <div><span class="font-medium">TypeScript</span> &mdash; Static type checking. Strict mode, ESNext target, path aliases (<code>@/</code>).</div>
                        </div>
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <Badge variant="outline" class="mt-0.5 h-5 w-5 rounded p-0 text-[10px]">V</Badge>
                            <div><span class="font-medium">Vite 8</span> &mdash; Build tool & dev server. Fast HMR, ESBuild transpile, Tailwind CSS v4 plugin, SSR mode.</div>
                        </div>
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <Badge variant="outline" class="mt-0.5 h-5 w-5 rounded p-0 text-[10px]">TW</Badge>
                            <div><span class="font-medium">Tailwind CSS v4</span> &mdash; Utility-first CSS. JIT compilation, CSS-first config via <code>@import "tailwindcss"</code>.</div>
                        </div>
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <Badge variant="outline" class="mt-0.5 h-5 w-5 rounded p-0 text-[10px] font-bold">S</Badge>
                            <div><span class="font-medium">shadcn-vue</span> &mdash; Unstyled accessible components. Built on Reka UI + CVA + Tailwind. Copy-paste component model.</div>
                        </div>
                    </CardContent>
                </Card>

                <Card :ref="(el) => { cardRefs[2] = el }" :style="cardTilts[2]" @mousemove="handleCardMove(2)" @mouseleave="handleCardLeave(2)" class="tilt-transition group border-border/50 transition-all duration-300 hover:border-primary/20 hover:shadow-lg">
                    <CardHeader>
                        <CardTitle class="flex items-center gap-2">
                            <Database class="h-5 w-5 text-primary" />
                            Infrastructure
                        </CardTitle>
                        <CardDescription class="text-muted-foreground">Services & deployment</CardDescription>
                    </CardHeader>
                    <CardContent class="grid gap-3 text-sm">
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <Database class="mt-0.5 h-4 w-4 shrink-0 text-blue-400" />
                            <div><span class="font-medium">PostgreSQL 16</span> &mdash; Primary relational database. Dedicated Pulse instance on separate port 5433.</div>
                        </div>
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <Badge variant="outline" class="mt-0.5 h-5 w-5 rounded p-0 text-[10px]">R</Badge>
                            <div><span class="font-medium">Redis</span> &mdash; Cache & queue backend. Powers Horizon, sessions, rate limiting, cache store.</div>
                        </div>
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <Server class="mt-0.5 h-4 w-4 shrink-0 text-indigo-500" />
                            <div><span class="font-medium">Traefik</span> &mdash; Reverse proxy & load balancer. Auto service discovery via Docker. Dashboard at :8080. Prometheus metrics, OTLP tracing.</div>
                        </div>
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <Badge variant="outline" class="mt-0.5 h-5 w-5 rounded p-0 text-[10px]">D</Badge>
                            <div><span class="font-medium">Docker</span> &mdash; Container orchestration. App replicas (2), nginx webserver, worker with supervisor, Vite container.</div>
                        </div>
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <Badge variant="outline" class="mt-0.5 h-5 w-5 rounded p-0 text-[10px]">N</Badge>
                            <div><span class="font-medium">Nginx</span> &mdash; Production webserver. Load-balanced across app replicas, static asset serving.</div>
                        </div>
                    </CardContent>
                </Card>

                <Card :ref="(el) => { cardRefs[3] = el }" :style="cardTilts[3]" @mousemove="handleCardMove(3)" @mouseleave="handleCardLeave(3)" class="tilt-transition group border-border/50 transition-all duration-300 hover:border-primary/20 hover:shadow-lg">
                    <CardHeader>
                        <CardTitle class="flex items-center gap-2">
                            <span class="text-lg leading-none text-primary">&#9881;</span>
                            Developer Tooling
                        </CardTitle>
                        <CardDescription class="text-muted-foreground">Code quality, DX, utilities</CardDescription>
                    </CardHeader>
                    <CardContent class="grid gap-3 text-sm">
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <Badge variant="outline" class="mt-0.5 h-5 w-5 rounded p-0 text-[10px]">ES</Badge>
                            <div><span class="font-medium">ESLint</span> &mdash; JS/TS/Vue linting. Flat config, stylistic plugin, import order rules.</div>
                        </div>
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <Badge variant="outline" class="mt-0.5 h-5 w-5 rounded p-0 text-[10px]">P</Badge>
                            <div><span class="font-medium">Prettier</span> &mdash; Code formatter. Tailwind class sorting plugin, consistent style.</div>
                        </div>
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <Badge variant="outline" class="mt-0.5 h-5 w-5 rounded p-0 text-[10px]">V</Badge>
                            <div><span class="font-medium">vue-tsc</span> &mdash; Type-check Vue SFCs. Runs type checking on <code>.vue</code> files in CI.</div>
                        </div>
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <Badge variant="outline" class="mt-0.5 h-5 w-5 rounded p-0 text-[10px]">L</Badge>
                            <div><span class="font-medium">Laravel Pint</span> &mdash; PHP code style fixer. Preset-based (Laravel), runs in CI pipeline.</div>
                        </div>
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <Badge variant="outline" class="mt-0.5 h-5 w-5 rounded p-0 text-[10px]">$</Badge>
                            <div><span class="font-medium">Laravel Pail</span> &mdash; Real-time log viewer. Tail logs directly in terminal.</div>
                        </div>
                        <div class="flex items-start gap-3 rounded-lg p-2 transition-colors hover:bg-accent/50">
                            <Badge variant="outline" class="mt-0.5 h-5 w-5 rounded p-0 text-[10px]">W</Badge>
                            <div><span class="font-medium">Wayfinder</span> &mdash; Type-safe route generation. Generates TypeScript route helpers from Laravel routes (<code>dashboard()</code>, <code>pulse()</code>).</div>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
    </section>

    <footer class="border-t border-border/40 bg-linear-to-b from-background to-blue-950/5">
            <div class="mx-auto flex h-16 max-w-5xl items-center justify-between px-6 text-sm text-muted-foreground">
                <p>Built with <span class="text-primary drop-shadow-[0_0_6px_rgba(255,255,255,0.3)]">&hearts;</span> using the Laravel ecosystem</p>
                <p>&copy; {{ new Date().getFullYear() }} Laravel Pulse. All rights reserved.</p>
            </div>
        </footer>
</div>
</template>

<style scoped>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}
@keyframes float-slow {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
}
@keyframes float-slower {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}
@keyframes ping-slow {
    0%, 100% { transform: scale(1); opacity: 0.4; }
    50% { transform: scale(1.5); opacity: 0; }
}
@keyframes ping-slower {
    0%, 100% { transform: scale(1); opacity: 0.3; }
    50% { transform: scale(1.3); opacity: 0; }
}
@keyframes ping-slowest {
    0%, 100% { transform: scale(1); opacity: 0.25; }
    50% { transform: scale(1.6); opacity: 0; }
}
.animate-float { animation: float 6s ease-in-out infinite; }
.animate-float-slow { animation: float-slow 8s ease-in-out infinite; }
.animate-float-slower { animation: float-slower 10s ease-in-out infinite; }
.animate-ping-slow { animation: ping-slow 4s ease-in-out infinite; }
.animate-ping-slower { animation: ping-slower 5s ease-in-out infinite; }
.animate-ping-slowest { animation: ping-slowest 6s ease-in-out infinite; }
.tilt-transition { transition: transform 0.15s ease-out; }
</style>
