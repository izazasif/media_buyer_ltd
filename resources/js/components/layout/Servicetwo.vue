<template>
  <div>
    <Header />
    <div class="mission-container">
      <!-- Vertical Title -->
      <div class="vertical-title">
        <h1 class="mission-title">vision</h1>
      </div>
      <!-- Mission Description -->
      <div class="mission-description">
        <p class="animated-description">
            Our vision is to be at the forefront of reshaping the way businesses engage with their 
            audiences .
        </p>
      </div>
    </div>
    <Footer />
  </div>
  </template>
  
  <script setup>
  import Header from "./Header.vue";
  import Footer from "./Footer.vue";
  </script>
  
  <style scoped>
  .mission-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 100vh; /* Full screen height for desktop */
    width: 100%;
    background-image: url('/image/new5.jpeg'); /* Adjust the path accordingly */
    background-size: cover;
    background-position: center;
    padding: 0 5%; /* Add padding for spacing */
  }
  
  .vertical-title {
    margin-left: 254px;
    writing-mode: vertical-rl; /* Rotate the text vertically */
    transform: rotate(180deg); /* Ensure the text is right side up */
    font-family: 'GramophoneShadedNF', serif;
    color: #3a7ca5; /* Blue color for the title */
  }
  
  .mission-title {
    font-size: 6rem;
    color: #3a7ca5; /* Blue color for the title */
  }
  
  .mission-description {
    max-width: 60%; /* Set a max width for the text container */
    color: white;
  }
  
  .animated-description {
    font-size: 1.2rem;
    line-height: 1.6;
    font-family: 'GramophoneShadedNF', serif;
    animation: fadeInUp 3s ease-in-out infinite;
    color: white; /* White text color */
  }
  
  /* Define keyframes for text animations */
  @keyframes fadeInUp {
    0% {
      opacity: 0;
      transform: translateY(30px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  /* Responsive Design */
  @media (max-width: 768px) {
    .mission-container {
      height: 80vh; /* Reduce height for tablets */
    }
  
    .mission-title {
      font-size: 2.5rem; /* Scale down title for smaller screens */
    }
  
    .mission-description {
      max-width: 70%; /* Adjust text width for smaller screens */
    }
  
    .animated-description {
      font-size: 1rem; /* Adjust text size for readability */
    }
  }
  
  @media (max-width: 480px) {
    .mission-container {
      height: 60vh; /* Further reduce height for mobile devices */
      flex-direction: column; /* Stack the elements vertically on mobile */
      justify-content: center;
      align-items: center;
    }
  
    .vertical-title {
      margin-left: 0;
      writing-mode: horizontal-tb; /* Change to horizontal for small screens */
      transform: none; /* Remove rotation */
      margin-bottom: 20px; /* Add some spacing */
    }
  
    .mission-title {
      font-size: 2rem; /* Further reduce title size for mobile devices */
    }
  
    .mission-description {
      max-width: 90%; /* Increase the width for better readability */
      text-align: center; /* Center text for mobile */
    }
  
    .animated-description {
      font-size: 0.9rem;
    }
  }
  </style>
  