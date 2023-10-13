<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    links: {
        type: Array,
    }
})

</script>

<template>
    <div class="py-2">
        <nav v-if="links.length > 3" class="block">
            <ul class="flex items-center justify-center pl-0 rounded list-none">
                <li
                    v-for="(link, key) in links"
                    :key="key"
                >
                    <Link
                        :href="link.url || '#'"
                        :class="{
                            'text-white bg-blue-500 border-blue-500': link.active,
                            'bg-white text-blue-500 border-blue-500': !link.active,
                            'bg-gray-200 text-gray-700 border-gray-700': link.url === null
                        }"
                        :disabled="link.url === null"
                        class="first:ml-0 text-xs font-semibold flex w-8 h-8 mx-1 p-0 rounded-full items-center justify-center leading-tight relative border border-solid"
                        v-html="link.label.replace('pagination.previous', '&laquo;').replace('pagination.next', '&raquo;')"
                    />
                </li>
            </ul>
        </nav>
    </div>
</template>
