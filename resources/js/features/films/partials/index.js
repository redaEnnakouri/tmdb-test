import { defineAsyncComponent } from 'vue';

export const TrendingHeroSection = defineAsyncComponent(() => import('./TrendingHeroSection.vue'));
export const FilmsSection = defineAsyncComponent(() => import('./FilmsSection.vue'));

