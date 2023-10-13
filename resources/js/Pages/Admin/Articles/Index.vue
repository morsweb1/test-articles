<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    articles: {
        type: Object,
        default: {}
    }
})

const imageSrc = (imagePath) => {

    if (!imagePath) return ''

    const imageParts = imagePath.split('/')

    if (imageParts.length > 2)
        return imagePath

    return window.location.origin + `/${imagePath}`
}

</script>

<template>
    <Head title="Статьи" />

    <AuthenticatedLayout>

        <div class="container mx-auto">
            <Link
                :href="route('admin.articles.create')"
                class="my-10 inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-500 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800 disabled:opacity-25 disabled:bg-gray-500"
            >
                Добавить статью
            </Link>

            <table class="min-w-full border-collapse block md:table">
                <thead class="block md:table-header-group">
                    <tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                        <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Заголовок</th>
                        <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Описание</th>
                        <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Опубликована</th>
                        <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Картинка</th>
                        <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Кол-во комментариев</th>
                        <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Действия</th>
                    </tr>
                </thead>
                <tbody class="block md:table-row-group">
                    <tr
                        v-for="article in articles.data"
                        :key="article.id"
                        class="bg-gray-300 border border-grey-500 md:border-none block md:table-row"
                    >
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Заголовок</span>
                            {{ article.title }}
                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Описание</span>
                            {{ article.description }}
                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Опубликована</span>
                            {{ article.is_published ? 'Да' : 'Нет' }}
                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Картинка</span>
                            <img :src="imageSrc(article.image)" :alt="article.title">
                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Кол-во комментариев</span>
                            {{ article.comments.length }}
                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Действия</span>
                            <Link
                                :href="route('admin.articles.edit', {article: article.slug})"
                                class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mb-3 border border-blue-500 rounded"
                            >
                                Edit
                            </Link>
                            <Link
                                as="button"
                                method="delete"
                                :data="article"
                                :href="route('admin.articles.destroy', {article: article.slug})"
                                class="block bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 border border-red-500 rounded">
                                Delete
                            </Link>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>

