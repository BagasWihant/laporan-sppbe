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
                                <th>Job</th>
                                <th>Favorite Color</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            <tr>
                                <th>1</th>
                                <td>Cy Ganderton</td>
                                <td>Quality Control Specialist</td>
                                <td>Blue</td>
                            </tr>
                            <!-- row 2 -->
                            <tr>
                                <th>2</th>
                                <td>Hart Hagerty</td>
                                <td>Desktop Support Technician</td>
                                <td>Purple</td>
                            </tr>
                            <!-- row 3 -->
                            <tr>
                                <th>3</th>
                                <td>Brice Swyre</td>
                                <td>Tax Accountant</td>
                                <td>Red</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </MainDrawerLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import MainDrawerLayout from '@/Layouts/MainDrawerLayout.vue';
import axios from 'axios';
import { ref } from 'vue';

const file = ref("")

const pilihFile = () => {
    document.getElementById('fileUpload').click()
}

const uploadFiles = (event) => {
    let formData = new FormData()

    file.value = event.target.files[0]
    formData.append("file",file.value)
    
    axios.post('barang', formData).then(() => {
        console.log('nise');
    }).catch(() => {
        console.log('fauil');
    })
}
</script>
