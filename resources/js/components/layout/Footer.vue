<template>
  <!-- Footer Section -->
  <footer class="bg-beige py-6 font-bold text-l" style="color: rgb(245 247 251);background-color: rgb(20, 20, 36);font-family: 'GramophoneShadedNF', serif;">
    <div class="container mx-auto px-4 flex flex-wrap justify-between">
      <!-- Logo and First Section -->
      <div class="w-full md:w-1/3 mb-8 md:mb-0 text-center md:text-end">
        <a href="" @click="onHome">
          <div class="flex flex-col items-center">
        <!-- Header Logo -->
          <img :src="logo" alt="Logo" class="logo-img">
        </div>
        </a>
      
        <p class="font-semibold mb-2 font-serif">Media Buyer Marketing Agency</p>
        <ul>
          <a href="" class="hover:text-gray-400 transition duration-300 font-serif" style="width: 100px;color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onShowCat"><li class="mb-1 ">Who we are</li> </a>
          <a href="" class="hover:text-gray-400 transition duration-300 font-serif" style="width: 100px;color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onShow"><li class="mb-1 ">Mission</li></a>
          <a href="" class="hover:text-gray-400 transition duration-300 font-serif" style="width: 100px;color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onShowvision"><li class="mb-1 ">Vision</li></a>
        </ul>
      </div>

      <!-- Contact Us Section -->
      <div class="w-full md:w-1/3 mb-8 md:mb-0 text-center md:text-center">
        <p class="font-semibold mb-2 ">Contact us</p>
        <ul>
          <li class="mb-1 ">+1 234 567 890</li>
          <li class="mb-1 ">www.example.com</li>
          <li class="mb-1 ">someone@example.com</li>
        </ul>
      </div>

      <!-- Social Media Icons Section -->
      <div class="w-full md:w-1/3 mb-8 md:mb-0 flex justify-center md:justify-start space-x-4">
        <div class="w-full md:w-1/3 mb-8 md:mb-0 text-center md:text-center">
          <p class="font-semibold mb-2 font-serif">Services</p>
          <ul>
            <a href="" class="hover:text-gray-400 transition duration-300 font-serif" style="width: 100px;color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onShowCat1"><li class="mb-1">Design Service</li></a>
            <a href="" class="hover:text-gray-400 transition duration-300 font-serif" style="width: 100px;color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onShow1"><li class="mb-1">Media Service</li></a>
            <a href="" class="hover:text-gray-400 transition duration-300 font-serif" style="width: 100px;color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onShowvision1"><li class="mb-1">Print Service</li></a>
          </ul>
          <a href="https://www.facebook.com" target="_blank" class="text-gray-400 hover:text-blue-600 p-4">
            <i class="fab fa-facebook-f text-2xl"></i>
          </a> 
          <a href="https://www.youtube.com" target="_blank" class="text-gray-400 hover:text-red-600">
            <i class="fab fa-youtube text-2xl"></i>
          </a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
 const logo = '/image/newlogo.png';
 import { useRouter } from "vue-router"
 const router = useRouter()
 const onShow =  () => {
  router.push('/mission');
}
const onShowCat = () => {
  router.push('/whoweare');
}
const onShowvision = () => {
  router.push('/vision');
}
const  onShowCat1 =  () => {
  router.push('/designservice');
}
const onShow1 = () => {
  router.push('/mediaservice');
}
const onShowvision1 = () => {
  router.push('/printservice');
}
</script>

<style scoped>
 .logo-img {
  height: calc(100% - 16px); /* Adjust this to match header padding and desired size */
  max-height: 47px; /* Set a maximum height if needed */
  object-fit: contain;
  transition: transform 0.3s ease-in-out;
}

.logo-img:hover {
  transform: scale(1.1);
}
</style>
