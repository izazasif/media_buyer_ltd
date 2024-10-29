<template>
  <!-- Footer Section -->
  <footer class="bg-beige py-6 font-bold text-l" style="color: rgb(245 247 251);background-color: rgb(20, 20, 36);font-family: 'GramophoneShadedNF', serif;">
    <div class="container mx-auto px-4 flex flex-wrap justify-center">
      <!-- Logo and First Section -->
      <div class="w-full md:w-1/3 mb-6 md:mb-0 text-center md:text-end">
        <a href="" @click="onHome">
          <div class="flex flex-col items-center">
            <!-- Header Logo -->
            <img :src="logo" alt="Logo" class="logo-img">
          </div>
        </a>
        <p class="font-semibold mb-2 font-serif">Media Buyer Marketing Agency</p>
        <ul>
          <a href="" class="hover:text-gray-400 transition duration-300 font-serif" @click="onShowCat">
            <li class="mb-1">Who we are</li>
          </a>
          <a href="" class="hover:text-gray-400 transition duration-300 font-serif" @click="onShow">
            <li class="mb-1">Mission</li>
          </a>
          <a href="" class="hover:text-gray-400 transition duration-300 font-serif" @click="onShowvision">
            <li class="mb-1">Vision</li>
          </a>
        </ul>
      </div>

      <!-- Contact Us Section -->
      <div class="w-full md:w-1/3 mb-6 md:mb-0 text-center">
        <p class="font-semibold mb-2">Contact us</p>
        <ul>
          <li class="mb-1 flex items-center justify-center">
            <a href="https://wa.me/1234567890" target="_blank" class="mr-2 text-green-500">
              <i class="fab fa-whatsapp text-2xl"></i>
            </a>
            +1 234 567 890
          </li>
          <li class="mb-1 flex items-center justify-center">
            <a href="mailto:someone@example.com" class="mr-2 text-blue-500">
              <i class="fas fa-envelope text-2xl"></i>
            </a>
            <span>someone@example.com</span>
          </li>
        </ul>
        <div class="social-icons mt-2 space-x-4">
          <a href="https://www.facebook.com" target="_blank" class="text-gray-400 hover:text-blue-600">
            <i class="fab fa-facebook-f text-2xl"></i>
          </a>
          <a href="https://www.youtube.com" target="_blank" class="text-gray-400 hover:text-red-600">
            <i class="fab fa-youtube text-2xl"></i>
          </a>
          <a href="https://www.linkedin.com" target="_blank" class="text-gray-400 hover:text-blue-700">
            <i class="fab fa-linkedin text-2xl"></i>
          </a>
          <a href="https://www.instagram.com" target="_blank" class="text-gray-400 hover:text-pink-500">
            <i class="fab fa-instagram text-2xl"></i>
          </a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { useRouter } from "vue-router";

const logo = '/image/newlogo.png';
const router = useRouter();

const onShow = () => {
  router.push('/mission');
};
const onShowCat = () => {
  router.push('/whoweare');
};
const onShowvision = () => {
  router.push('/vision');
};
</script>

<style scoped>
.logo-img {
  height: calc(100% - 16px);
  max-height: 47px;
  object-fit: contain;
  transition: transform 0.3s ease-in-out;
}

.logo-img:hover {
  transform: scale(1.1);
}

.social-icons i {
  transition: color 0.3s ease;
}
</style>
