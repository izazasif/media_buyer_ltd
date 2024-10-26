<template>
   <div>
    <Header />
  <div class="mission-container">
    <!-- Services Description -->
    <div class="mission-description">
      <div class="services-description">
        <div class="service-item">
          <h2 class="service-heading">Design</h2>
          <p class="service-text">
            We Study. We Create. We Engage. Creating, engaging, effective, and visually appealing content.
          </p>
        </div>
        <div class="service-item">
          <p class="service-text">
            Photography / Videography <br />
            We strive to produce high-quality images and video that capture moments.
          </p>
        </div>
        <div class="service-item">
          <h2 class="service-heading">Video Editing</h2>
          <p class="service-text">
            Creating and refining video content for various platforms to enhance brand visibility and engagement.
          </p>
        </div>
      </div>
    </div>
    
    <!-- Vertical Title -->
    <div class="vertical-title">
      <h1 class="mission-title">Services:</h1>
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
  height: 100vh;
  width: 100%;
  background-image: url('/image/new6.jpeg'); /* Adjust the path accordingly */
  background-size: cover;
  background-position: center;
  padding: 0 5%;
}

.vertical-title {
  writing-mode: vertical-rl;
  transform: rotate(180deg);
  font-family: 'GramophoneShadedNF', serif;
  color: #f0f2f5;
  margin-left: 30px;
}

.mission-title {
  font-size: 6rem;
  color: #fcfcfc;
  margin: 0;
  margin-left: 376px;
}

.mission-description {
  max-width: 46%;
  color: white;
  margin-left: 125px;
}

.services-description {
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 1rem;
}

.service-item {
  margin-bottom: 2rem;
}

.service-heading {
  font-size: 1.5rem;
  font-weight: bold;
  color: #f7f9fa;
  margin-bottom: 0.5rem;
}

.service-text {
  font-size: 1rem;
  color: #eff2f5;
}

.services-image {
  margin-left: 2rem;
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

.services-image img {
  max-width: 300px;
  height: auto;
  object-fit: cover;
}

/* Responsive Design */

/* Tablets and Small Screens */
@media (max-width: 1024px) {
  .mission-container {
    flex-direction: column;
    align-items: center;
    height: auto;
    padding: 0;
  }

  .vertical-title {
    margin-left: 0;
    writing-mode: horizontal-tb;
    transform: none;
    font-size: 3rem;
    margin-bottom: 1rem;
    text-align: center;
  }

  .mission-title {
    font-size: 2.5rem;
  }

  .mission-description {
    margin-left: 0;
    max-width: 80%;
    text-align: center;
  }

  .service-heading {
    font-size: 1.25rem;
  }

  .service-text {
    font-size: 0.9rem;
  }
}

/* Mobile Devices */
@media (max-width: 768px) {
  .mission-container {
    height: auto;
    padding: 2rem 1rem;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .mission-title {
    font-size: 2rem;
    margin-bottom: 1rem;
  }

  .mission-description {
    max-width: 100%;
    margin: 0;
    margin-top: 37px;
  }

  .service-item {
    margin-bottom: 1rem;
  }

  .service-heading {
    font-size: 1.2rem;
  }

  .service-text {
    font-size: 0.8rem;
  }

  .vertical-title {
    writing-mode: horizontal-tb;
    transform: none;
    font-size: 2rem;
    margin-bottom: 1.5rem;
    text-align: center;
  }

  .services-description {
    padding: 0;
    margin-top: 68px;
  }

  .services-image {
    margin-left: 0;
    margin-top: 1rem;
  }

  .services-image img {
    max-width: 90%;
  }
}

@media (max-width: 480px) {
  .mission-container {
    height: auto;
    padding: 1rem;
  }

  .mission-title {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    margin-left: 20px;
    margin-top: -281px;
  }

  .service-heading {
    font-size: 1rem;
  }

  .service-text {
    font-size: 0.75rem;
  }

  .vertical-title {
    font-size: 1.5rem;
    margin-bottom: 1rem;
  }

  .services-image img {
    max-width: 80%;
  }
}
</style>
