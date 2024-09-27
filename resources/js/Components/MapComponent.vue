<template>
    <div id="map" class="h-64 w-full"></div>
  </template>

  <script setup>
  import { onMounted, ref } from 'vue';
  import L from 'leaflet';

  // Map initialization
  const map = ref(null);

  onMounted(() => {
    // Initialize the map
    map.value = L.map('map').setView([51.505, -0.09], 13); // Set the initial view to a specific latitude and longitude
  
    // Add OpenStreetMap tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
    }).addTo(map.value);

    // Add a marker
    L.marker([51.505, -0.09]).addTo(map.value).bindPopup('A pretty CSS3 popup.<br> Easily customizable.').openPopup();
  });
  </script>

  <style>
  /* Fix Leaflet's default icon issue */
  #map {
    height: 400px; /* Adjust the height as needed */
  }
  </style>
