<template>

    <Head title="Data Barang" />
    <MainDrawerLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="py-1 text-gray-900">
                    <strong class="text-xl">Data Barang</strong>
                </div>

                <div class="flex justify-end py-2">
                    <input id="fileUpload" type="file" accept="text/csv" @change="uploadFiles" hidden>
                    <button class="btn btn-success btn-sm text-white" @click="pilihFile()">Import CSV</button>
                </div>

                <div class="bg-primary-content overflow-hidden shadow sm:rounded-lg">
                    <table class="table table-zebra">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Satuan</th>
                                <th>Stok</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            <tr v-for="(dt,index) in data">
                                <th>{{ index+1 }}</th>
                                <th>{{ dt.nama }}</th>
                                <th>{{  dt.satuan }}</th>
                                <th>{{ dt.stok }}</th>
                                <th>{{ dt.harga }}</th>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </MainDrawerLayout>
</template>

<script setup>
import { Head, router } from '@inertiajs/vue3';
import MainDrawerLayout from '@/Layouts/MainDrawerLayout.vue';
import axios from 'axios';
import { ref } from 'vue';

const file = ref("")
defineProps({
    data: Array
})

const pilihFile = () => {
    document.getElementById('fileUpload').click()
}

const uploadFiles = (event) => {
    let formData = new FormData()

    file.value = event.target.files[0]
    formData.append("file",file.value)
    
    router.post('barang', formData).then(() => {
        console.log('nise');
    }).catch(() => {
        console.log('fauil');
    })
}
</script>
