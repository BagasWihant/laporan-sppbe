<template>
    <ul class="bg-slate-300 rounded-2xl w-full">
        <template v-for="(childitem, index) in items" :key="index">
            <li>
                <Link :href="childitem.route" @click="handleItemClick(index)"
                    class="relative p-3 flex items-center gap-2.5 rounded-2xl"
                    :class="{ 'bg-slate-600 text-white': childitem.rt === currentPage }">
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

const props = defineProps(['items', 'page', 'currentPage'])
const items = ref(props.items)

const handleItemClick = (index) => {
    const pageName =
        sidebarStore.selected === props.items[index].rt ? '' : props.items[index].rt
    sidebarStore.selected = pageName
    sidebarStore.page = ''

}
</script>
