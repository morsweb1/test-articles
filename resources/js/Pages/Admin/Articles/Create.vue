<template>
    <AuthenticatedLayout>
        <form @submit.prevent="submit" class="max-w-3xl mt-16 mx-auto bg-white rounded-md p-8">
            <div class="w-full mb-4">
                <InputLabel for="title" value="Заголовок" />
                <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                />
                <InputError :message="form.errors.title" />
            </div>
            <div class="w-full mb-4">
                <InputLabel for="description" value="Описание" />
                <textarea
                    id="description"
                    type="text"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    v-model="form.description"
                ></textarea>
                <InputError :message="form.errors.description" />
            </div>

            <div class="mb-4">
                <InputLabel for="file" value="Добавить картинку"/>
                <div class="relative border-2 rounded-md px-4 py-3 bg-white flex items-center justify-between hover:border-blue-500 transition duration-150 ease-in-out">
                    <input
                        type="file"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                        ref="image"
                        @change="previewImage"
                    >
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="ml-2 text-sm text-gray-600">{{ labelFile || 'Выберите файл' }}</span>
                    </div>
                </div>
                <InputError class="mt-2" :message="form.errors.file"/>
            </div>

            <div class="block mb-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.is_published" />
                    <span class="ml-2 text-sm text-gray-600">Опубликовать</span>
                </label>
            </div>

            <PrimaryButton
                :disabled="form.processing"
                :class="{'bg-gray-400': form.processing}"
            >
                Сохранить
            </PrimaryButton>

        </form>
    </AuthenticatedLayout>
</template>

<script setup>
import {ref} from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import Checkbox from "@/Components/Checkbox.vue";
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    title: '',
    description: '',
    is_published: true,
    image: null
})

const labelFile = ref('')

const previewImage = (e) => {
    form.image = e.target.files[0]
    labelFile.value = e.target.files[0].name
}

const submit = () => {
    form.post(route('admin.articles.store'))
}

</script>

<style scoped>

</style>
