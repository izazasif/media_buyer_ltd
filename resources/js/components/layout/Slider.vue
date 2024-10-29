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

        <!-- Buttons Section -->
        <div class="buttons-container mt-4">
          <button class="explore-button animate-button" @click="contactUs">Contact us</button>
          <button class="explore-button animate-button mt-2 md:ml-2" @click="onShowCat">Who we are</button>
          <button class="explore-button animate-button mt-2 md:ml-2"  @click="onShow">Mission</button>
          <button class="explore-button animate-button mt-2 md:ml-2" @click="contactUs">Vision</button>
        </div>

        <!-- Additional Image on Right Side -->
        <img :src="additionalImage" class="additional-image" loading="lazy" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { useRouter } from "vue-router";

const router = useRouter();

const animatedText = ref(["Media", "Buyer", "Marketing", "Agency"]);
const wordIndex = ref(0);
const fadeOut = ref(false);

const fadeDuration = 1000;
const wordDisplayDuration = 1000;
const allWordsVisibleDuration = 3000;

const showNextWord = () => {
  if (wordIndex.value < animatedText.value.length - 1) {
    wordIndex.value++;
  } else {
    setTimeout(() => {
      fadeOut.value = true;
      setTimeout(() => {
        fadeOut.value = false;
        wordIndex.value = 0;
      }, fadeDuration);
    }, allWordsVisibleDuration);
  }
};

onMounted(() => {
  const wordInterval = setInterval(showNextWord, wordDisplayDuration);

  onUnmounted(() => {
    clearInterval(wordInterval);
  });
});

const contactUs = () => {
  router.push('/contactus');
};
const onShow =  () => {
  router.push('/mission');
}
const onShowCat = () => {
  router.push('/whoweare');
}
const onShowvision = () => {
  router.push('/vision');
}
</script>

<style scoped>
.h-screen {
  height: 80vh;
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
  font-family: 'GramophoneShadedNF', serif;
  text-transform: uppercase;
  margin-top: -10px;
  transition: opacity 1s ease-in-out;
}

span {
  font-size: 3rem;
  font-weight: 700;
  color: #3a7ca5;
  opacity: 0;
  transform: translateY(50px);
  transition: opacity 1s ease-in-out, transform 1s ease-in-out;
}

span.animate-word {
  opacity: 1;
  transform: translateY(0);
}

.text-container.fade-out {
  opacity: 0;
}

.buttons-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 0.5rem;
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
  transform: scale(1.05);
}

.additional-image {
  position: absolute;
  right: 367px;
  bottom: 186px;
  width: 455px;
  height: auto;
  z-index: 10;
}

@media (max-width: 768px) {
  .h-screen {
    height: 70vh;
  }
  .span {
    font-size: 2rem;
  }
  .additional-image {
    width: 300px;
    right: 150px;
    bottom: 100px;
  }
  .explore-button {
    font-size: 1.2rem;
    padding: 8px 16px;
  }
  .buttons-container {
    gap: 0.3rem;
  }
}

@media (max-width: 480px) {
  .h-screen {
    height: 60vh;
  }
  span {
    font-size: 1.5rem;
  }
  .text-container {
    margin-top: -20px;
  }
  .additional-image {
    width: 200px;
    right: 50px;
    bottom: 50px;
  }
  .explore-button {
    font-size: 1rem;
    padding: 6px 12px;
    margin-top: 5px;
  }
  .buttons-container {
    flex-direction: column;
    align-items: center;
  }
}
</style>
