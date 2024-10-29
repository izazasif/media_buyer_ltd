<template>
  <div>
    <Header />
    <div class="clients-container">
      <div class="vertical-title">
        <h1 class="clients-title">Our Clients</h1>
      </div>
      <div class="clients-logos">
        <div
          v-for="client in clients"
          :key="client.id"
          class="logo-container"
        >
          <!-- Displaying client logo -->
          <img :src="`${base_path}${client.meta_keywords}`" :alt="client.title" class="client-logo" />
          <!-- Clicking the client title opens the modal -->
          <p class="client-title">{{ client.name }}</p>
          
          <!-- Inline Modal that appears after the clicked client title -->
          <div v-if="selectedClient && selectedClient.id === client.id" class="inline-modal">
            <Modal :isOpen="isModalOpen" :client="selectedClient" @close="closeModal" />
          </div>
        </div>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script setup>
import Header from "./Header.vue";
import Footer from "./Footer.vue";
import { useRouter } from "vue-router"
const router = useRouter()
import { ref, onMounted } from 'vue';
import axios from 'axios'; // Assuming axios is installed and used for API calls

const base_path = '/website/';
let clients = ref([]); // Holds the list of clients

onMounted(async () => {
  await fetchClients(); // Fetch clients on component mount
});

// Function to fetch all client data
const fetchClients = async () => {
  try {
    let response = await axios.get("/api/latest_three_item");
    clients.value = response.data.latestPosts; // Assign fetched data to clients
  } catch (error) {
    console.error("Error fetching clients:", error);
  }
};

// Function to fetch and open modal with client details
const newClass =  (clientId) => {
  router.push(`/clientdetails/${clientId}`);
};


</script>

<style scoped>
/* Container for clients */
.clients-container {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  padding: 0 5%;
  height: auto;
  background-color: #f5f5f5;
}

.vertical-title {
  margin-top: 101px;
  margin-left: 170px;
  writing-mode: vertical-rl;
  transform: rotate(180deg);
  color: #3a7ca5;
  font-family: 'GramophoneShadedNF', serif;
}

.clients-title {
  font-size: 2.7rem;
  color: #3a7ca5;
  margin-top: 80px;
}

/* Grid container for client logos and titles */
.clients-logos {
  margin-top: 40px;
  margin-top: 100px;
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  gap: 20px;
  width: 80%;
  border-left: 2px solid #3a7ca5;
  padding-left: 20px;
}

/* Each client logo container */
.logo-container {
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  cursor: pointer;
}

/* Client logo styles */
.client-logo {
  max-width: 100px;
  max-height: 100px;
  object-fit: contain;
  transition: transform 0.3s ease-in-out;
}

.client-logo:hover {
  transform: scale(1.1);
}

/* Client title styles */
.client-title {
  margin-top: 8px;
  font-size: 0.9rem;
  text-align: center;
  color: #3a7ca5;
}

/* Inline modal styles */
.inline-modal {
  position: absolute;
  top: 120px;
  left: 0;
  right: 0;
  z-index: 10;
  background-color: white;
  border: 1px solid #ccc;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  padding: 20px;
  width: 300px; /* Set modal width */
}

/* Modal arrow */
.inline-modal::before {
  content: '';
  position: absolute;
  top: -10px;
  left: 50%;
  transform: translateX(-50%);
  border-width: 10px;
  border-style: solid;
  border-color: transparent transparent white transparent;
}

/* Responsive grid for tablets */
@media (max-width: 1024px) {
  .clients-logos {
    grid-template-columns: repeat(4, 1fr);
  }
}

/* Responsive grid for small screens */
@media (max-width: 768px) {
  .clients-logos {
    grid-template-columns: repeat(3, 1fr);
  }
}

/* Mobile view styles */
@media (max-width: 480px) {
  .clients-container {
    flex-direction: column;
    align-items: center;
  }

  .vertical-title {
    margin-top: 29px;
    margin-left: 0;
    writing-mode: horizontal-tb;
    transform: none;
    margin-bottom: 20px;
  }

  .clients-logos {
    grid-template-columns: repeat(2, 1fr);
    width: 100%;
    margin-bottom: 100px;
    margin-top: 30px;
  }

  .client-logo {
    max-width: 80px;
    max-height: 80px;
  }

  .client-title {
    font-size: 0.8rem;
  }
}
</style>
