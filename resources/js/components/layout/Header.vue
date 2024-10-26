<template>
  <header class="fixed top-0 left-0 right-0 text-gray-400 shadow-md z-50" style="background-color: rgb(20, 20, 36);">
    <div class="container mx-auto flex justify-between items-center p-4">
      <!-- Logo -->
      <div class="flex flex-col items-start" @click="onHome">
        <!-- Header Logo -->
        <img :src="logo" alt="Logo" class="logo-img">
      </div>
      
      <!-- Navigation Links -->
      <nav class="hidden text-gray-400 md:flex flex-grow items-center" style="margin-left: 113px;">
        <!-- Left Navigation Links -->
        <div class="flex space-x-4 md:space-x-6 relative" style="margin-top: 19px;margin-left: 220px;">
          <div @mouseover="showCategoryMenu = true" @mouseleave="showCategoryMenu = false" class="relative">
            <a href="#" class="hover:text-gray-400 font-bold transition duration-300 font-bold text-l" style="color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;">About
              <i class="fa fa-caret-down"></i>
            </a>
            <div v-if="showCategoryMenu" class="absolute top-full left-0 w-100 bg-white shadow-lg p-4 z-40" style="width: 175px;background-color: rgb(20, 20, 36);">
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex flex-col space-y-2">
                  <a href="#" class="hover:text-gray-400 transition duration-300 font-serif" style="width: 100px;color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onShowCat">Who we are</a>
                  <a href="#" class="hover:text-gray-400 transition duration-300 font-serif" style="color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onShow">Mission</a>
                  <a href="#" class="hover:text-gray-400 transition duration-300 font-serif" style="color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onShowvision">Vision</a>
                </div>
              </div>
            </div>
          </div>
          <a href="#" class="hover:text-gray-400 transition duration-300 font-bold text-l" style="color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onClient(56)">Clients </a>
          <a href="#" class="hover:text-gray-400 font-bold transition duration-300 font-bold text-l" style="color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onExp">Portfolio</a>

          <div @mouseover="showCategoryMenu2 = true" @mouseleave="showCategoryMenu2 = false" class="relative">
            <a href="#" class="hover:text-gray-400 font-bold transition duration-300 font-bold text-l" style="color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;">Services
              <i class="fa fa-caret-down"></i>
            </a>
            <div v-if="showCategoryMenu2" class="absolute top-full left-0 w-100 bg-white shadow-lg p-4 z-40" style="width: 175px;background-color: rgb(20, 20, 36);">
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex flex-col space-y-2">
                  <a href="#" class="hover:text-gray-400 transition duration-300 font-serif" style="width: 100px;color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onShowCat1">Design Service</a>
                  <a href="#" class="hover:text-gray-400 transition duration-300 font-serif" style="width: 100px;color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onShow1">Media Service</a>
                  <a href="#" class="hover:text-gray-400 transition duration-300 font-serif" style="width: 100px;color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onShowvision1">Print Service</a>
                </div>
              </div>
            </div>
          </div>
          
          <a href="#" class="hover:text-gray-400 font-bold transition duration-300 font-bold text-l" style="color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="contactUs">Contact</a>
        </div>
        
        <!-- Right Navigation Links -->
        <div class="ml-auto flex items-center space-x-4">
          <div class="relative">
            <button @click="toggleSearch" class="hover:text-gray-400 transition duration-300 focus:outline-none font-bold text-xl">
              <i class="fas fa-search"></i>
            </button>
            <transition name="fade">
              <input v-if="isSearchOpen" type="text" placeholder="Search..." class="absolute top-0 right-0 w-full md:w-64 p-2 border rounded bg-white text-black focus:outline-none font-serif">
            </transition>
          </div>
        </div>
      </nav>

      <!-- Mobile Menu Button -->
    <!-- Mobile Menu Button -->
    <div class="md:hidden lg:hidden flex items-center">
        <!-- Mobile Search Button -->
        <button @click="toggleSearch" class="text-gray focus:outline-none ml-10">
          <i class="fas fa-search"></i>
        </button>
        <button @click="toggleMenu" class="text-gray focus:outline-none ml-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile Search Bar -->
    <transition name="fade">
      <div v-if="isSearchOpen" class="md:hidden lg:hidden bg-white text-black p-2">
        <input type="text" placeholder="Search..." class="w-full p-2 border rounded focus:outline-none font-serif">
      </div>
    </transition>

    <!-- Mobile Menu -->
    <div v-if="isMenuOpen" class="lg:hidden sm:hidden bg-black text-white" style="background-color: rgb(20, 20, 36);">
      <a href="#" class="block px-4 py-2 hover:bg-gray-800 font-serif">Home</a>
        <div @click="toggleCategoryMenu" class="block px-4 py-2 hover:bg-gray-800 font-serif">About 
          <i class="fa fa-caret-down"></i>
        </div>
        <transition name="fade">
          <div v-if="isCategoryMenuOpen" class="bg-white text-black p-4 z-40 ml-4 mr-8" style="background-color: rgb(20, 20, 36);">
            <div class="grid grid-cols-1 gap-4">
              <div class="flex flex-col space-y-2">
                <a href="#" class="hover:text-gray-400 transition duration-300 font-serif" style="width: 100px;color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onShowCat">Who we are</a>
                <a href="#" class="hover:text-gray-400 transition duration-300 font-serif" style="color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onShow">Mission</a>
                <a href="#" class="hover:text-gray-400 transition duration-300 font-serif" style="color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onShowvision">Vision</a>
              </div>
            </div>
          </div>
        </transition>
      <a href="#" class="block px-4 py-2 hover:bg-gray-800 font-serif" style="color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onClient(56)">Client</a>
      <a href="#" class="block px-4 py-2 hover:bg-gray-800 font-serif" style="color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onExp">Portfolio</a>
       <div @click="toggleCategoryMenu2" class="block px-4 py-2 hover:bg-gray-800 font-serif">Services
        <i class="fa fa-caret-down"></i>
        </div>
        <transition name="fade">
          <div v-if="isCategoryMenuOpen2" class="bg-white text-black p-4 z-40 ml-4 mr-8" style="background-color: rgb(20, 20, 36);">
            <div class="grid grid-cols-1 gap-4">
              <div class="flex flex-col space-y-2">
                <a href="#" class="hover:text-gray-400 transition duration-300 font-serif" style="width: 100px;color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onShowCat1">Design Service</a>
                  <a href="#" class="hover:text-gray-400 transition duration-300 font-serif" style="width: 100px;color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onShow1">Media Service</a>
                  <a href="#" class="hover:text-gray-400 transition duration-300 font-serif" style="width: 100px;color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="onShowvision1">Print Service</a>
              </div>
            </div>
          </div>
        </transition>
      <a href="#" class="block px-4 py-2 hover:bg-gray-800 font-serif" style="color: rgb(245 247 251);font-family: 'GramophoneShadedNF', serif;" @click="contactUs">Contact</a>
    </div>
  </header>
