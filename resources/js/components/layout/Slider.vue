<template>
  <div class="relative overflow-hidden w-full h-screen">
    <!-- Hero Section -->
    <div class="relative w-full h-full hero-background">
      <!-- Overlay Content -->
      <div class="absolute inset-0 flex flex-col justify-center items-center lg:items-start p-10">
        <!-- Animated Text Section -->
        <div class="text-container text-center lg:text-left" :class="{'fade-out': fadeOut}">
          <span
            v-for="(word, index) in animatedText"
            :key="index"
            :class="{'animate-word': index <= wordIndex}"
            class="block"
          >
            {{ word }}
          </span>
        </div>

        <!-- Explore Button -->
        <button class="explore-button animate-button mt-4">
          Book Free Consultation
        </button>

        <!-- Additional Image on Right Side -->
        <img :src="additionalImage" class="additional-image" loading="lazy" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

// Words for the animation
const animatedText = ref(["Media", "Buyer", "Marketing", "Agency"]);
const wordIndex = ref(0);
const fadeOut = ref(false); // To control the fade-out state

// Timing settings
const fadeDuration = 1000; // 1 second for fade-out
const wordDisplayDuration = 1000; // 1 second between each word appearance
const allWordsVisibleDuration = 3000; // Wait 3 seconds after all words are visible

const showNextWord = () => {
  // If not all words are shown yet
  if (wordIndex.value < animatedText.value.length - 1) {
    wordIndex.value++;
  } else {
    // After all words are shown, wait and then fade out
    setTimeout(() => {
      fadeOut.value = true;

      // After fading out, reset the animation
      setTimeout(() => {
        fadeOut.value = false;
        wordIndex.value = 0; // Reset to first word
      }, fadeDuration); // Wait for the fade-out to finish
    }, allWordsVisibleDuration); // Wait after all words are visible
  }
};

onMounted(() => {
  // Show each word one by one
  const wordInterval = setInterval(showNextWord, wordDisplayDuration);

  onUnmounted(() => {
    clearInterval(wordInterval);
  });
});
</script>

<style scoped>
.h-screen {
  height: 80vh; /* Full-screen height for the image */
}

.hero-background {
  background-image: url('/image/new2.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  width: 100%; 
  height: 100%; 
}

.text-container {
  font-family: 'GramophoneShadedNF', serif; /* Custom font */
  text-transform: uppercase;
  margin-top: -10px;
  transition: opacity 1s ease-in-out;
}

span {
  font-size: 3rem;
  font-weight: 700;
  color: #3a7ca5; /* Primary color */
  opacity: 0;
  transform: translateY(50px); /* Start from below */
  transition: opacity 1s ease-in-out, transform 1s ease-in-out;
}

span.animate-word {
  opacity: 1;
  transform: translateY(0); /* Move to original position */
}

.text-container.fade-out {
  opacity: 0;
}

.explore-button {
  font-family: 'GramophoneShadedNF', serif;
  padding: 10px 20px;
  font-size: 1.5rem;
  background-color: rgba(38, 79, 105, 0.7);
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
}

.explore-button:hover {
  background-color: rgba(58, 124, 165, 1);
  transform: scale(1.05); /* Slight scale-up on hover */
}

.additional-image {
  position: absolute;
  right: 367px; /* Adjust this value to move the image further to the right */
  bottom: 186px; /* Adjust this value to position the image vertically */
  width: 455px; /* Set the desired width for the image */
  height: auto;
  z-index: 10; /* Ensure it appears above other content */
}

/* Responsive design for smaller screens */
@media (max-width: 768px) {
  .h-screen {
    height: 70vh; /* Reduce the height for tablets */
  }

  .span {
    font-size: 2rem; /* Reduce the font size of the animated words */
  }

  .additional-image {
    width: 300px; /* Reduce the image size */
    right: 150px;
    bottom: 100px;
  }

  .explore-button {
    font-size: 1.2rem; /* Reduce button size for better fit */
  }
}

@media (max-width: 480px) {
  .h-screen {
    height: 60vh; /* Reduce the height for mobile devices */
  }

  span {
    font-size: 1.5rem; /* Further reduce the font size for small screens */
  }

  .text-container {
    margin-top: -20px; /* Adjust text positioning */
  }

  .additional-image {
    width: 200px; /* Further reduce image size */
    right: 50px;
    bottom: 50px;
  }

  .explore-button {
    font-size: 1rem; /* Smaller button for mobile */
    padding: 8px 16px; /* Adjust padding */
  }
}
</style>
