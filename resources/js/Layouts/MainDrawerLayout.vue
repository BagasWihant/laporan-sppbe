<template>
    <div>
        <div class="drawer lg:drawer-open">
            <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content flex flex-col">
                <div class="w-full navbar bg-slate-50 shadow-md px-0 sm:px-9">

                    <div class="flex-none md:hidden">
                        <label for="my-drawer-2" aria-label="open sidebar" class="btn btn-square btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="inline-block w-6 h-6 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </label>
                    </div>

                    <div class="flex-1 px-2 mx-2">logo</div>

                    <div class="flex-none hidden sm:block">
                        <ul class="menu menu-horizontal">
                            <!-- Navbar menu content here -->

                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-800 bg-primary-content hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            {{ $page.props.auth.user.name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button">
                                        Log Out
                                    </DropdownLink>
                                </template>
                            </Dropdown>

                        </ul>
                    </div>
                </div>
                <main>
                    <slot />
                </main>

            </div>
            <div class="drawer-side">
                <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
                <ul class="p-4 w-72 min-h-full bg-base-300 text-base-content">
                    <!-- Sidebar content here -->
                    <div class="w-full navbar bg-slate-50 shadow-md rounded-xl">
                        <div class="w-full flex justify-center">
                            <p class="text-xl font-bold">L O G O</p>
                        </div>
                    </div>
                    <div class="flex-col flex py-5 gap-1">
                        
                        <!-- <NavLink :href="route('dataBarang')" :active="route().current('dataBarang')">
                            Barang
                        </NavLink> -->
                        <SidebarMenu />
                    </div>
                    <!-- <li><a></a></li> -->
                </ul>

            </div>
        </div>
    </div>
</template>

<script setup>
import SidebarMenu from '@/Components/SidebarMenu.vue';
import Dropdown from '@/Components/Dropdown.vue';
import NavLink from '@/Components/NavLink.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
</script>
