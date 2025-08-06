<template>
  <div class="mods-installer">
    <div v-if="loading" class="spinner" aria-label="loading"></div>
    <div v-if="message" class="notification success">{{ message }}</div>
    <div v-if="error" class="notification error">{{ error }}</div>
    <button @click="installMod" :disabled="loading">Installer</button>
    <button @click="uninstallMod" :disabled="loading">Supprimer</button>
  </div>
</template>

<script>
export default {
  name: 'ModsInstaller',
  data() {
    return {
      loading: false,
      message: '',
      error: '',
      apiToken: ''
    }
  },
  mounted() {
    const token = document.querySelector('meta[name="api-token"]')
    if (token) {
      this.apiToken = token.getAttribute('content')
    }
  },
  methods: {
    async installMod() {
      await this.sendRequest('/api/mods/install')
    },
    async uninstallMod() {
      await this.sendRequest('/api/mods/uninstall')
    },
    async sendRequest(url) {
      this.loading = true
      this.error = ''
      this.message = ''
      try {
        const response = await fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${this.apiToken}`
          }
        })
        if (!response.ok) {
          throw new Error(await response.text() || 'Une erreur est survenue')
        }
        this.message = 'Action réalisée avec succès'
      } catch (err) {
        this.error = err.message || 'Erreur lors de la requête'
      } finally {
        this.loading = false
      }
    }
  }
}
</script>

<style scoped>
.mods-installer {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  align-items: flex-start;
}

.spinner {
  border: 4px solid #f3f3f3;
  border-top: 4px solid #3498db;
  border-radius: 50%;
  width: 24px;
  height: 24px;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

.notification {
  padding: 0.5rem 1rem;
  border-radius: 4px;
}

.notification.success {
  background-color: #e0f7e9;
  color: #2e7d32;
}

.notification.error {
  background-color: #fdecea;
  color: #c62828;
}
</style>
