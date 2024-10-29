<template>
  <div class="clients-container">
    <!-- Vertical Title -->
    <div class="vertical-title">
      <h1 class="clients-title">Our Clients</h1>
    </div>

    <!-- Clients Logos with Scrolling Effect -->
    <div class="clients-logos-wrapper">
      <div class="clients-logos">
        <div
          v-for="news in newsitem2"
          :key="news.id"
          class="logo-container"
          @click="onClient(news.id)"
        >
          <img :src="`${base_path}${news.meta_keywords}`" :alt="news.title" class="client-logo" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from "vue-router";
const router = useRouter();
const base_path = '/website/';
import { ref, onMounted } from 'vue';

let newsitem2 = ref([]);

onMounted(async () => {
  nextFivePost();
});

const nextFivePost = async () => {
  let response = await axios.get("/api/next_five_Posts");
  newsitem2.value = response.data.nextFourNews;
};

// Redirect to the client's page when a logo is clicked
const onClient = (slug) => {
  router.push(`/client/${slug}`);
};
</script>

<style scoped>
.clients-container {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  padding: 0 5%;
  height: 80vh; /* Default height for larger screens */
  background-color: #f5f5f5;
}

.vertical-title {
  margin-top: 0;
  margin-left: 20px;
  writing-mode: vertical-rl;
  transform: rotate(180deg);
  color: #3a7ca5;
  font-family: 'GramophoneShadedNF', serif;
}

.clients-title {
  font-size: 3rem;
  color: #3a7ca5;
}

.clients-logos-wrapper {
  margin-top: 0;
  width: 80%;
  border-left: 2px solid #3a7ca5;
  padding-left: 20px;
  overflow: hidden;
  position: relative;
}

.clients-logos {
  display: flex;
  gap: 20px;
  animation: scroll 20s linear infinite; /* Horizontal scrolling animation */
}

.logo-container {
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
}

.client-logo {
  width: 300px; /* Increase width */
  height: 300px; /* Increase height */
  object-fit: contain;
  transition: transform 0.3s ease-in-out;
}

.client-logo:hover {
  transform: scale(1.1); /* Hover effect */
}

@keyframes scroll {
  0% {
    transform: translateX(100%);
  }
  100% {
    transform: translateX(-100%);
  }
}

/* Responsive styles for mobile */
@media (max-width: 768px) {
  .clients-logos-wrapper {
    width: 100%;
  }

  .clients-logos {
    animation-duration: 30s; /* Slower animation for smaller screens */
  }
}

@media (max-width: 480px) {
  .clients-container {
    flex-direction: column;
    align-items: center;
    height: 30vh; /* Reduced height for mobile */
    padding: 10px; /* Reduce padding */
  }

  .vertical-title {
    writing-mode: horizontal-tb;
    transform: none;
    margin-bottom: 10px;
  }

  .clients-logos-wrapper {
    padding-left: 5px; /* Reduce padding for better alignment */
    width: 100%; /* Full width */
  }

  .clients-logos {
    gap: 10px; /* Reduce gap between images */
    animation-duration: 40s;
    height: 156px;
    margin-top: -20px;
  }

  .client-logo {
    width: 250px; /* Larger width */
    height: 250px; /* Larger height */
  }
}

</style>
