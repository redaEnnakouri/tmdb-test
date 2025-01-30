<script setup>
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/components/ActionMessage.vue';
import FormSection from '@/components/FormSection.vue';
import InputError from '@/components/InputError.vue';
import InputLabel from '@/components/InputLabel.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import TextInput from '@/components/TextInput.vue';
import { routes } from '@/routes';

const props = defineProps({
    film: Object,
});

const form = useForm({
    _method: 'PUT',
    title: props.film.title || props.film.original_title,
    overview: props.film.overview || '',
});

const handleSubmit = () => {
    form.post(route(routes.films.update, props.film.id), {
        errorBag: 'handleSubmit',
        preserveScroll: true,
    });
};
</script>

<template>
    <FormSection @submitted="handleSubmit">
        <template #title> Update Profile Information </template>

        <template #description> Modifier titre et description de film . </template>

        <template #form>
            <!-- film Name -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="Titre" value="Titre" />
                <TextInput
                    id="title"
                    v-model="form.title"
                    type="text"
                    class="mt-1 block w-full text-white bg-white/10 py-3 px-5"
                    required
                    autocomplete="title"
                />
                <InputError :message="form.errors.title" class="mt-2" />
            </div>

            <!-- overview -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="Description" value="Description" />
                <TextInput
                    id="overview"
                    v-model="form.overview"
                    :multiline="5"
                    class="mt-1 block w-full text-white bg-white/10 py-3 px-5"
                    required
                    autocomplete="overview"
                />
                <InputError :message="form.errors.overview" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="me-3 "> Votre donner a ete enregistrer . </ActionMessage>
            <PrimaryButton :processing="form.processing" :disabled="form.processing"> Enregistrer </PrimaryButton>
        </template>
    </FormSection>
</template>
