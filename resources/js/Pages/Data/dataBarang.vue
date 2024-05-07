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
                        <button class="btn btn-info btn-sm text-white" @click="addBarang()">+ Barang</button>
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
                            </tr>
                        </thead>
                        <tbody>
                            <!-- {{ data }} -->
                            <!-- row 1 -->
                            <tr v-for="(dt, index) in barang.data">
                                <th>{{ index + from }}</th>
                                <th>{{ dt.nama }}</th>
                                <th>{{ dt.satuan }}</th>
                                <th>{{ dt.stok }}</th>
                                <th>{{ dt.harga }}</th>
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

        <Modal :show="modalShow" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete your account?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Please
                    enter your password to confirm you would like to permanently delete your account.
                </p>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>
                </div>
            </div>
        </Modal>
    </MainDrawerLayout>
</template>

<script setup>
import { Head, router } from '@inertiajs/vue3';
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

const addBarang = () => {
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
