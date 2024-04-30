<template>
    <ul class="">
        <template v-for="(childitem, index) in items" :key="index">
            <li>
                <Link :href="childitem.route" @click="handleItemClick(index)"
                    class="relative flex items-center gap-2.5 rounded-sm"
                    :class="{ '!text-white': childitem.label === sidebarStore.selected }">
                {{ childitem.label }}
                </Link>
            </li>
        </template>
    </ul>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { useSidebarStore } from '@/stores/sidebar';
import { ref } from 'vue';

const sidebarStore = useSidebarStore()

const props = defineProps(['items', 'page'])
const items = ref(props.items)

const handleItemClick = () => {
    const pageName =
        sidebarStore.selected === props.items[index].label ? '' : props.items[index].label
    sidebarStore.selected = pageName
}
</script>
