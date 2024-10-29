<template>
    <div>
      <Header />
      <div class="clients-container">
        <div class="vertical-title">
          <h1 class="clients-title">Our Clients</h1>
        </div>
        <div class="clients-logos">
          <div
            v-for="(client, index) in clients"
            :key="client.id"
            class="logo-container"
            @click="openImageViewer(index)"
          >
            <!-- Displaying client logo -->
            <img :src="`${base_path}${client.meta_keywords}`" :alt="client.title" class="client-logo" />
            <!-- Client name -->
            <p class="client-title">{{ client.name }}</p>
          </div>
        </div>
      </div>
      
      <!-- Image Viewer Modal -->
      <div v-if="isImageViewerOpen" class="image-viewer-modal" @click.self="closeImageViewer">
        <button class="prev-button" @click="prevImage">&#10094;</button>
        <div class="image-viewer-content">
          <img :src="`${base_path}${clients[currentIndex].meta_keywords}`" :alt="clients[currentIndex].name" class="viewer-image" />
          <p class="viewer-client-title">{{ clients[currentIndex].name }}</p>
        </div>
        <button class="next-button" @click="nextImage">&#10095;</button>
      </div>
      
      <Footer />
    </div>
  </template>
  
  <script setup>
  import Header from "./Header.vue";
  import Footer from "./Footer.vue";
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  
  const base_path = '/website/';
  let clients = ref([]); // Holds the list of clients
  
  // Image Viewer state
  const isImageViewerOpen = ref(false);
  const currentIndex = ref(0);
  
  // Fetch clients data on mount
  onMounted(async () => {
    await fetchClients();
  });
  
  // Fetch all client data
  const fetchClients = async () => {
    try {
      let response = await axios.get("/api/latest_three_item");
      clients.value = response.data.latestPosts;
    } catch (error) {
      console.error("Error fetching clients:", error);
    }
  };
  
  // Open image viewer at specific index
  const openImageViewer = (index) => {
    currentIndex.value = index;
    isImageViewerOpen.value = true;
  };
  
  // Close image viewer
  const closeImageViewer = () => {
    isImageViewerOpen.value = false;
  };
  
  // Navigate to previous image
  const prevImage = () => {
    currentIndex.value = (currentIndex.value - 1 + clients.value.length) % clients.value.length;
  };
  
  // Navigate to next image
  const nextImage = () => {
    currentIndex.value = (currentIndex.value + 1) % clients.value.length;
  };
  
  </script>
  
  <style scoped>
  /* Container for clients */
  .clients-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 0 5%;
    height: auto;
    background-color: #f5f5f5;
  }
  
  .vertical-title {
    margin-top: 101px;
    margin-left: 170px;
    writing-mode: vertical-rl;
    transform: rotate(180deg);
    color: #3a7ca5;
    font-family: 'GramophoneShadedNF', serif;
  }
  
  .clients-title {
    font-size: 2.7rem;
    color: #3a7ca5;
    margin-top: 80px;
  }
  
  /* Clients logos grid - 5 in a row */
  .clients-logos {
    margin-top: 100px;
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 20px;
    width: 80%;
    border-left: 2px solid #3a7ca5;
    padding-left: 20px;
  }
  
  .logo-container {
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    cursor: pointer;
  }
  
  .client-logo {
    max-width: 150px;
    max-height: 150px;
    object-fit: contain;
    transition: transform 0.3s ease-in-out;
  }
  
  .client-logo:hover {
    transform: scale(1.1);
  }
  
  .client-title {
    margin-top: 8px;
    font-size: 1rem;
    text-align: center;
    color: #3a7ca5;
  }
  
  /* Image Viewer Modal Styles */
  .image-viewer-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 100;
  }
  
  .image-viewer-content {
    position: relative;
    text-align: center;
  }
  
  .viewer-image {
    max-width: 80vw;
    max-height: 80vh;
    object-fit: contain;
  }
  
  .viewer-client-title {
    margin-top: 10px;
    font-size: 1.2rem;
    color: #fff;
  }
  
  .prev-button, .next-button {
    position: absolute;
    top: 50%;
    color: #fff;
    font-size: 2rem;
    background: none;
    border: none;
    cursor: pointer;
    padding: 0 20px;
    user-select: none;
  }
  
  .prev-button {
    left: 5%;
  }
  
  .next-button {
    right: 5%;
  }
  </style>
  