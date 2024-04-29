<template>
    <ul class="menu bg-base-200 w-56 rounded-box gap-2">
        <div v-for="(menu, index) in menus" :key="menu.id">
            <li v-if="menu.child">
                <details>
                    <summary>{{ menu.name }}</summary>
                    <ul v-for="submenu in menu.child">
                        <NavLink :href="route(submenu.link)" :active="route().current(submenu.link)">
                            {{ submenu.name }}
                        </NavLink>
                    </ul>
                </details>
            </li>
            <li v-else>
                <NavLink :href="route(menu.link)" :active="route().current(menu.link)">
                    Dashboard
                </NavLink>
            </li>
        </div>
    </ul>
</template>

<script setup>
import { onMounted } from 'vue';
import NavLink from './NavLink.vue';
const menus = [
    {
        name: "Dashboard",
        link: "dashboard",
        cek:['dashboard']
    },
    {
        name: "Master",
        cek:['barang','perusahaan'],
        child: [
            {
                name: "Data Barang",
                link: "barang",
            },
            {
                name: "Data Perusahaan",
                link: "perusahaan",
            },
        ]
    },
    {
        name: "Dashboard",
        link: "dashboard",
    },
]
onMounted(()=>{
    includes()
})
</script>
