<template>
  <div class="hero-grid">
    <div
      v-for="(image, index) in images"
      :key="index"
      class="hero-container"
      :style="{ backgroundImage: `url(${image})` }"
    >
      <div class="text-overlay">
        <h1 class="title">Our Experience {{ index + 1 }}</h1>
      </div>
      <!-- Conditionally render border only for the first container -->
      <div v-if="index === 0" class="border"></div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

// List of images to show in each hero container
const images = ref([
  '/image/exp1.png', // Adjust these paths accordingly
  '/image/exp2.png',
]);
</script>

<style scoped>
.hero-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr); /* 2 columns for desktop */
  gap: 0; /* No gap between grid items */
  width: 100%;
  padding: 10px; /* White space around the grid container */
  background-color: white;
}

.hero-container {
  position: relative;
  width: 100%;
  height: 300px; /* Set desired image height */
  background-size: cover; /* Cover to fit entire container */
  background-position: center;
  background-repeat: no-repeat;
  padding: 10px; /* White space around each container */
}

.border {
  position: absolute;
  top: 0;
  right: 0;
  height: 100%;
  width: 2px;
  background-color: black; /* Black border */
}

.text-overlay {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  max-width: 80%;
  padding: 10px;
  border-radius: 10px;
  text-align: center;
  background-color: rgba(255, 255, 255, 0.7); /* Light background for readability */
}

.title {
  font-size: 3rem;
  color: #3a7ca5;
  animation: fadeInDown 2s ease-out;
  font-family: 'GramophoneShadedNF', serif;
  margin: 0;
}

/* Responsive adjustments */
@media (max-width: 1024px) {
  .hero-grid {
    grid-template-columns: 1fr; /* Switch to 1 column layout on tablets and below */
  }

  .title {
    font-size: 2.5rem;
  }

  /* Hide border on smaller screens */
  .border {
    display: none;
  }
}

@media (max-width: 768px) {
  .hero-container {
    height: 250px; /* Adjust height for smaller screens */
  }

  .title {
    font-size: 2rem;
  }
}

@media (max-width: 480px) {
  .hero-container {
    height: 200px; /* Adjust height for mobile screens */
  }

  .title {
    font-size: 1.5rem;
  }

  .text-overlay {
    padding: 5px; /* Reduce padding for text overlay on mobile */
  }
}
</style>
