<template>
  <div>
    <Header />
    
    <!-- Modal for full-screen view -->
    <div v-if="showModal" class="fullscreen-modal" @click="closeModal" @wheel="handleScroll">
      <div class="fullscreen-content" @click.stop>
        <!-- Full-screen image view -->
        <img 
          v-if="activeMediaType === 'image'" 
          :src="currentMedia" 
          alt="Full screen image" 
          class="fullscreen-media"
        />
        <!-- Full-screen reel (video) view -->
        <video 
          v-if="activeMediaType === 'reel'" 
          :src="currentMedia" 
          controls 
          autoplay 
          class="fullscreen-media"
        ></video>
      </div>
    </div>

    <!-- Modal Content -->
    <div class="modal-content" @click.stop>
      <h2 class="border-b text-blue-600 text-l font-bold leading-tight font-serif pb-2 mb-4">
        <span> Portfolio for </span>
        {{ category || 'No Title Available' }}
      </h2>
      <div class="new">
        <img 
          :src="`${base_path}${catimage}`" 
          alt="Client Photo" style="height: 117px;width: 177px;"
        />
      </div>

      <!-- Tabs Section -->
      <div class="tabs">
        <button 
          :class="{'active-tab': activeTab === 'photos'}" 
          @click="activeTab = 'photos'" 
          class="tab-button"
        >Photos</button>

        <button 
          :class="{'active-tab': activeTab === 'reels'}" 
          @click="activeTab = 'reels'" 
          class="tab-button"
        >Reels</button>
      </div>

      <!-- Grid Container for Photos -->
      <div v-if="activeTab === 'photos'" class="media-grid">
        <img 
          v-for="(photo, index) in photos" 
          :key="index" 
          :src="`${base_path}${photo.url}`" 
          alt="Client Photo" 
          class="media-item"
          @click="openModal(`${base_path}${photo.url}`, 'image', index)"
        />
      </div>

      <!-- Grid Container for Reels -->
      <div v-if="activeTab === 'reels'" class="media-grid">
        <video 
          v-for="(reel, index) in reels" 
          :key="index" 
          :src="`${base_path}${reel.url}`" 
          class="media-item"
          @click="openModal(`${base_path}${reel.url}`, 'reel', index)"
        ></video>
      </div>
    </div>

    <Footer />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Header from "./Header.vue";
import Footer from "./Footer.vue";

const props = defineProps({
  slug: {
    type: String,
    default: ''
  }
});

const base_path = '/website/';
let clientData = ref([]);

// Fetch the client data when component is mounted
onMounted(async () => {
  await fetchClientsProject(); 
});

// Active tab state
const activeTab = ref('photos');

// State for photos, reels, and category
const photos = ref([]);
const reels = ref([]);
const category = ref([]);
const catimage = ref([]);

// State for modal
const showModal = ref(false);
const currentMedia = ref(null); // Store the current media (image or video)
const activeMediaType = ref(''); // To distinguish between 'image' or 'reel'
const currentIndex = ref(0); // Store the current index of media item

// Function to fetch client data
const fetchClientsProject = async () => {
  try {
    const response = await axios.get(`/api/details/${props.slug}`);
    const clientData = response.data.data;
    
    photos.value = clientData.images;
    reels.value = clientData.reels;
    category.value = clientData.category_name;
    catimage.value = clientData.category_image;
  } catch (error) {
    console.error("Error fetching client details:", error);
  }
};

// Function to open modal with selected media
const openModal = (mediaUrl, mediaType, index) => {
  currentMedia.value = mediaUrl;
  activeMediaType.value = mediaType;
  currentIndex.value = index;
  showModal.value = true;
};

// Function to close modal
const closeModal = () => {
  showModal.value = false;
  currentMedia.value = null;
  activeMediaType.value = '';
};

// Function to handle scroll event for navigating media
const handleScroll = (event) => {
  if (event.deltaY < 0) {
    // Scroll up: Go to the previous media
    showPreviousMedia();
  } else {
    // Scroll down: Go to the next media
    showNextMedia();
  }
};

// Function to show the next media
const showNextMedia = () => {
  if (activeMediaType.value === 'image' && currentIndex.value < photos.value.length - 1) {
    currentIndex.value++;
    currentMedia.value = `${base_path}${photos.value[currentIndex.value].url}`;
  } else if (activeMediaType.value === 'reel' && currentIndex.value < reels.value.length - 1) {
    currentIndex.value++;
    currentMedia.value = `${base_path}${reels.value[currentIndex.value].url}`;
  }
};

// Function to show the previous media
const showPreviousMedia = () => {
  if (activeMediaType.value === 'image' && currentIndex.value > 0) {
    currentIndex.value--;
    currentMedia.value = `${base_path}${photos.value[currentIndex.value].url}`;
  } else if (activeMediaType.value === 'reel' && currentIndex.value > 0) {
    currentIndex.value--;
    currentMedia.value = `${base_path}${reels.value[currentIndex.value].url}`;
  }
};
</script>

<style scoped>
/* Modal Content */
.modal-content {
  margin-top: 92px;
  margin-left: 429px;
  background: white;
  padding: 11px;
  border-radius: 8px;
  max-width: 500px;
  width: 90%;
  text-align: center;
}

@media (max-width: 480px) {
  .modal-content {
    margin-left: 23px;
    background: white;
    padding: 11px;
    border-radius: 8px;
    max-width: 500px;
    width: 90%;
    text-align: center;
  }
}

/* Tabs Styles */
.tabs {
  display: flex;
  justify-content: center;
  margin-bottom: 20px;
  font-family: serif;
}

.tab-button {
  background-color: #575454;
  border: 1px solid #ccc;
  padding: 10px 20px;
  cursor: pointer;
  border-radius: 5px 5px 0 0;
  margin-right: 10px;
  transition: background-color 0.3s;
}

.tab-button:hover {
  background-color: #ddd;
}

.active-tab {
  background-color: #3a7ca5;
  color: white;
}

/* Grid Layout for Images and Reels */
.media-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  margin-top: 10px;
}

/* Media item styling */
.media-item {
  width: 120px;
  height: 200px;
  object-fit: cover;
  cursor: pointer;
  border-radius: 5px;
}

/* Fullscreen modal for images and reels */
.fullscreen-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(0, 0, 0, 0.8);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.fullscreen-content {
  position: relative;
}

.fullscreen-media {
  max-width: 90vw;
  max-height: 90vh;
  border-radius: 10px;
}

.new {
  margin-left: 166px;
  width: 155px;
  height: 130px;
}

@media (max-width: 480px) {
  .new {
    margin-left: 90px;
    height: 130px;
  }
}
</style>
