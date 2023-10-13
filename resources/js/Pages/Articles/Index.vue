<script setup>
import {Head, Link} from '@inertiajs/vue3';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Pagination from "@/Components/Pagination.vue";

defineProps({
    articles: {
        type: Object,
        default: {}
    }
})

</script>
<template>

    <GuestLayout>

        <Head title="Статьи"/>

        <div class="p-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5 lg:gap-8">
            <Link
                :href="route('articles.show', {article: article.slug})"
                class="rounded overflow-hidden shadow-lg"
                v-for="article in articles.data"
                :key="article.id"
            >
                <img class="w-full" :src="article.image" :alt="article.title">
                <div class="px-6 py-4">
                    <h3 class="font-bold text-xl mb-2">{{ article.title }}</h3>
                    <h3 class="font-bold text-sm mb-2">{{ new Date(article.created_at).toLocaleDateString() }}</h3>
                    <p class="text-gray-700 text-base card__text">
                        {{ article.description }}
                    </p>
                </div>
            </Link>
        </div>

        <Pagination :links="articles.meta.links" />

    </GuestLayout>

</template>


<style lang="scss" scoped>
    .card {
    &__text {
    white-space: nowrap;
    overflow: hidden;
    max-width: 50ch;
    text-overflow: ellipsis;
}
}
</style>
