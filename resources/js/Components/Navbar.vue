<script setup>
import {Link} from "@inertiajs/vue3";

</script>

<template>
    <div class="text-right w-full">
        <Link
            href="/"
            class="font-semibold text-gray-600 mr-8 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
        >
            Главная
        </Link>
        <Link
            v-if="$page.props.auth.user"
            :href="route('admin.articles.index')"
            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
        >
            Админ панель
        </Link>

        <template v-else>
            <Link
                :href="route('login')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
            >
                Вход
            </Link>
        </template>
    </div>
</template>
