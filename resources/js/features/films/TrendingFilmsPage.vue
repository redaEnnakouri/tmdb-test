<template>
    <div class="bg-black">
        <TrendingHeroSection :films="filmsQuery" />
        <FilmsSection :films="filmsQuery" />
    </div>
</template>

<script setup>
import { TrendingHeroSection, FilmsSection } from './partials';
import { routes } from '@/routes';
import { useQuery } from '@/hooks';
import { useScroll } from '@/hooks/useScroll';
import { watch } from 'vue';

const { isAtBottom } = useScroll();
const filmsQuery = useQuery(
    {
        url: route(routes.api.films.index),
        params: {
            search: '',
        },
    },
    true,
);

watch(isAtBottom, filmsQuery.fetchNext);
</script>
