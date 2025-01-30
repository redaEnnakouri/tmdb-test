<template>
    <div class="bg-black">
        <DetailsFilmSection :film="film" @delete:film="state.deleteModal = true" />
        <Modal :show="state.deleteModal" @close="state.deleteModal = false">
            <div class="flex justify-center items-center flex-col py-15">
                <ExclamationTriangleIcon class="h-12 w-12 text-red-500" />
                <h2 class="text-black text-2xl font-semibold mt-4">Etes-vous sûr de vouloir supprimer ce film ?</h2>
            </div>
            <div class="flex justify-end gap-5 px-3 py-2 bg-gray-100">
                <SecondaryButton @click="state.deleteModal = false">Annuler</SecondaryButton>
                <PrimaryButton :processing="state.processing" @click="handleDeleteFilm"> Oui, Supprimer </PrimaryButton>
            </div>
        </Modal>
    </div>
</template>

<script setup>
import { reactive } from 'vue';
import { DetailsFilmSection } from './partials';
import Modal from '@/components/Modal.vue';
import { ExclamationTriangleIcon } from '@heroicons/vue/24/outline';
import { router } from '@inertiajs/vue3';
import { routes } from '@/routes';
import PrimaryButton from '@/components/PrimaryButton.vue';
import SecondaryButton from '@/components/SecondaryButton.vue';

const props = defineProps({
    film: Object,
});

const state = reactive({
    deleteModal: false,
    processing: false,
});

const handleDeleteFilm = () => {
    state.processing = true;
    router.delete(route(routes.films.destroy, props.film.id), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            state.processing = false;
            state.deleteModal = false;
        },
    });
};
</script>
