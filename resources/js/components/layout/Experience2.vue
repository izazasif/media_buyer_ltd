<template>
    <div class="hero-container">
      <!-- Text Overlay -->
      <div class="text-overlay">
        <!-- <h1 class="title">Our Experience</h1> -->
      </div>
    </div>
  </template>
  
  <script setup>
  // No additional logic needed for now
  </script>
  
  <style scoped>
  .hero-container {
    position: relative;
    width: 100%;
    height: 100vh; /* Full screen height */
    background-image: url('/image/exp2.png'); /* Adjust the path accordingly */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .text-overlay {
    position: absolute;
    top: 16%; /* Adjusted for better responsiveness */
    left: 30%;
    transform: translateX(-50%);
    max-width: 80%; /* Set to a percentage for responsiveness */
    padding: 20px;
    border-radius: 10px;
    text-align: center;
  }
  
  .title {
    font-size: 3.5rem;
    margin-bottom: 20px;
    animation: fadeInDown 2s ease-out; /* Add fade-in animation to the title */
    margin-top: 0px;
    font-family: 'GramophoneShadedNF', serif;
    color: #3a7ca5;
  }
  
  .animated-text {
    font-size: 1.2rem;
    line-height: 1.6;
    width: 352px;
    font-family: 'GramophoneShadedNF', serif;
    color: #3a7ca5;
  }
  
  .contact-info {
    color: #3a7ca5;
    text-decoration: none;
  }
  
  .contact-info:hover {
    text-decoration: underline;
  }
  
  /* Define keyframes for text animations */
  @keyframes fadeInUp {
    0% {
      opacity: 0;
      transform: translateY(50px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  @keyframes fadeInDown {
    0% {
      opacity: 0;
      transform: translateY(-50px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  /* Responsive design for smaller screens */
  @media (max-width: 1024px) {
    .title {
      font-size: 2.5rem; /* Scale down title size for large tablets */
    }
  
    .animated-text {
      font-size: 1rem; /* Adjust font size for readability */
    }
  }
  
  @media (max-width: 768px) {
    .hero-container {
      height: 80vh; /* Reduce height on tablets */
    }
  
    .text-overlay {
      top: 20%; /* Adjust the top position on smaller devices */
      left: 50%; /* Center text on smaller screens */
      transform: translateX(-50%);
      max-width: 90%;
    }
  
    .title {
      font-size: 2rem; /* Scale down title size */
      margin-top: 0; /* Adjust margin */
    }
  
    .animated-text {
      font-size: 0.95rem; /* Adjust font size for readability */
    }
  }
  
  @media (max-width: 480px) {
    .hero-container {
      height: 60vh; /* Further reduce height for very small screens */
      padding: 0 10px; /* Add padding to avoid text touching the sides */
    }
  
    .text-overlay {
      top: 10%; /* Adjust position for mobile devices */
      left: 50%; /* Center text */
      transform: translateX(-50%);
      max-width: 100%;
    }
  
    .title {
      font-size: 1.5rem; /* Reduce title size for very small screens */
    }
  
    .animated-text {
      font-size: 0.85rem; /* Adjust text size */
      width: auto; /* Allow text to take up available width */
    }
  }
  </style>
  