<template>
    <MainDrawerLayout>

        <Head title="RAB Baru" />
        <div class="p-2">
            <div class="max-w-7xl mx-auto xs:px-6 lg:px-8">
                <div class="py-5 text-gray-900">
                    <strong class="text-2xl">Buat RAB Baru</strong>
                </div>

                <form>
                    <div class="p-2">
                        <label class="input input-bordered input-sm flex items-center gap-5">
                            Judul
                            <input type="text" class="grow" placeholder="Daisy" />
                        </label>
                    </div>
                    <div class="p-2">
                        <label class="input input-bordered input-sm flex items-center gap-5">
                            Sub Judul
                            <input type="text" class="grow" placeholder="Sub Judul" />
                        </label>
                    </div>
                    <div class="p-2">
                        <label class="input input-bordered input-sm flex items-center gap-5">
                            Tujuan
                            <input type="text" class="grow" placeholder="Tujuan" />
                        </label>
                    </div>
                    <div class="p-2">
                        <label class="input input-bordered input-sm flex items-center gap-5">
                            Notes
                            <input type="text" class="grow" placeholder="Notes" />
                        </label>
                    </div>
                    <div class="p-2">
                        <label class="flex gap-5 input input-sm items-center input-bordered ">
                            TTD
                            <input type="file" class="file-input-sm file-input w-full " />
                        </label>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="table table-xs">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="d in dataTerpilih" >
                                <th>{{ d[0] }}</th>
                                <th>{{ d[1] }}</th>
                                <th>{{ d[2] }}</th>
                                <th>{{ d[3] }}</th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <TabelBarang @pilih="terpilih" :selectAllToggle="selectAll" >
                   
                </TabelBarang>
            </div>
        </div>

    </MainDrawerLayout>
</template>

<script setup>
import MainDrawerLayout from '@/Layouts/MainDrawerLayout.vue';
import { Head } from '@inertiajs/vue3';
import TabelBarang from '../Data/tabelBarang.vue';
import { onMounted, ref } from 'vue';

const dataTerpilih = ref([])
const selectAll = ref(false)
const emit = defineEmits(['toggle'])

const terpilih = (value) => {
    dataTerpilih.value = value
}


</script>
