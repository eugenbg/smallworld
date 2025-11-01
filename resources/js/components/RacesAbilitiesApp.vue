<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Sticky Header: Tabs + Search Bar -->
    <div class="sticky top-0 z-10 bg-white shadow-sm">
      <!-- Tabs -->
      <div class="max-w-4xl mx-auto px-4">
        <div class="flex border-b border-gray-200">
          <button
            @click="switchTab('races')"
            :class="[
              'flex-1 py-4 text-center font-medium text-lg transition-colors',
              activeTab === 'races'
                ? 'text-blue-600 border-b-2 border-blue-600'
                : 'text-gray-500 hover:text-gray-700'
            ]"
          >
            Расы
          </button>
          <button
            @click="switchTab('abilities')"
            :class="[
              'flex-1 py-4 text-center font-medium text-lg transition-colors',
              activeTab === 'abilities'
                ? 'text-blue-600 border-b-2 border-blue-600'
                : 'text-gray-500 hover:text-gray-700'
            ]"
          >
            Способности
          </button>
        </div>
      </div>

      <!-- Search Bar -->
      <div class="max-w-4xl mx-auto px-4 py-4">
        <div class="relative">
          <input
            v-model="searchQuery"
            type="text"
            :placeholder="activeTab === 'races' ? 'Поиск рас...' : 'Поиск способностей...'"
            class="w-full px-4 py-3 pr-10 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
          />
          <svg
            class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
            />
          </svg>
        </div>
      </div>
    </div>

    <!-- Loading State -->
    <div v-if="loading" class="max-w-4xl mx-auto px-4 py-8 text-center text-gray-500">
      Загрузка...
    </div>

    <!-- Results List -->
    <div v-else class="max-w-4xl mx-auto px-4 pb-8">
      <div v-if="filteredItems.length === 0" class="text-center py-8 text-gray-500">
        Ничего не найдено
      </div>
      
      <div v-else class="space-y-4">
        <div
          v-for="item in filteredItems"
          :key="`${activeTab}-${item.id}`"
          class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow"
        >
          <div class="flex gap-4">
            <!-- Image placeholder/thumbnail -->
            <div 
              v-if="item.image"
              class="flex-shrink-0 w-20 h-20 bg-gray-200 rounded-lg overflow-hidden"
            >
              <img
                :src="`/storage/${item.image}`"
                :alt="item.name"
                class="w-full h-full object-cover"
              />
            </div>
            <div
              v-else
              class="flex-shrink-0 w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center"
            >
              <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
            </div>

            <!-- Content -->
            <div class="flex-1 min-w-0">
              <div class="flex items-start justify-between gap-2">
                <h3 class="text-lg font-semibold text-gray-900">
                  {{ item.name }}
                </h3>
                <span class="flex-shrink-0 inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                  {{ item.qty }}
                </span>
              </div>
              
              <p v-if="item.description" class="mt-2 text-sm text-gray-600 whitespace-pre-wrap">
                {{ item.description }}
              </p>
              
              <div v-if="item.edition" class="mt-2 text-xs text-gray-500">
                Издание: {{ item.edition.name }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';

const activeTab = ref('races');
const searchQuery = ref('');
const races = ref([]);
const abilities = ref([]);
const loading = ref(true);

const switchTab = (tab) => {
  activeTab.value = tab;
  searchQuery.value = ''; // Reset search when switching tabs
};

const currentItems = computed(() => {
  return activeTab.value === 'races' ? races.value : abilities.value;
});

const filteredItems = computed(() => {
  if (!searchQuery.value.trim()) {
    return currentItems.value;
  }
  
  const query = searchQuery.value.toLowerCase();
  return currentItems.value.filter(item =>
    item.name.toLowerCase().includes(query)
  );
});

onMounted(async () => {
  try {
    const [racesResponse, abilitiesResponse] = await Promise.all([
      axios.get('/api/races'),
      axios.get('/api/abilities')
    ]);
    
    races.value = racesResponse.data;
    abilities.value = abilitiesResponse.data;
  } catch (error) {
    console.error('Error fetching data:', error);
  } finally {
    loading.value = false;
  }
});
</script>

