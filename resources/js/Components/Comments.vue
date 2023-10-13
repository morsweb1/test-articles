<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    comments: {
        type: Array,
        default: []
    },
    article: {
        type: Object,
        required: true
    },
})

const form = useForm({
    title: '',
    text: '',
})

const submit = () => {
    form.post(route('comment.store', {article: props.article.slug}), {
        preserveScroll: false,
        preserveState: false,
        onSuccess: () => {
            form.title = '',
            form.text = ''
        },
    })
}

</script>

<template>
    <section class="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased">
        <div class="max-w-2xl px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Комментарии ({{ comments.length }})</h2>
            </div>
            <form @submit.prevent="submit" class="mb-6">
                <div class="py-2 mb-4 bg-white rounded-lg rounded-t-lg flex flex-col">
                    <label class="sr-only">Добавить комментарий</label>
                    <TextInput
                        id="title"
                        type="text"
                        class="px-4 mb-4 w-full text-sm text-gray-900 border border-gray-200 focus:ring-0 focus:outline-none"
                        v-model="form.title"
                        placeholder="Тема комментария"
                    />
                    <InputError v-if="form.errors.title" :message="form.errors.title" />
                    <textarea id="text" rows="6"
                              v-model="form.text"
                              class="px-4 w-full text-sm text-gray-900 border border-gray-200 focus:ring-0 focus:outline-none"
                              placeholder="Написать текст комментария"></textarea>
                    <InputError v-if="form.errors.text" :message="form.errors.text" />
                </div>
                <PrimaryButton
                      :disabled="form.processing"
                      class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-500 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800 disabled:opacity-25 disabled:bg-gray-500">
                    Сохранить
                </PrimaryButton>
            </form>
            <article v-for="comment in comments" :key="comment.id" class="p-6 text-base bg-gray-100 mb-4 rounded-lg dark:bg-gray-900">
                <div class="flex items-center">
                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                        {{ comment.title }}
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <time pubdate datetime="2022-02-08">{{ new Date(comment.created_at).toLocaleDateString() }}</time>
                    </p>
                </div>
                <p class="text-gray-500 dark:text-gray-400">{{ comment.text }}</p>
            </article>

        </div>
    </section>
</template>
