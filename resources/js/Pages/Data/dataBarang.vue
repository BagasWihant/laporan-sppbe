<template>

    <Head title="Data Barang" />
    <MainDrawerLayout id="mainLayout">
        <div class="py-10">
            <div class="max-w-7xl mx-auto xs:px-6 lg:px-8">
                <div class="py-5 text-gray-900">
                    <strong class="text-2xl">Data Barang</strong>
                </div>

                <div class="flex justify-between py-2">
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
                        <button class="btn btn-info btn-sm text-white" @click="openModal">+ Barang</button>
                        <div class="">
                            <input id="fileUpload" type="file" accept="text/csv" @change="uploadFiles" hidden>
                            <button class="btn btn-success btn-sm text-white" @click="pilihFile()">Import CSV</button>
                        </div>
                    </div>
                </div>
                <div class="bg-primary-content overflow-x-auto shadow rounded-lg">
                    <table class="table table-zebra ">
                        <!-- head -->
                        <thead class="bg-slate-50 text-base">
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Satuan</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th width="1px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- {{ barang.data }} -->
                            <!-- row 1 -->
                            <tr v-for="(dt, index) in barang.data" :key="dt.id">
                                <th>{{ index + from }}</th>
                                <th>{{ dt.nama }}</th>
                                <th>{{ dt.satuan }}</th>
                                <th>{{ dt.stok }}</th>
                                <th>{{ dt.harga }}</th>
                                <th class="flex gap-1">
                                    <svg :key="dt.id" baseProfile="tiny" height="29px" id="Layer_1" role="button"
                                        class="bg-yellow-300 rounded-md p-1 hover:bg-yellow-500"
                                        onclick="my_modal_2.showModal()" version="1.2" viewBox="0 0 24 24" width="29px"
                                        xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <path
                                            d="M21.561,5.318l-2.879-2.879C18.389,2.146,18.005,2,17.621,2c-0.385,0-0.768,0.146-1.061,0.439L13,6H4C3.448,6,3,6.447,3,7  v13c0,0.553,0.448,1,1,1h13c0.552,0,1-0.447,1-1v-9l3.561-3.561C21.854,7.146,22,6.762,22,6.378S21.854,5.611,21.561,5.318z   M11.5,14.672L9.328,12.5l6.293-6.293l2.172,2.172L11.5,14.672z M8.939,13.333l1.756,1.728L9,15L8.939,13.333z M16,19H5V8h6  l-3.18,3.18c-0.293,0.293-0.478,0.812-0.629,1.289C7.031,12.969,7,13.525,7,13.939V17h3.061c0.414,0,1.108-0.1,1.571-0.29  c0.464-0.19,0.896-0.347,1.188-0.64L16,13V19z M18.5,7.672L16.328,5.5l1.293-1.293l2.171,2.172L18.5,7.672z" />
                                    </svg>
                                    <svg :key="dt.id" baseProfile="tiny" height="29px" id="Layer_1" role="button"
                                        class="bg-yellow-300 rounded-md p-1 hover:bg-yellow-500"
                                        @click="openModal('hapus')" version="1.2" viewBox="0 0 24 24" width="29px"
                                        xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <path
                                            d="M21.561,5.318l-2.879-2.879C18.389,2.146,18.005,2,17.621,2c-0.385,0-0.768,0.146-1.061,0.439L13,6H4C3.448,6,3,6.447,3,7  v13c0,0.553,0.448,1,1,1h13c0.552,0,1-0.447,1-1v-9l3.561-3.561C21.854,7.146,22,6.762,22,6.378S21.854,5.611,21.561,5.318z   M11.5,14.672L9.328,12.5l6.293-6.293l2.172,2.172L11.5,14.672z M8.939,13.333l1.756,1.728L9,15L8.939,13.333z M16,19H5V8h6  l-3.18,3.18c-0.293,0.293-0.478,0.812-0.629,1.289C7.031,12.969,7,13.525,7,13.939V17h3.061c0.414,0,1.108-0.1,1.571-0.29  c0.464-0.19,0.896-0.347,1.188-0.64L16,13V19z M18.5,7.672L16.328,5.5l1.293-1.293l2.171,2.172L18.5,7.672z" />
                                    </svg>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <div class="overflow-x-auto w-full bg-slate-50 p-2 m-0">
                        <TailwindPagination :data="barang" class="bg-primary-content"
                            @pagination-change-page="loadData"></TailwindPagination>
                    </div>
                </div>
            </div>
        </div>

        <dialog id="my_modal_2" class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-center text-2xl">Hello!</h3>
                <div class="w-full flex-col gap-2 flex">
                    <label for="">Nama</label>
                    <input type="text" placeholder="Type here" class="input input-bordered input-sm w-full " />
                    <div class="flex gap-2 w-full">
                        <div class="w-full">
                            <label for="">Stok</label>
                            <input type="text" placeholder="Type here" class="input input-bordered input-sm w-full " />
                        </div>
                        <div class="w-full">
                            <label for="">Satuan</label>
                            <input type="text" placeholder="Type here" class="input input-bordered input-sm w-full " />
                        </div>
                    </div>
                    <label for="">Harga</label>
                    <input type="text" placeholder="Type here" class="input input-bordered input-sm w-full " />
                </div>



            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>
    </MainDrawerLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import MainDrawerLayout from '@/Layouts/MainDrawerLayout.vue';
import axios from 'axios';
import { TailwindPagination } from 'laravel-vue-pagination';
import { onMounted, ref, watch } from 'vue';
import debounce from 'lodash.debounce';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const file = ref("")
const barang = ref([])
const halaman = ref("")
const from = ref("")
const searchQuery = ref("")
const modalShow = ref(false)
const isiModal = ref("")

const contentHapus = '<h2 class="text-lg font-medium text-gray-900">\
                    Are you sure you want to delete your account?\
                </h2>\
                <p class="mt-1 text-sm text-gray-600">\
                    Once your account is deleted, all of its resources and data will be permanently deleted. Please\
                    enter your password to confirm you would like to permanently delete your account.\
                </p>'

onMounted(() => {
    loadData()
})

const loadData = async (page = 1) => {
    halaman.value = page
    if (searchQuery.value !== '') return await axios.post(route('barangSearch'), { page: page, key: searchQuery.value })
        .then((res) => {
            barang.value = res.data
            // console.log(res);
            from.value = res.data.from
        })
    else return await axios.get(route('barangShow', 'page') + page)
        .then((res) => {
            barang.value = res.data
            // console.log(res);
            from.value = res.data.from
        })
}

const pilihFile = () => {
    document.getElementById('fileUpload').click()
}

const openModal = (mode) => {
    if (mode === 'edit') isiModal.value = "Sedang edit"
    else if (mode === 'hapus') isiModal.value = contentHapus
    modalShow.value = true
}

const closeModal = () => {
    modalShow.value = false;

    // form.reset();
};

const uploadFiles = async (event) => {
    let formData = new FormData()

    file.value = event.target.files[0]
    formData.append("file", file.value)

    await axios.post('barang', formData).then((res) => {
        loadData(halaman.value)
        document.getElementById('fileUpload').value = ''
    }).catch(() => {
        console.log('fauil');
    })
}

const debouncedWatch = debounce(() => {
    if (searchQuery.value === '') return loadData()

    axios.post(route('barangSearch'), { key: searchQuery.value })
        .then((res) => {
            barang.value = res.data
            halaman.value = 1
        })
}, 500);

watch(searchQuery, debouncedWatch)

</script>
