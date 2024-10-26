<template>
      <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mx-auto">
        <div class="col-span-3">
            <Slider />
            <Client />
            <Experience />
            <Experience2/>
            <Contactone />
        </div>
    </div>
</template>
  
  <script setup>
   import Slider from  "./Slider.vue"
   import Client from "./Client.vue";
   import Contactone from "./Contactone.vue";
   import Experience from "./Experience.vue";
   import Experience2 from "./Experience2.vue";
  </script>


  <style scoped>
  body {
    background-color: #1d1d1f; /* Light gray background */
    color: #333; /* Darker text for readability */
  }
  </style>
  