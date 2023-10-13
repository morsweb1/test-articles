<script setup>
import {Head} from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Comments from "@/Components/Comments.vue";

const props = defineProps({
    article: {
        type: Object,
        required: true
    }
})

const article = props.article.data

</script>

<template>

    <GuestLayout>
        <Head :title="article.title"/>

        <div class="container mx-auto mt-8 lg:mt-10">
            <section>
                <img class="w-full max-w-7xl" :src="article.image" :alt="article.title">
                <div class="px-6 py-4">
                    <h3 class="font-bold text-xl mb-2">{{ article.title }}</h3>
                    <h3 class="font-bold text-sm mb-2">{{ new Date(article.created_at).toLocaleDateString() }}</h3>
                    <p class="text-gray-700 text-base">
                        {{ article.description }}
                    </p>
                </div>
            </section>

            <Comments :comments="article.comments" :article="article" />
        </div>
    </GuestLayout>
</template>


