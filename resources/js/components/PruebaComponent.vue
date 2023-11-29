<template>
  <div class="mt-3">
    <h2 class="text-white">Usuario:</h2>
    <pre class="h3">{{ usuario.name }} - {{ usuario.email }}</pre>
  </div>
</template>

<script>
export default {
  setup() {
      const usuario = window.user; // Accede al usuario desde window

      return {
          usuario,
      };
  },
};
</script>
