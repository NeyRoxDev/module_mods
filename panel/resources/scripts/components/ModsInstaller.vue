<template>
  <div class="mods-installer">
    <h3>Mods installés</h3>
    <ul>
      <li v-for="mod in mods" :key="mod.name">
        {{ mod.name }} ({{ mod.version }})
        <button @click="uninstall(mod.name)">Supprimer</button>
      </li>
    </ul>
    <div class="install-form">
      <input v-model="url" placeholder="URL du mod" />
      <button @click="install">Installer</button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ModsInstaller',
  data() {
    return {
      mods: [],
      url: '',
    };
  },
  created() {
    this.fetchMods();
  },
  methods: {
    async fetchMods() {
      const res = await fetch('/api/mods');
      this.mods = await res.json();
    },
    async install() {
      await fetch('/api/mods/install', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ url: this.url })
      });
      this.url = '';
      this.fetchMods();
    },
    async uninstall(name) {
      await fetch('/api/mods/uninstall', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name })
      });
      this.fetchMods();
    }
  }
};
</script>

<style scoped>
.mods-installer {
  max-width: 400px;
}
.install-form {
  margin-top: 1rem;
}
</style>
