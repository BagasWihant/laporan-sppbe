<template>
    <li>
        <template v-if="item.child">
            <div class="relative flex items-center gap-2.5 rounded-sm py-2 px-3"
                @click.prevent="handleItemClick" :class="{
                    'bg dark:bg-meta-4': sidebarStore.page === item.label
                }">
            <span v-html="item.icon"></span>

            {{ item.label  }}
            <svg v-if="item.child" class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                :class="{ 'rotate-180': sidebarStore.page === item.label }" width="20" height="20" viewBox="0 0 20 20"
                fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                    fill="" />
            </svg>
        </div>
        </template>
        <template v-else>
            <Link :href="item.route"class="relative flex items-center gap-2.5 rounded-sm py-2 px-3"
                @click.prevent="handleItemClick" :class="{
                    'bg-graydark dark:bg-meta-4': sidebarStore.page === item.label
                }">
            <span v-html="item.icon"></span>

            {{ item.label }}
            </Link>
        </template>

        <div class="" v-show="sidebarStore.page === item.label">
            <SidebarMenuDropdown v-if="item.child" :items="item.child" :page="item.label" :currentPage="currentPage">
            </SidebarMenuDropdown>
        </div>
    </li>
</template>

<script setup>
import { useSidebarStore } from '@/stores/sidebar';
import { Link } from '@inertiajs/vue3';
import SidebarMenuDropdown from './SidebarMenuDropdown.vue';
const props = defineProps(['item', 'index'])

const sidebarStore = useSidebarStore()

const currentPage = route().current

const handleItemClick = (event) => {
    if (event) {
        event.preventDefault()
    }
    const page = sidebarStore.page === props.item.label ? '' : props.item.label
    sidebarStore.page = page

    if (typeof props.item.label === 'string' && typeof sidebarStore.selected === 'string') {
        console.log(sidebarStore.selected, props.item.label);
        return sidebarStore.selected === props.item.label;
    }
}

</script>
