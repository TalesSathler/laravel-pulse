<script setup lang="ts">
import { Head, router, usePage } from '@inertiajs/vue3';
import { Activity, AlertTriangle, BookOpen, Clock, Database, ExternalLink, Radar, Send, Server, Zap, LoaderCircle } from '@lucide/vue';
import { computed, ref } from 'vue';
import { toast } from 'vue-sonner';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription } from '@/components/ui/card';
import { toUrl } from '@/lib/utils';
import { dashboard, pulse } from '@/routes';
import { index as horizon } from '@/routes/horizon';
import type { PageProps } from '@/types';

const page = usePage<PageProps>();
const isLocal = computed(() => page.props.appEnv === 'local');

const items = computed(() => [
    { title: 'Pulse', description: 'Application performance and health monitoring', href: pulse(), icon: Activity },
    { title: 'Horizon', description: 'Queue worker monitoring and management', href: horizon(), icon: Radar },
    ...(isLocal.value
        ? [{ title: 'Telescope', description: 'Request debugging and insights', href: '/telescope', icon: BookOpen }]
        : []),
    { title: 'Traefik', description: 'Reverse proxy dashboard and routing', href: 'http://localhost:8080/', icon: Server },
]);

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    },
});

const loading = ref<string | null>(null);

const dispatch = (type: string, label: string) => {
    loading.value = type;
    router.post('/simulate', { type }, {
        onSuccess: () => {
            toast.success(`${label} dispatched successfully!`, { position: 'top-center' });
        },
        onError: () => {
            toast.error(`Failed to dispatch ${label}`, { position: 'top-center' });
        },
        onFinish: () => {
            loading.value = null;
        },
    });
};

const dispatchDemoJob = () => {
    loading.value = 'demo';
    router.post('/dispatch-demo-job', {}, {
        onSuccess: () => {
            toast.success('Demo job dispatched successfully!', { position: 'top-center' });
        },
        onError: () => {
            toast.error('Failed to dispatch demo job', { position: 'top-center' });
        },
        onFinish: () => {
            loading.value = null;
        },
    });
};
</script>

<template>
    <Head title="Dashboard" />

    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
                <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <a
                v-for="item in items"
                :key="item.title"
                :href="toUrl(item.href)"
                target="_blank"
                rel="noopener noreferrer"
                class="block"
            >
                <Card
                    class="cursor-pointer transition-colors hover:bg-accent/50"
                >
                    <CardContent
                        class="flex flex-col items-center justify-center gap-4 py-8"
                    >
                        <component
                            :is="item.icon"
                            class="h-12 w-12 text-muted-foreground"
                        />
                        <div class="text-center">
                            <p class="text-lg font-semibold">{{ item.title }}</p>
                            <CardDescription class="mt-1">
                                {{ item.description }}
                            </CardDescription>
                        </div>
                    </CardContent>
                </Card>
            </a>
        </div>
        <div class="flex flex-col gap-4">
            <div class="rounded-xl border border-sidebar-border/70 p-8 dark:border-sidebar-border">
                <div class="mb-4 text-center">
                    <p class="text-sm font-medium text-muted-foreground">Simulate Pulse Events</p>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-4">
                    <Button @click="dispatchDemoJob" :disabled="loading === 'demo'" class="gap-2">
                        <component :is="loading === 'demo' ? LoaderCircle : Send" class="h-4 w-4" :class="{ 'animate-spin': loading === 'demo' }" />
                        {{ loading === 'demo' ? 'Dispatching...' : 'Demo Job' }}
                    </Button>
                    <Button @click="dispatch('slow-job', 'Slow Job')" :disabled="loading === 'slow-job'" variant="secondary" class="gap-2">
                        <component :is="loading === 'slow-job' ? LoaderCircle : Clock" class="h-4 w-4" :class="{ 'animate-spin': loading === 'slow-job' }" />
                        {{ loading === 'slow-job' ? 'Dispatching...' : 'Slow Job' }}
                    </Button>
                    <Button @click="dispatch('exception', 'Exception')" :disabled="loading === 'exception'" variant="secondary" class="gap-2">
                        <component :is="loading === 'exception' ? LoaderCircle : AlertTriangle" class="h-4 w-4" :class="{ 'animate-spin': loading === 'exception' }" />
                        {{ loading === 'exception' ? 'Dispatching...' : 'Exception' }}
                    </Button>
                    <Button @click="dispatch('slow-query', 'Slow Query')" :disabled="loading === 'slow-query'" variant="secondary" class="gap-2">
                        <component :is="loading === 'slow-query' ? LoaderCircle : Database" class="h-4 w-4" :class="{ 'animate-spin': loading === 'slow-query' }" />
                        {{ loading === 'slow-query' ? 'Running...' : 'Slow Query' }}
                    </Button>
                    <Button @click="dispatch('slow-outgoing', 'Slow Outgoing')" :disabled="loading === 'slow-outgoing'" variant="secondary" class="gap-2">
                        <component :is="loading === 'slow-outgoing' ? LoaderCircle : ExternalLink" class="h-4 w-4" :class="{ 'animate-spin': loading === 'slow-outgoing' }" />
                        {{ loading === 'slow-outgoing' ? 'Running...' : 'Slow Outgoing' }}
                    </Button>
                    <Button @click="dispatch('slow-request', 'Slow Request')" :disabled="loading === 'slow-request'" variant="secondary" class="gap-2">
                        <component :is="loading === 'slow-request' ? LoaderCircle : Zap" class="h-4 w-4" :class="{ 'animate-spin': loading === 'slow-request' }" />
                        {{ loading === 'slow-request' ? 'Running...' : 'Slow Request' }}
                    </Button>
                </div>
            </div>
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border"
            >
                <div class="flex h-full items-center justify-center p-8 text-center">
                    <p class="text-muted-foreground text-sm">
                        Welcome to your application dashboard. Select a tool above
                        to get started.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
