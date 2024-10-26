<template>
  <div>
    <Header />
    <div class="hero-container">
      <!-- Left Side: Contact Information -->
      <div class="contact-info-container">
        <h1 class="title">Contact</h1>
        <p class="animated-text">
          Phone: <a href="tel:+1234567890" class="contact-info">+1 234 567 890</a><br>
          Web: <a href="www.example.com" class="contact-info">www.example.com</a><br>
          Email: <a href="mailto:someone@example.com" class="contact-info">someone@example.com</a>
        </p>
      </div>

      <!-- Right Side: Newsletter Section -->
      <div class="newsletter-container">
        <h2 class="newsletter-title">Send us a message</h2>
        <form @submit.prevent="sendEmail">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" v-model="name" id="name" class="form-control" required />
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" v-model="email" id="email" class="form-control" required />
          </div>
          <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" v-model="phone" id="phone" class="form-control" required />
          </div>
          <div class="form-group">
            <label for="body">Message</label>
            <textarea v-model="body" id="body" class="form-control" rows="5" required></textarea>
          </div>

          <button type="submit" class="submit-button" :disabled="loading">
            {{ loading ? 'Wait...' : 'Send' }}
          </button>
        </form>
      </div>
    </div>

    <Footer />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import Header from './Header.vue';
import Footer from './Footer.vue';

const name = ref('');
const email = ref('');
const phone = ref('');
const body = ref('');
const loading = ref(false);

const sendEmail = async () => {
  loading.value = true;

  try {
    await axios.post('/api/sendemail', {
      name: name.value,
      email: email.value,
      phone: phone.value,
      body: body.value,
    });

    alert('Email sent successfully!');
    name.value = '';
    email.value = '';
    phone.value = '';
    body.value = '';
  } catch (error) {
    console.error(error);
    alert('Failed to send email.');
  } finally {
    loading.value = false;
  }
};
</script>


<style scoped>
.hero-container {
  position: relative;
  width: 100%;
  height: 130vh;
  background-image: url('/image/contact2.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  display: flex;
  justify-content: space-between; /* Adjust for left and right sections */
  align-items: center;
  padding: 0 20px;
}

.contact-info-container {
  background-color: rgba(255, 255, 255, 0.9);
  padding: 20px;
  border-radius: 10px;
  max-width: 400px;
  text-align: left;
  margin-left: 160px;
  font-family: 'GramophoneShadedNF', serif;
}

.newsletter-container {
  background-color: rgba(255, 255, 255, 0.9);
  padding: 20px;
  border-radius: 10px;
  max-width: 400px;
  margin-right: 488px;
  text-align: left;
  font-family: 'GramophoneShadedNF', serif;
}

.title {
  font-size: 2.5rem;
  margin-bottom: 20px;
  color: #3a7ca5;
}

.animated-text {
  font-size: 1.2rem;
  line-height: 1.6;
  color: #3a7ca5;
}

.newsletter-title {
  font-size: 1.8rem;
  margin-bottom: 15px;
  color: #3a7ca5;
}

.form-group {
  margin-bottom: 15px;
}

.form-control {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.submit-button {
  background-color: #3a7ca5;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.submit-button[disabled] {
  background-color: #a7c8db;
  cursor: not-allowed;
}

.submit-button:hover {
  background-color: #285b7a;
}

@media (max-width: 768px) {
  .hero-container {
    flex-direction: column;
    align-items: center;
  }

  .contact-info-container {
    max-width: 100%;
    width: 90%;
    margin-bottom: 20px;
    margin-left: 19px;
    margin-top: 100px;
  }
  .newsletter-container {
    max-width: 100%;
    width: 90%;
    margin-bottom: 130px;
    margin-right: -21px;
    font-family: 'GramophoneShadedNF', serif;
  }

  .title {
    font-size: 2rem;
  }

  .animated-text {
    font-size: 1rem;
  }
}
</style>