</template>

  <script setup>
  import { ref } from 'vue';
  const logo = '/image/newlogo.png';
  import { useRouter } from "vue-router"


  const router = useRouter()
  const isMenuOpen = ref(false);
  const isSearchOpen = ref(false);
  const showCategoryMenu = ref(false);
  const showCategoryMenu2 = ref(false);
  const isCategoryMenuOpen = ref(false);
  const isCategoryMenuOpen2 = ref(false);

  function toggleMenu() {
  isMenuOpen.value = !isMenuOpen.value;
}

function toggleSearch() {
  isSearchOpen.value = !isSearchOpen.value;
}
function toggleCategoryMenu() {
  isCategoryMenuOpen.value = !isCategoryMenuOpen.value;
}
function toggleCategoryMenu2() {
  isCategoryMenuOpen2.value = !isCategoryMenuOpen2.value;
}
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
const onClient =  (slug) => {
    router.push(`/client/${slug}`);
}
const onHome =  () => {
    router.push('/');
}
const onExp =  (slug) => {
    router.push('/experience');
  }
  const contactUs = () => {
    router.push('/contactus');
  }
</script>
  
  <style  scoped>
  .logo-img {
  height: calc(100% - 16px); /* Adjust this to match header padding and desired size */
  max-height: 47px; /* Set a maximum height if needed */
  object-fit: contain;
  transition: transform 0.3s ease-in-out;
}

.logo-img:hover {
  transform: scale(1.1);
}

/* Adjust header height, so logo fits well */
header {
  height: 72px; /* Adjust header height as needed */
}

/* Rest of your styles */
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}

  </style>
  