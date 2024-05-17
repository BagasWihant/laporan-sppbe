<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import PanelMenu from 'primevue/panelmenu';

const activeUrl = (alamat, url1,item) => {
    return alamat.includes(url1) ? 'bg-blue-300 dark:bg-blue-800' : '';
}

const items = ref([
    {
        label: 'Dasboard',
        icon: 'pi pi-home',
        url: route('/')
    },
    {
        label: 'Master',
        icon: 'pi pi-palette',
        active:false,
        items: [
            {
                label: 'Barang',
                icon: 'pi pi-eraser',
                url: route('barang.index')
            },
            {
                label: 'Perusahaan',
                icon: 'pi pi-heart',
                url: route('dashboard')
            }
        ]
    },
    {
        label: 'Laporan',
        icon: 'pi pi-palette',
        active:false,
        items: [
            {
                label: 'Rab',
                icon: 'pi pi-eraser',
                url: route('barang.index')
            },
            {
                label: 'Purchase Order',
                icon: 'pi pi-heart',
                url: route('barang.index')
            },
            {
                label: 'Invois',
                icon: 'pi pi-heart',
                url: route('barang.index')
            }
        ]
    },
]);
</script>


<template>
    <ul class="list-none p-0 m-0 overflow-hidden">
        <PanelMenu :model="items"  >
            <template #item="{ item }" >
                <Link v-if="item.url" :href="item.url" v-ripple :class="activeUrl(item.url, $page.url)"
                class="flex items-center cursor-pointer p-3 text-surface-700 dark:text-surface-0/80 hover:bg-surface-100 dark:hover:bg-surface-700 duration-200 transition-colors ">
                {{ item.label }}
                </Link>
                <a v-else v-ripple class="flex items-center cursor-pointer text-surface-700 dark:text-surface-0/80 px-3 py-2" :class=" item.items.map((i) => activeUrl(i.url, $page.url)) ">
                    <span :class="item.icon" />
                    <span class="ml-2">{{ item.label }}</span>
                    <span v-if="item.items" class="pi pi-angle-down text-primary ml-auto" />
                </a>
            </template>
        </PanelMenu>
    </ul>
</template>
