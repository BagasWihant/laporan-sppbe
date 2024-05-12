<template>

    <Head title="Laporan RAB" />
    <MainDrawerLayout id="mainLayout">
        <div class="p-2">
            <div class="max-w-7xl mx-auto xs:px-6 lg:px-8">
                <div class="py-5 text-gray-900">
                    <strong class="text-2xl">LAPORAN RAB</strong>
                </div>

                <div class="flex justify-between py-2 flex-row-reverse">
                    <label class="input input-bordered input-sm flex items-center gap-2">
                        <input type="text" v-model="searchQuery" class="grow" placeholder="Search" />
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                            class="w-4 h-4 opacity-70">
                            <path fill-rule="evenodd"
                                d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                clip-rule="evenodd" />
                        </svg>
                    </label>
                    <div class="flex gap-2">
                        <button class="btn btn-info btn-sm text-white" v-if="selected.length > 0"
                            @click="bulkDelete">Delete Selected</button>
                        <div class="">
                            <input id="fileUpload" type="file" accept="text/csv" @change="uploadFiles" hidden>
                            <Link class="btn btn-success btn-sm text-white" :href="route('rab.create')" >RAB Baru</Link>
                        </div>
                    </div>
                </div>

                <div class="bg-primary-content overflow-x-auto shadow rounded-lg">
                    <table class="table table-zebra ">
                        <!-- head -->
                        <thead class="bg-slate-50 text-base">
                            <tr>
                                <th><input type="checkbox" @change="selectAll" /></th>
                                <th>Nama</th>
                                <th>Dibuat</th>
                                <th>Pemilik</th>
                                <th>Alamat</th>
                                <th width="1px"></th>
                            </tr>
                        </thead>
                    </table>
                    <div class="overflow-x-auto w-full bg-slate-50 p-2 m-0">
                        <!-- <TailwindPagination :data="barang" class="bg-primary-content"
                            @pagination-change-page="loadData"></TailwindPagination> -->
                    </div>
                </div>
            </div>
        </div>
    </MainDrawerLayout>
</template>

<script setup>
import MainDrawerLayout from '@/Layouts/MainDrawerLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const searchQuery = ref("")
const selected = ref([])
</script>
