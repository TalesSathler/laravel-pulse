<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Activity, BookOpen, FolderGit2, Home, LayoutGrid, Radar, Server } from '@lucide/vue';
import AppLogo from '@/components/AppLogo.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard, home, pulse, telescope } from '@/routes';
import { index as horizon } from '@/routes/horizon';
import type { NavItem } from '@/types';

const mainNavItems: NavItem[] = [
    {
        title: 'Welcome',
        href: home(),
        icon: Home,
    },
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Pulse',
        href: pulse(),
        icon: Activity,
        target: '_blank',
    },
    {
        title: 'Horizon',
        href: horizon(),
        icon: Radar,
        target: '_blank',
    },
    {
        title: 'Telescope',
        href: telescope(),
        icon: BookOpen,
        target: '_blank',
    },
    {
        title: 'Traefik',
        href: 'http://localhost:8080/',
        icon: Server,
        target: '_blank',
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Repository',
        href: 'https://github.com/laravel/vue-starter-kit',
        icon: FolderGit2,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: BookOpen,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
