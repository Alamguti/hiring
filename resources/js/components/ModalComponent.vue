<template>
  <div class="modal fade" :id="modalId" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" :id="modalTitleId">{{ title }}</h5>
          <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <slot></slot>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="closeModal">Close</button>
          <button type="button" class="btn btn-primary" @click="saveChanges">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: String,
    modalId: String,
    modalTitleId: String
  },
  methods: {
    closeModal() {
      // Lógica para cerrar el modal
      // Puedes emitir un evento para notificar a tu componente padre
      this.$emit('closed');
    },
    saveChanges() {
      // Lógica para guardar cambios
      // Puedes emitir un evento para notificar a tu componente padre
      this.$emit('save-changes');
    }
  }
};
</script>

<style>
/* Estilos del modal si es necesario */
</style>
