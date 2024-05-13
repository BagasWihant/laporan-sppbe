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
                        <label class="input input-bordered flex items-center gap-5">
                            Judul
                            <input type="text" class="grow" placeholder="Daisy" />
                        </label>
                    </div>
                    <div class="p-2">
                        <label class="input input-bordered flex items-center gap-5">
                            Sub Judul
                            <input type="text" class="grow" placeholder="Sub Judul" />
                        </label>
                    </div>
                    <div class="p-2">
                        <label class="input input-bordered flex items-center gap-5">
                            Tujuan
                            <input type="text" class="grow" placeholder="Tujuan" />
                        </label>
                    </div>
                    <div class="p-2">
                        <label class="input input-bordered flex items-center gap-5">
                            Notes
                            <input type="text" class="grow" placeholder="Notes" />
                        </label>
                    </div>
                    <div class="p-2">
                        <label class="flex gap-5">
                            TTD
                        </label>
                        <input type="file" class="file-input file-input-bordered file-input-accent w-full " />
                    </div>
                </form>
                
                <TabelBarang :barang="dataBarang" :nomor="from" @pilih="terpilih" >

                    <div class="overflow-x-auto w-full bg-slate-50 p-2 m-0">
                        <TailwindPagination :data="dataBarang" class="bg-primary-content"
                            @pagination-change-page="loadBarang"></TailwindPagination>
                    </div>
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
import { TailwindPagination } from 'laravel-vue-pagination';

const dataBarang = ref([])
const searchQuery = ref("")
const from = ref(0)
onMounted(() => {
    loadBarang()

})
const terpilih = (value)=>{
    console.log(value);
}
const loadBarang = async (page = 1) => {
    if (searchQuery.value !== '') return await axios.post(route('barangSearch'), { page: page, key: searchQuery.value })
        .then(res => {
            dataBarang.value = res.data
            from.value = res.data.from
            
            // console.log(res);
            
        })
        else return await axios.get(route('barangShow', 'page') + page)
        .then((res) => {
            dataBarang.value = res.data
            from.value = res.data.from
            // console.log(res);

        })
}

</script>
