<script setup>
import { ref, computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
    data: {
        type: Object
    }
});

const showFeedback = ref(null);
const showData = ref(null);

const urlShortened = computed(() => showFeedback.value && props.status === 'url-shortened');

function toggleFeedback(){
    showFeedback.value = true;
  setTimeout(() => {
    showFeedback.value = false;
  }, 3000);
}

function goBack(){
    showData.value = false;
}

const form = useForm({
    url: '',
});

const submit = () => {
    form.post(route('url.shorten'), {
        onSuccess: () => {
            form.defaults({
                url: '',
            });
            form.reset();
            toggleFeedback();
            showData.value = true;
        },
        onError: () => {
            console.log('an error occured')
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Url Shortener" />

        <div v-if="urlShortened" class="mb-4 font-medium text-sm text-green-600">
            Successful!
        </div>

        <div class="">
            <button @click="goBack()" v-if="showData" type="button" class="w-full flex items-center justify-end w-1/4 px-3 py-1 my-3 ml-auto text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-1 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
                <svg class="w-3 h-3 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
                <span>Go back</span>
            </button>
        </div>
        

        <div v-if="showData" class="relative overflow-x-auto mb-4">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Url
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Shortened Url
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                            {{ data.url }}
                        </th>
                        <td class="px-6 py-2 whitespace-nowrap dark:text-white">
                            {{ data.shortened_url }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <form v-else @submit.prevent="submit">
            <div>
                <InputLabel for="url" value="Url" />

                <TextInput
                    id="url"
                    
                    class="mt-1 block w-full"
                    placeholder="Enter url"
                    v-model="form.url"
                    required
                    autfocus
                />

                <InputError class="mt-2" :message="form.errors.url" />
            </div>

            <div class="flex items-center justify-end mt-4">

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Shorten
                </PrimaryButton>
            </div>
        </form>
       
    </GuestLayout>
</template>
