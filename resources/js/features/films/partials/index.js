import { defineAsyncComponent } from 'vue';

export const DetailsFilmSection = defineAsyncComponent(() => import('./DetailsFilmSection.vue'));
export const UpdateFilmForm = defineAsyncComponent(() => import('./UpdateFilmForm.vue'));
export const TrendingHeroSection = defineAsyncComponent(() => import('./TrendingHeroSection.vue'));
export const FilmsSection = defineAsyncComponent(() => import('./FilmsSection.vue'));

